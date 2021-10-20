<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateGeneralSettingsRequest;
use App\Http\Requests\Settings\UpdateAppearanceRequest;
use App\Http\Requests\Settings\UpdateMailSettingsRequest;
use App\Http\Requests\Settings\UpdateSocialiteSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use msztorc\LaravelEnv\Env;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.settings.general');
    }

    public function update(UpdateGeneralSettingsRequest $request)
    {
        Setting::change($request->validated());

        $env = new Env();
        $env->setValue('APP_NAME', (string) $request->site_title);

        notify()->success('Pengaturan berhasil disimpan');
        return back();
    }

    public function appearance()
    {
        return view('backend.settings.appearance');
    }

    public function updateAppearance(UpdateAppearanceRequest $request)
    {
        if ($request->hasFile('site_logo')) {
            $this->deleteOldLogo(config('settings.site_logo'));
            Setting::set('site_logo', Storage::disk('public')->putFile('logos', $request->file('site_logo')));
        }

        if ($request->hasFile('site_favicon')) {
            $this->deleteOldLogo(config('settings.site_favicon'));
            Setting::set('site_favicon', Storage::disk('public')->putFile('logos', $request->file('site_favicon')));
        }

        notify()->success('Pengaturan berhasil disimpan');
        return back();
    }

    private function deleteOldLogo($path)
    {
        Storage::disk('public')->delete($path);
    }

    public function mail()
    {
        return view('backend.settings.mail');
    }

    public function updateMailSettings(UpdateMailSettingsRequest $request)
    {
        Setting::change($request->validated());

        $env = new Env();
        $env->setValue('MAIL_MAILER', (string) $request->mail_mailer);
        $env->setValue('MAIL_HOST', (string) $request->mail_host);
        $env->setValue('MAIL_PORT', (string) $request->mail_port);
        $env->setValue('MAIL_USERNAME', (string) $request->mail_username);
        $env->setValue('MAIL_PASSWORD', (string) $request->mail_password);
        $env->setValue('MAIL_ENCRYPTION', (string) $request->mail_encryption);
        $env->setValue('MAIL_FROM_ADDRESS', (string) $request->mail_from_address);
        $env->setValue('MAIL_FROM_NAME', (string) $request->mail_from_name);

        notify()->success('Pengaturan berhasil disimpan');
        return back();
    }
}
