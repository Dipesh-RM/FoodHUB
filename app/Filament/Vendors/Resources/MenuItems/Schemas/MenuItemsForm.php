<?php

namespace App\Filament\Vendors\Resources\MenuItems\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MenuItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tittle')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('category_id')
    ->label('Category')
    ->options(function () {
        return \App\Models\Category::where(
            'vendor_id',
            auth('vendor')->id()
        )->pluck('name', 'id');
    })
    ->searchable()
    ->required()
    ->createOptionForm([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
    ])
  ->createOptionUsing(function (array $data) {
        $category = Category::create([
            'vendor_id' => auth('vendor')->id(),
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return $category->id;
    }),


                // TextInput::make('vendor_id')
                //     ->required()
                //     ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('NPR'),
                TextInput::make('dicount')
                    ->required()
                    ->numeric()
                    ->default(0),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                Select::make('status')
                    ->options(['enable' => 'Enable', 'disable' => 'Disable'])
                    ->default('enable')
                    ->required(),
            ]);
    }
}
