<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    public function mount(): void
    {
        $this->form->fill([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
    }
}