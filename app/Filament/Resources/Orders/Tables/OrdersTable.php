<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
          TextColumn::make('vendor.name')
    ->label('Vendor')
    ->url(fn ($record) =>
        OrderResource::getUrl('index', [
            'vendor' => $record->vendor_id,
        ])
    )
    ->searchable()
    ->sortable(),
                TextColumn::make('user.name'),
                TextColumn::make('shippingaddress.full_address')
                    ->label('ShippingAddress'),
                // TextColumn::make('vendors.name')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('payment_method')
                    ->badge(),
                TextColumn::make('payment_status')
                    ->searchable(),
                TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('vendor_id')
                    ->label('Vendor')
                    ->relationship('vendors', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
