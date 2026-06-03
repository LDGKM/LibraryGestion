<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications=auth()->user()
        ->notifications()
        ->orderBy('created_at', 'desc')
        ->get();

        return view('librarygestion.notification.index',compact('notifications'));
    }
}
