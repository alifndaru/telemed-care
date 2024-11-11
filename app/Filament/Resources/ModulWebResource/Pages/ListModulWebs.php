<?php

namespace App\Filament\Resources\ModulWebResource\Pages;

use App\Filament\Resources\ModulWebResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModulWebs extends ListRecords
{
    protected static string $resource = ModulWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
