<?php

namespace App\Filament\Vendors\Resources\Orders\Pages;

use App\Filament\Vendors\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
