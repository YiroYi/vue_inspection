<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;

class NotificationController extends Controller
{
    public function getAdmin()
    {
      return Auth::user()->notifications->where("type","=","App\Notifications\NotifyAdmin")->values();
    }

    public function getCs()
    {
      return Auth::user()->notifications->where("type","=","App\Notifications\NotifyCs")->values();
    }

    public function getCsCh()
    {
      return Auth::user()->notifications->where("type","=","App\Notifications\NotifyCsCh")->values();
    }

    public function getNotFoll()
    {
      return Auth::user()->notifications->where("type","=","App\Notifications\NotifyFollowup")->values();
    }
}
