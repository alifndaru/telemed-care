<?php

namespace App\Filament\Resources\ModulWebResource\Pages;

use App\Filament\Resources\ModulWebResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModulWeb extends EditRecord
{
    protected static string $resource = ModulWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
