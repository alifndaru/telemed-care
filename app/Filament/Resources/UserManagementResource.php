<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserManagementResource\Pages;
use App\Models\User;
use App\Models\Spesialis;
use App\Models\Klinik;
use App\Models\Pelayanan;
use App\Models\SpesialisasiDokter;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class UserManagementResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Users Management';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8)
            ->maxLength(255),
            Select::make('role_id')
            ->relationship('roles', 'name')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $roleName = \App\Models\Role::find($state)?->name;
                    $set('roleName', $roleName);
                })
                ->required(),

            Select::make('spesialis_id')
                ->label('Spesialis')
                ->relationship('spesialis', 'name')
                ->options(SpesialisasiDokter::all()->pluck('name', 'id'))
                ->visible(fn($get) => $get('roleName') == 'dokter')
                ->required(),

            Select::make('klinik_id')
                ->label('Klinik')
                ->relationship('klinik', 'namaKlinik')
                ->options(Klinik::all()->pluck('namaKlinik', 'id'))
                ->visible(fn($get) => $get('roleName') == 'dokter')
                ->required(),

            Select::make('pelayanan_id')
                ->label('Pelayanan')
                ->relationship('pelayanan', 'name')
                ->options(Pelayanan::all()->pluck('name', 'id'))
                ->visible(fn($get) => $get('roleName') == 'dokter')
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable(),
            TextColumn::make('roles.name')
                    ->label('Role')
                    ->sortable(),
            ])
            ->filters([
                // Add any filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Add any relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserManagement::route('/'),
            'create' => Pages\CreateUserManagement::route('/create'),
            'edit' => Pages\EditUserManagement::route('/{record}/edit'),
        ];
    }
}
