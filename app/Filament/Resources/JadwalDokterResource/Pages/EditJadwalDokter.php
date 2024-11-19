<?php

namespace App\Filament\Resources\JadwalDokterResource\Pages;

use App\Filament\Resources\JadwalDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalDokter extends EditRecord
{
    protected static string $resource = JadwalDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
