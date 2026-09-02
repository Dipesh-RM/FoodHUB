<?php

namespace App\Filament\Vendors\Resources\Vendors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VendorsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                // TextInput::make('password')
                //     ->password()
                //     ->default(null),
                TextInput::make('company_name')
                    ->required(),
                TextInput::make('reg_no')
                    ->required(),
                FileUpload::make('logo')
                    ->required(),
                TextInput::make('contact_no')
                    ->required(),
                // TextInput::make('city')
                //     ->required()
                //     ->maxLength(100),

                // Textarea::make('address')
                //     ->required()
                //     ->rows(3),

                // TextInput::make('latitude')
                //     ->numeric()
                //     ->nullable(),

                // TextInput::make('longitude')
                //     ->numeric()
                //     ->nullable(),
                // Select::make('status')
                //     ->options(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'])
                //     ->default('pending')
                //     ->required(),
                // Toggle::make('must_change_password')
                //     ->required(),
            ]);
    }
}
