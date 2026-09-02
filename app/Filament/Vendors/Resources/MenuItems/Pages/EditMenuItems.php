<?php

namespace App\Filament\Vendors\Resources\MenuItems\Pages;

use App\Filament\Vendors\Resources\MenuItems\MenuItemsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuItems extends EditRecord
{
    protected static string $resource = MenuItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
