<?php

namespace App\Filament\Vendors\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    protected function getRedirectUrl(): ?string
    {
        $vendor = auth('vendor')->user();

        if ($vendor && $vendor->must_change_password) {
            return '/vendor/change-password';
        }

        return '/vendor';
    }
}
