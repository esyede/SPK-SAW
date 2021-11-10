<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\PerformanceAssessment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users.index');

        $users = User::with(['role', 'performance_assesment'])
            ->whereHas('role', function ($q) {
                $q->where('slug', 'employee');
            })->get();

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('users.create');

        $roles = Role::select('id', 'name')->get();

        return view('backend.users.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'registration_code' => 'required|integer|unique:App\Models\User,registration_code',
            'name' => 'required|string|min:3|max:100',
            'username' => 'required|string|min:3|max:100|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'avatar' => 'required|image',
        ]);

        if ($validation->fails()) {
            notify()->error($validation->errors()->first());
            return back();
        }

        $user = User::create([
            'role_id' => $request->role,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'registration_code' => $request->registration_code,
        ]);

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        notify()->success('User berhasil ditambahkan');
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('backend.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('users.edit');

        $roles = Role::all();
        return view('backend.users.form', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $validation = Validator::make($request->all(), [
            'registration_code' => 'required|integer',
            'name' => 'required|string|min:3|max:100',
            'username' => 'nullable|string|min:3|max:100',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required',
        ]);

        if ($validation->fails()) {
            notify()->error($validation->errors()->first());
            return back();
        }

        $data = [
            'role_id' => $request->role,
            'name' => $request->name,
            'username' => $request->username,
            'status' => $request->status,
        ];

        if (isset($request->password) && $request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        notify()->success('User berhasil diperbarui');
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        Gate::authorize('users.destroy');

        $user->delete();

        notify()->success('User berhasil dihapus');
        return back();
    }
}
