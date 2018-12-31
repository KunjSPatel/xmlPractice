<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::orderBy('id')->paginate(10);
        return view('users')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'in:1,2,3,4',
        ]);

        $user = new \App\User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        // Checking if entered passwords match
        if ($request->get('password') == $request->get('confirmPassword')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        $user->roles()->attach($request->get('role'));

        return redirect('/users')->withMessage('The user has been created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);
        if(Auth::user()->hasRole('manager') && ($user->hasRole('admin') || $user->hasRole('manager'))) {
            return redirect('/users')->withMessage('You do not have the permission to edit this user.');
        }
        return view('users.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'in:1,2,3,4',
        ]);

        $user = \App\User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        // Checking if password was entered for updating
        // and if entered passwords match
        if (!$request->get('password') == '' &&
            ($request->get('password') == $request->get('confirmPassword'))) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        if(Auth::user()->hasRole('admin')) {
            $user->roles()->sync($request->get('role'));
        }

        return redirect('/users/edit/' . $user->id)->withMessage('This user has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function myAccount()
    {
        return view('users.myaccount')->withUser(Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateMyAccount(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'in:1,2,3,4',
        ]);

        $user = \App\User::find($request->get('userId'));
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

        // Checking if password was entered for updating
        // and if entered passwords match
        if (!$request->get('password') == '' &&
            ($request->get('password') == $request->get('confirmPassword'))) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();

        if(Auth::user()->hasRole('admin')) {
            $user->roles()->sync($request->get('role'));
        } else {
            $user->roles()->sync('1');
        }

        return redirect('/my-account')->withMessage('Your account has been successfully updated!');
    }
}
