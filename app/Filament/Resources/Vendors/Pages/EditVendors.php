<?php

namespace App\Filament\Resources\Vendors\Pages;

use App\Filament\Resources\Vendors\VendorsResource;
use App\Mail\VendorReq_Approved;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Override;

class EditVendors extends EditRecord
{
    protected static string $resource = VendorsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    #[Override]
    protected function mutateFormDataBeforeFill(array $data): array
    {   if($data["status"] == "approved"){
        $password = rand(30000,99999);
        $data['password'] = Hash::make($password);
        Mail::to($data['email'])->send(new VendorReq_Approved($data,$password));
    }
        return parent::mutateFormDataBeforeFill($data);
    }
}
