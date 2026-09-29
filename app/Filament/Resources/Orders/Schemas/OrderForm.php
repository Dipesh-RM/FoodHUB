<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('shipping_address_id')
                    ->required()
                    ->numeric(),
                TextInput::make('vendor_id')
                    ->required()
                    ->numeric(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Select::make('payment_method')
                    ->options(['cod' => 'Cod', 'online' => 'Online'])
                    ->default('cod')
                    ->required(),
                TextInput::make('payment_status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
