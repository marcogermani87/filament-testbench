<?php

namespace App\Filament\Pages\Auth;

use Filament\Schemas\Schema;
use Filament\Auth\Pages\Login as BaseLogin;
use MarcoGermani87\FilamentCaptcha\Forms\Components\CaptchaField;
use SensitiveParameter;

class Login extends BaseLogin
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'admin@example.com',
            'password' => '123Stella@',
            'remember' => true,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
                CaptchaField::make('captcha'),
            ]);
    }
}
