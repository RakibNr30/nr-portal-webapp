<?php

namespace App\Http\Controllers;

use App\Notification;
use Auth;
use Modules\Ums\Entities\User;

class NotificationController extends Controller
{
    public function all_notifications()
    {
    	if(Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin'){
            $allnotifications = Notification::where('notification_to_type', 'admin')->orderBy('created_at', 'desc')->get();
            $notifications = $allnotifications->groupBy(function ($match) { return substr($match->created_at, 0, 10);});
            $notifications_count = Notification::where('notification_to_type', 'admin')->count();
        } else if(Auth::user()->role == 'client') {
            $allnotifications = Notification::where('notification_to_type', 'client')->where('notification_to', Auth::id())->orderBy('created_at', 'desc')->get();
            $notifications = $allnotifications->groupBy(function ($match) { return substr($match->created_at, 0, 10);});
            $notifications_count = Notification::where('notification_to_type', 'client')->where('notification_to', Auth::id())->count();
        } else {
            $allnotifications = Notification::where('notification_to_type', 'company')->where('notification_to', Auth::id())->orderBy('created_at', 'desc')->get();
            $notifications = $allnotifications->groupBy(function ($match) { return substr($match->created_at, 0, 10);});
            $notifications_count = Notification::where('notification_to_type', 'company')->where('notification_to', Auth::id())->count();
        }

        $user = User::find(auth()->user()->id);

        if($user->hasRole('admin') || $user->hasRole('super_admin')) {
            Notification::where('notification_to_type', 'admin')
                ->where('status', 'unseen')
                ->update(['status' => 'seen']);
        } else {
            Notification::where('notification_to', $user->id)
                ->where('status', 'unseen')
                ->update(['status' => 'seen']);
        }

        return view('all-notifications', compact('notifications', 'notifications_count'));
    }

    public function inbox()
    {
        return view('inbox');
    }
}