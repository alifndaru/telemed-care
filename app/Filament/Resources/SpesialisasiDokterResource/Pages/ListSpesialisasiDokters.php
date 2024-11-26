<?php

namespace App\Filament\Resources\SpesialisasiDokterResource\Pages;

use App\Filament\Resources\SpesialisasiDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpesialisasiDokters extends ListRecords
{
    protected static string $resource = SpesialisasiDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
