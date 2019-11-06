<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\RootController;
use Illuminate\Http\Request;

class BookingShowController extends RootController
{
    public function index(Request $request)
    {
        return $this->view('bookings.index');
    }

    public function bookNew()
    {
        return $this->view('bookings.modal.bookNew');
    }
}
