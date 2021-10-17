<div class="list-group">
    <a href="{{ route('settings.index') }}" class="list-group-item list-group-item-action {{ Route::is('settings.index') ? 'active' : ''  }}">
        Dasar
    </a>
    <a href="{{ route('settings.appearance.index') }}" class="list-group-item list-group-item-action {{ Route::is('settings.appearance.index') ? 'active' : ''  }}">
        Tampilan
    </a>
    <a href="{{ route('settings.mail.index') }}" class="list-group-item list-group-item-action {{ Route::is('settings.mail.index') ? 'active' : ''  }}">
        Email
    </a>
    <a href="{{ route('settings.socialite.index') }}" class="list-group-item list-group-item-action {{ Route::is('settings.socialite.index') ? 'active' : ''  }}">
        Socialite
    </a>
</div>
