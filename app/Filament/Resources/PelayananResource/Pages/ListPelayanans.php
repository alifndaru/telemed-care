<?php

namespace App\Filament\Resources\PelayananResource\Pages;

use App\Filament\Resources\PelayananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelayanans extends ListRecords
{
    protected static string $resource = PelayananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
