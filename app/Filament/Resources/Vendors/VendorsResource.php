<?php

namespace App\Filament\Resources\Vendors;

use App\Filament\Resources\Vendors\Pages\CreateVendors;
use App\Filament\Resources\Vendors\Pages\EditVendors;
use App\Filament\Resources\Vendors\Pages\ListVendors;
use App\Filament\Resources\Vendors\Schemas\VendorsForm;
use App\Filament\Resources\Vendors\Tables\VendorsTable;
use App\Models\Vendors;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VendorsResource extends Resource
{
    protected static ?string $model = Vendors::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Vendors';

    public static function form(Schema $schema): Schema
    {
        return VendorsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VendorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVendors::route('/'),
            'create' => CreateVendors::route('/create'),
            'edit' => EditVendors::route('/{record}/edit'),
        ];
    }
}
