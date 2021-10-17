<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Models\Module;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('app.roles.index');

        $roles = Role::getAllRoles();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        Gate::authorize('app.roles.create');

        $modules = Module::getWithPermissions();
        return view('backend.roles.form', compact('modules'));
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ])
        ->permissions()
        ->sync($request->input('permissions', []));

        notify()->success('Role berhasil ditambahkan');
        return redirect()->route('app.roles.index');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        Gate::authorize('app.roles.edit');

        $modules = Module::all();
        return view('backend.roles.form', compact('role', 'modules'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        $role->permissions()->sync($request->input('permissions', []));

        notify()->success('Role berhasil disimpan');
        return redirect()->route('app.roles.index');
    }

    public function destroy(Role $role)
    {
        Gate::authorize('app.roles.destroy');

        if (! $role->deletable) {
            notify()->error('Role bawaan sistem tidak boleh dihapus');
            return back();
        }

        if (! $role->delete()) {
            notify()->error('Role gagal dihapus');
            return back();
        }

        notify()->success('Role berhasil dihapus');
        return back();
    }
}
