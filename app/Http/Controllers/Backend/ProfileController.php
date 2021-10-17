<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        Gate::authorize('profile.update');

        return view('backend.profile.index');
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        notify()->success('Profil berhasil disimpan');
        return back();
    }

    public function changePassword()
    {
        Gate::authorize('profile.password');

        return view('backend.profile.security');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $hashedPassword = Auth::user()->password;

        if (! Hash::check($request->current_password, Auth::user()->password)) {
            notify()->error('Password lama salah');
            return back();
        }

        if (Hash::check($request->password, $hashedPassword)) {
            notify()->error('Password baru harus berbeda dengan password lama');
            return back();
        }

        Auth::user()->update(['password' => Hash::make($request->password)]);
        Auth::logout();

        notify()->success('Password berhasil diubah');
        return redirect()->route('login');
    }
}
