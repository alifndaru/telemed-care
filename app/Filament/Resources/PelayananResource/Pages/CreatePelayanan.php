<?php

namespace App\Filament\Resources\PelayananResource\Pages;

use App\Filament\Resources\PelayananResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePelayanan extends CreateRecord
{
    protected static string $resource = PelayananResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
