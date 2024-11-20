<?php

namespace App\Filament\Resources\SpesialisasiDokterResource\Pages;

use App\Filament\Resources\SpesialisasiDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSpesialisasiDokter extends CreateRecord
{
    protected static string $resource = SpesialisasiDokterResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
