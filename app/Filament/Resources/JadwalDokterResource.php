<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalDokterResource\Pages;
use App\Models\Admin;
use App\Models\Jadwal;
use App\Models\Klinik;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Illuminate\Support\Facades\Auth;

class JadwalDokterResource extends Resource
{
    protected static ?string $model = Jadwal::class;
    protected static ?string $navigationGroup = 'Modul Klinik'; // Organize navigation
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('users_id')
                    ->label('Doctor')
                    ->options(
                Admin::whereHas('role', function ($query) {
                            $query->where('name', 'dokter'); // Filter by role name 'dokter'
                        })
                        ->where('klinik_id', Auth::user()->klinik_id) // Filter by the same klinik_id as the logged-in user
                        ->pluck('name', 'id')
                        ->toArray()
                    )
                    ->required()
                    ->searchable(),

                Select::make('klinik_id')
                    ->label('Clinic')
                    ->options(Klinik::pluck('namaKlinik', 'id')->toArray())
                    ->required()
                    ->searchable()
                // ->default(fn() => Auth::user()->klinik_id)
                ->default(fn() => Auth::user()->klinik_id)
            ->disabled(fn() => Auth::user() && Auth::user()->role && Auth::user()->role->name == 'klinik'),
                Hidden::make('klinik_id')
                    ->default(fn() => Auth::user()->klinik_id)
                    ->required(),

                TimePicker::make('start')
                    ->label('Start Time')
                ->required()
                ->format('H:i'),

                TimePicker::make('end')
                    ->label('End Time')
                ->required()
                ->format('H:i'),

                TextInput::make('biaya')
                    ->label('Cost')
                    ->numeric() // Ensure cost is a numeric value
                    ->required(),

                TextInput::make('kuota')
                    ->label('Quota')
                    ->numeric() // Ensure quota is numeric
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn() => Jadwal::where('klinik_id', Auth::user()->klinik_id)) // Filter by klinik_id of the logged-in user
            ->columns([TextColumn::make('admins.name')
                    ->label('Doctor')
                    ->sortable()
                    ->searchable(), // Enable search by doctor's name

                TextColumn::make('klinik.namaKlinik')
                    ->label('Clinic')
                    ->sortable()
                    ->searchable(), // Enable search by clinic name

                TextColumn::make('start')
                    ->label('Start Time')
                    ->sortable(),

                TextColumn::make('end')
                    ->label('End Time')
                    ->sortable(),

                TextColumn::make('kuota')
                    ->label('Quota')
                    ->sortable(),

                TextColumn::make('biaya')
                    ->label('Cost')
                    ->sortable(), // Make cost sortable for easy comparison

                ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success') // Green when active
                    ->offColor('danger'), // Red when inactive
            ])
            ->filters([
                // You can add filters here if needed, e.g., to filter by status or doctor
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(), // Enable delete action for each row
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(), // Enable bulk delete
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relations here if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalDokters::route('/'),
            'create' => Pages\CreateJadwalDokter::route('/create'),
            'edit' => Pages\EditJadwalDokter::route('/{record}/edit'),
        ];
    }
}
