<?php

namespace App\Filament\Vendors\Resources\Orders;

use App\Filament\Vendors\Resources\Orders\Pages\CreateOrder;
use App\Filament\Vendors\Resources\Orders\Pages\EditOrder;
use App\Filament\Vendors\Resources\Orders\Pages\ListOrders;
use App\Filament\Vendors\Resources\Orders\Schemas\OrderForm;
use App\Filament\Vendors\Resources\Orders\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
  public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('vendor_id', auth()->id());
}
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Order';

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
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
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
