<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Integrity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Integrity\StoreIntegrityRequest;
use App\Http\Requests\Integrity\UpdateIntegrityRequest;

class IntegrityController extends Controller
{
    public function index()
    {
        Gate::authorize('integrity.index');

        $integrities = Integrity::all();
        return view('backend.integrity.index', compact('integrities'));
    }

    public function create()
    {
        Gate::authorize('integrity.create');

        return view('backend.integrity.create');
    }

    public function store(StoreIntegrityRequest $request)
    {
        Gate::authorize('integrity.create');

        $integrity = Integrity::create($request->validated());

        if (! $integrity) {
            notify()->error('Gagal menambahkan pembobotan nilai');
            return back();
        }

        notify()->success('Pembobotan nilai berhasil ditambahkan');
        return redirect()->route('integrity.index');
    }

    public function edit(Request $request, $id)
    {
        Gate::authorize('integrity.edit');

        $integrity = Integrity::find($id);

        if (! $integrity) {
            notify()->error('Pembobotan nilai tidak ditemukan');
            return back();
        }

        return view('backend.integrity.edit', compact('integrity'));
    }

    public function update(UpdateIntegrityRequest $request, $id)
    {
        $integrity = Integrity::find($id);

        if (! $integrity) {
            notify()->error('Pembobotan nilai tidak ditemukan');
            return back();
        }

        $integrity->update($request->validated());

        notify()->success('Pembobotan nilai berhasil diperbarui');
        return redirect()->route('integrity.index');
    }

    public function destroy($id)
    {
        Gate::authorize('integrity.destroy');

        $integrity = Integrity::find($id);

        if (! $integrity) {
            notify()->error('Pembobotan nilai tidak ditemukan');
            return back();
        }

        $integrity->delete();

        notify()->success('Pembobotan nilai berhasil dihapus');
        return back();
    }
}
