<?php

namespace App\Filament\Vendors\Resources\MenuItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('tittle')
                ->label('Menu Item')
                    ->searchable(),

                // TextColumn::make('vendor_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('price')
                    ->money('NPR')
                    ->sortable(),
                TextColumn::make('dicount')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image'),
                TextColumn::make('status')
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
            ->groups([
            Group::make('category.name')
                ->label('Category')
                ->collapsible(),
        ])

        ->defaultGroup('category.name')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
