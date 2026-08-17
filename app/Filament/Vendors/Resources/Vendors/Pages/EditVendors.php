<?php

namespace App\Filament\Vendors\Resources\Vendors\Pages;

use App\Filament\Vendors\Resources\Vendors\VendorsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVendors extends EditRecord
{
    protected static string $resource = VendorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make()
            //DeleteAction::make(),
        ];
    }
}
