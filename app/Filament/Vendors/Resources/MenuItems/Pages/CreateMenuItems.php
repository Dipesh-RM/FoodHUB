<?php

namespace App\Filament\Vendors\Resources\MenuItems\Pages;

use App\Filament\Vendors\Resources\MenuItems\MenuItemsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMenuItems extends CreateRecord
{
    protected static string $resource = MenuItemsResource::class;
        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['vendor_id'] = auth('vendor')->id();

        return $data;
    }
}
