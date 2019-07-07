<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // This controller is for authenticated users
        $this->middleware('auth');
    }

    /**
     * View profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function view()
    {
        // Check permissions
        $this->authorize('user.profile');

        $user = User::find(Auth::user()->id);

        return view('profile.view', ['user' => $user]);
    }

    /**
     * Profile Update
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request)
    {
        // Check permissions
        $this->authorize('user.profile');

        // Get the logged user - this is for editing only yourselves
        $user = User::find(Auth::user()->id);

        // We want only POST requests
        if ($request->isMethod('post')) {
            // Validate the request
            $request->validate([
                'email' => 'required|unique:users,email,'.$user->id.'|max:30|email',
                'name' => 'required|string|max:50',
                'password' => 'nullable|string|max:30|min:6|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/i',
                'address' => 'string|max:100|nullable',
                'phone' => 'regex:/^[0-9]{7,15}$/|nullable',
                'birth_date' => 'date|nullable'
            ]);

            $user->email = $request->email;
            $user->name = $request->name;

            // Password could be the same - no new one provided
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->phone = $request->phone;
            $user->birth_date = $request->birth_date;

            // Update the record
            $user->save();

            return view('profile.view', ['success_message' => __('Successfully updated!'), 'user' => $user]);
        }

        return view('profile.edit', ['user' => $user]);
    }

}
