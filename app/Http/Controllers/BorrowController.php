<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pending'] = Auth::user()->readerBorrows->where('status', 'PENDING');
        $data['accepted'] = Auth::user()->readerBorrows->where('status', 'ACCEPTED')->filter(function ($item) {
            return ($item->deadline >= Carbon::now()->endOfDay());
        });
        $data['late'] = Auth::user()->readerBorrows->where('status', 'ACCEPTED')->filter(function ($item) {
            return ($item->deadline < Carbon::now()->endOfDay());
        });
        $data['rejected'] = Auth::user()->readerBorrows->where('status', 'REJECTED');
        $data['returned'] = Auth::user()->readerBorrows->where('status', 'RETURNED');
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
        // \dd($data->book_id);
        $data->isLate =     $data->status == 'ACCEPTED' && $data->deadline < Carbon::now()->endOfDay();
        return \view('borrows.show', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        //
    }
}
