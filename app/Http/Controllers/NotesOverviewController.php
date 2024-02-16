<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Controllers\NoteController;
use App\Models\Order;
use App\Http\Controllers\OrderController;

class NotesOverviewController extends Controller
{
    public function list() 
    {
        $notes = NoteController::list();
        $orders = OrderController::list();

        return view('notes.clientSearch', ['notes' => $notes, 'orders'  => $orders]);
    }
}
