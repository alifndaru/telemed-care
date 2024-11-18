<?php

namespace App\Filament\Resources\ModulWebResource\Pages;

use App\Filament\Resources\ModulWebResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModulWeb extends CreateRecord
{
    protected static string $resource = ModulWebResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
