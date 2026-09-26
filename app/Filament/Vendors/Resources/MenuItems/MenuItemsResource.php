<?php

namespace App\Filament\Vendors\Resources\MenuItems;

use App\Filament\Vendors\Resources\MenuItems\Pages\CreateMenuItems;
use App\Filament\Vendors\Resources\MenuItems\Pages\EditMenuItems;
use App\Filament\Vendors\Resources\MenuItems\Pages\ListMenuItems;
use App\Filament\Vendors\Resources\MenuItems\Schemas\MenuItemsForm;
use App\Filament\Vendors\Resources\MenuItems\Tables\MenuItemsTable;
use App\Models\MenuItems;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
class MenuItemsResource extends Resource
{         public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vendor_id'] = auth('vendor')->id();

        return $data;
    }
      public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('vendor_id', auth()->id());
}
    protected static ?string $model = MenuItems::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'tittle';

    public static function form(Schema $schema): Schema
    {
        return MenuItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuItemsTable::configure($table);
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
            'index' => ListMenuItems::route('/'),
            'create' => CreateMenuItems::route('/create'),
            'edit' => EditMenuItems::route('/{record}/edit'),
        ];
    }
}
