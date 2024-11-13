<?php

namespace App\Filament\Resources\ModulKlinikResource\Pages;

use App\Filament\Resources\ModulKlinikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModulKlinik extends EditRecord
{
    protected static string $resource = ModulKlinikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
