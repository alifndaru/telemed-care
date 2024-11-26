<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Define form fields here
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('dokter_name')
                    ->label('Dokter Name')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        $dokter = User::find($record->dokter_id);
                        return $dokter && $dokter->role_id == 3 ? $dokter->name : null;
                    }),
                TextColumn::make('klinik.namaKlinik')
                    ->label('Klinik Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jadwal.start')
                    ->label('Jadwal Start')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jadwal.end')
                    ->label('Jadwal End')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('voucher.kode_voucher')
                    ->label('Voucher Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('totalBiaya')
                    ->label('Total Biaya')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('buktiPembayaran')
                    ->label('Bukti Pembayaran')
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success') // Green when active
                    ->offColor('danger'), // Red when inactive
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
        ];
    }
}
