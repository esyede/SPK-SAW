<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\{
    Role,
    User,
    PerformanceAssessment,
};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users.index');

        $users = User::with('role')->whereHas('role', function ($q) {
            $q->where('slug', 'employee');
        })->with('performanceAssesment')
          ->get();

        return view('backend.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('users.create');

        $roles = Role::select('id', 'name')->get();;
        return view('backend.users.form', compact('roles'));
    }

    public function store(Request $request)
    {
        
        $user = User::create([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->filled('status'),
            'registration_code' => random_int(100000, 999999)
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

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status' => $request->filled('status'),
        ]);

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
