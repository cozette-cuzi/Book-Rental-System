<?php

namespace App\Http\Controllers;

use App\Http\Requests\BorrowRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdateBorrowRequest;
use App\Models\Borrow;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Exception as UtilException;

class BorrowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is.librarian')->only('update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('my_rentals')) {
            $data['pending'] = Auth::user()->readerBorrows->where('status', 'PENDING');
            $data['accepted'] = Auth::user()->readerBorrows->where('status', 'ACCEPTED')->filter(function ($item) {
                return ($item->deadline >= Carbon::now()->endOfDay());
            });
            $data['late'] = Auth::user()->readerBorrows->where('status', 'ACCEPTED')->filter(function ($item) {
                return ($item->deadline < Carbon::now()->endOfDay());
            });
            $data['rejected'] = Auth::user()->readerBorrows->where('status', 'REJECTED');
            $data['returned'] = Auth::user()->readerBorrows->where('status', 'RETURNED');
        } else if (Auth::user()->is_librarian) {
            $data['pending'] = Borrow::where('status', 'PENDING')->get();
            $data['accepted'] = Borrow::where('status', 'ACCEPTED')->whereDate('deadline', '>=', Carbon::now()->endOfDay())->get();

            $data['late'] = Borrow::where('status', 'ACCEPTED')->whereDate('deadline', '<', Carbon::now()->endOfDay())->get();
            $data['rejected'] = Borrow::where('status', 'REJECTED')->get();
            $data['returned'] = Borrow::where('status', 'RETURNED')->get();
        }
        return \view('borrows.list', ['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Borrow::whereId($id)->with('reader', 'book', 'requestManagedBy', 'returnManagedBy')->first();
        $data->isLate =     $data->status == 'ACCEPTED' && $data->deadline < Carbon::now()->endOfDay();
        return \view('borrows.show', ['data' => $data]);
    }

    public function update(Borrow $borrow, UpdateBorrowRequest $request)
    {
        $data = $request->validated();
        $data['request_managed_by'] = Auth::id();
        $data['request_processed_at'] = Carbon::now();
        if ($data['status'] == 'RETURNED') {
            $data['return_managed_by'] = Auth::id();
            $data['returned_at'] = Carbon::now();
        }
        if ($data['deadline'] == null) {
            unset($data['deadline']);
        }
        $borrow->update($data);
        return \redirect()->route('borrows.show', $borrow->id);
    }
}
