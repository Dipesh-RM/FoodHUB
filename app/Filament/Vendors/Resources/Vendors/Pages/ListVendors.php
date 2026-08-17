<?php

namespace App\Filament\Vendors\Resources\Vendors\Pages;

use App\Filament\Vendors\Resources\Vendors\VendorsResource;

use Filament\Resources\Pages\ListRecords;

class ListVendors extends ListRecords
{
    protected static string $resource = VendorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // CreateAction::make(),
        ];
    }
}
