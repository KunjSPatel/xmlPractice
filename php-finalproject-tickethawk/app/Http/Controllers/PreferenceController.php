<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PreferenceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('preferences');
    }

    /**
     * Update notification preferences.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateNotificationPreferences(Request $request)
    {
        $user = Auth::user();
        $user->email_notifications = $request->get('emailNotifications') !== null;
        $user->text_notifications = $request->get('smsNotifications') !== null;
        $user->save();

        return redirect('/my-account')->withMessage('Preferences have been updated successfully!');
    }
}
