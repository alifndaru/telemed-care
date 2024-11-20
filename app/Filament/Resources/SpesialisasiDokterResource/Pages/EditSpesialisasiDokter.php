<?php

namespace App\Filament\Resources\SpesialisasiDokterResource\Pages;

use App\Filament\Resources\SpesialisasiDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpesialisasiDokter extends EditRecord
{
    protected static string $resource = SpesialisasiDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
