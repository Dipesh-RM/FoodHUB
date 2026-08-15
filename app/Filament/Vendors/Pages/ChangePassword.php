<?php

namespace App\Filament\Vendors\Pages;

use App\Models\Vendors;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.vendors.pages.change-password';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public ?array $data = [];

   public function form($form)
{
    return $form
        ->schema([
            TextInput::make('current_password')
                ->label('Current Password')
                ->password()
                ->required(),

            TextInput::make('password')
                ->label('New Password')
                ->password()
                ->required()
                ->minLength(8),

            TextInput::make('password_confirmation')
                ->label('Confirm New Password')
                ->password()
                ->required(),
        ])
        ->statePath('data');
}

    public function changePassword(): void
{
    $this->validate([
        'data.current_password' => ['required'],
        'data.password' => [
            'required',
            'min:8',
            'same:data.password_confirmation',
        ],
    ]);

    $vendor = Vendors::find(auth('vendor')->id());

    if (! $vendor) {
        return;
    }

    if (! Hash::check($this->data['current_password'], $vendor->password)) {
        $this->addError(
            'data.current_password',
            'The current password is incorrect.'
        );

        return;
    }

    $vendor->password = $this->data['password'];
    $vendor->must_change_password = false;
    $vendor->save();

    Notification::make()
        ->title('Password changed successfully')
        ->success()
        ->send();

    $this->redirect('/vendor');
}
}
