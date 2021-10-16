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
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.settings.general');
    }

    public function update(UpdateGeneralSettingsRequest $request)
    {
        Setting::updateSettings($request->validated());
        Artisan::call('env:set APP_NAME='. $request->site_title);

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
        Setting::updateSettings($request->validated());

        Artisan::call('env:set MAIL_MAILER=' . $request->mail_mailer);
        Artisan::call('env:set MAIL_HOST=' . $request->mail_host);
        Artisan::call('env:set MAIL_PORT=' . $request->mail_port);
        Artisan::call('env:set MAIL_USERNAME=' . $request->mail_username);
        Artisan::call('env:set MAIL_PASSWORD=' . $request->mail_password);
        Artisan::call('env:set MAIL_ENCRYPTION=' . $request->mail_encryption);
        Artisan::call('env:set MAIL_FROM_ADDRESS=' . $request->mail_from_address);
        Artisan::call('env:set MAIL_FROM_NAME=' . $request->mail_from_name);

        notify()->success('Pengaturan berhasil disimpan');
        return back();
    }

    public function socialite()
    {
        return view('backend.settings.socialite');
    }

    public function updateSocialiteSettings(UpdateSocialiteSettingsRequest $request)
    {
        Setting::updateSettings($request->validated());

        Artisan::call('env:set FACEBOOK_CLIENT_ID='. $request->facebook_client_id);
        Artisan::call('env:set FACEBOOK_CLIENT_SECRET='. $request->facebook_client_secret);

        Artisan::call('env:set GOOGLE_CLIENT_ID='. $request->google_client_id);
        Artisan::call('env:set GOOGLE_CLIENT_SECRET='. $request->google_client_secret);

        Artisan::call('env:set GITHUB_CLIENT_ID='. $request->github_client_id);
        Artisan::call('env:set GITHUB_CLIENT_SECRET='. $request->github_client_secret);

        notify()->success('Pengaturan berhasil disimpan');
        return back();
    }
}
