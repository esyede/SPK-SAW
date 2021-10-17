<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        Gate::authorize('app.backups.index');

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));

        $backups = [];

        foreach ($files as $key => $file) {
            if (substr($file, -4) === '.zip' && $disk->exists($file)) {
                $file_name = str_replace(config('backup.backup.name') . '/', '', $file);
                $backups[] = [
                    'file_path' => $file,
                    'file_name' => $file_name,
                    'file_size' => $this->bytesToHuman($disk->size($file)),
                    'created_at' => Carbon::parse($disk->lastModified($file))->diffForHumans(),
                    'download_link' => route('app.backups.download', [$file_name]),
                ];
            }
        }

        $backups = array_reverse($backups);
        return view('backend.backups', compact('backups'));
    }

    private function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Gate::authorize('app.backups.create');

        Artisan::call('backup:run');

        notify()->success('Backup berhasil dibuat');
        return back();
    }

    public function download(Request $request, $file_name)
    {
        Gate::authorize('app.backups.download');

        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists($file)) {
            $fs = $disk->getDriver();
            $stream = $fs->readStream($file);
            $headers = [
                'Content-Type' => $fs->getMimetype($file),
                'Content-Length' => $fs->getSize($file),
                'Content-disposition' => 'attachment; filename="' . basename($file) . '"',
            ];

            return response()->stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, $headers);
        }

        return abort(404);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($file_name)
    {
        Gate::authorize('app.backups.destroy');

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $folder = config('backup.backup.name');

        if ($disk->exists($folder . '/' . $file_name)) {
            $disk->delete($folder . '/' . $file_name);
        }

        notify()->success('Backup berhasil dihapus');
        return back();
    }

    public function clean()
    {
        Gate::authorize('app.backups.destroy');

        Artisan::call('backup:clean');

        notify()->success('Seluruh backup lama berhasil dihapus');
        return back();
    }
}
