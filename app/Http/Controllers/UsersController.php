<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class UsersController extends Controller
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
     * Shows the users list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        // Check permissions
        $this->authorize('users.view');

        // Get all users
        $users = User::all();

        // Render
        return view('users.index', ['users' => $users]);
    }

    /**
     * Create new user
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        // Check permissions
        $this->authorize('users.create');

        // We want only POST requests
        if ($request->isMethod('post')) {
            // Validate the request
            isset($request->in_probation) ? $request->in_probation = true : $request->in_probation = false;

            $request->validate([
                'email' => 'required|unique:users|max:30|email',
                'name' => 'required|string|max:50',
                'role' => 'integer|required',
                'password' => 'required|string|max:30|min:6|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/i',
                'address' => 'string|max:100|nullable',
                'phone' => 'regex:/^[0-9]{7,15}$/|nullable',
                'birth_date' => 'date|nullable'
            ]);

            // Create model
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->in_probation = $request->in_probation;
            $user->role_id = $request->role;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->birth_date = $request->birth_date;
            $user->employee_id = \Illuminate\Support\Str::uuid();

            // Save the record
            $user->save();

            // Prepare the users
            $users = User::all();

            return view('users.index', ['success_message' => __('User was created successfully!'), 'users' => $users]);
        }

        // Get roles
        $roles = Role::all();

        // Go back
        return view('users.create', ['roles' => $roles]);
    }

    public function view(User $user)
    {
        // Check permissions
        $this->authorize('users.view');

        return view('users.view', ['user' => $user]);
    }

    public function edit(Request $request, User $user)
    {
        // Check permissions
        $this->authorize('users.edit');

        // We want only POST requests
        if ($request->isMethod('post')) {
            // Validate the request
            isset($request->in_probation) ? $request->in_probation = true : $request->in_probation = false;

            $request->validate([
                'email' => 'required|unique:users,email,'.$user->id.'|max:30|email',
                'name' => 'required|string|max:50',
                'role' => 'integer|required',
                'password' => 'nullable|string|max:30',
                'address' => 'string|max:100|nullable',
                'phone' => 'regex:/^[0-9]{7,15}$/|nullable',
                'birth_date' => 'date|nullable'
            ]);

            $user->email = $request->email;
            $user->name = $request->name;
            $user->in_probation = $request->in_probation;
            $user->role_id = $request->role;

            // Password could be the same - no new one provided
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->phone = $request->phone;
            $user->birth_date = $request->birth_date;

            // Update the record
            $user->save();

            // Prepare users
            $users = User::all();

            return view('users.index', ['success_message' => __('User was updated successfully!'), 'users' => $users]);
        }

        // Get roles
        $roles = Role::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Delete User
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user)
    {
        // Check permissions
        $this->authorize('users.edit');

        // Stop deleting yourself
        if ($user->id == Auth::user()->id) {
            return back();
        }

        // Delete the user
        try {
            $user->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return back();
    }
}
