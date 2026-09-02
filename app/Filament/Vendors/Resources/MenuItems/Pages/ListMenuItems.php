<?php

namespace App\Filament\Vendors\Resources\MenuItems\Pages;

use App\Filament\Vendors\Resources\MenuItems\MenuItemsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMenuItems extends ListRecords
{
    protected static string $resource = MenuItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
