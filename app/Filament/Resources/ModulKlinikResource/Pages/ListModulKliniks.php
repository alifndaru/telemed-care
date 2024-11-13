<?php

namespace App\Filament\Resources\ModulKlinikResource\Pages;

use App\Filament\Resources\ModulKlinikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModulKliniks extends ListRecords
{
    protected static string $resource = ModulKlinikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
