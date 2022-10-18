<?php

namespace App\Http\Controllers;

use App\Jobs\MarkAllAlertsAsRed;
use App\Models\Alert;

class NotificationsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index()
    {
        $alerts = Alert::personalAlerts();
        MarkAllAlertsAsRed::dispatch($alerts)->delay(60);
        return view('notifications.index',compact('alerts'));
    }

    public function markAllAsRead(){
        $alerts = Alert::unreadedAlerts();
        foreach($alerts as $alert){
            $alert->update(['readed'=>true]);
        }
        return back();
    }
}
