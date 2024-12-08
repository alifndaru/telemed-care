<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserManagementResource\Pages;
use App\Models\Admin;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class UserManagementResource extends Resource
{
    protected static ?string $model = Admin::class;
    protected static ?string $navigationGroup = 'Admin Users Management';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('role_id')
                    ->relationship('roles', 'name')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                $role = \App\Models\Role::find($state);
                $roleName = optional($role)->name;  // Safe access
                    $set('roleName', $roleName);
                })
                ->required(),

                TextInput::make('name')
            ->required()
                    ->maxLength(255),

                TextInput::make('email')
            ->email()
                    ->required()
            ->unique('admins', 'email')
                    ->maxLength(255),

                TextInput::make('password')
            ->password()
                    ->required()
                    ->minLength(8)
            ->maxLength(255),

            Select::make('spesialis_id')
                ->label('Spesialis')
                ->relationship('spesialisasi', 'name')
                ->options(SpesialisasiDokter::all()->pluck('name', 'id'))
                ->visible(fn($get) => $get('roleName') == 'dokter')
                ->required(),

            Select::make('klinik_id')
                ->label('Klinik')
                ->relationship('klinik', 'namaKlinik')
                ->options(Klinik::all()->pluck('namaKlinik', 'id'))
            ->visible(fn($get) => $get('roleName') == 'dokter' || $get('roleName') == 'klinik')
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
    public static function getEloquentQuery(): Builder
    {
        // Get the currently authenticated admin
        $admin = auth()->guard('admin')->user();

        // Get the base query
        $query = parent::getEloquentQuery();

        // Filter by klinik_id for dokter or klinik role
        if ($admin && $admin->role && ($admin->role->name == 'dokter' || $admin->role->name == 'klinik')) {
            $query->where('klinik_id', $admin->klinik_id);
        }

        // Return the query, sorted by the latest
        return $query->latest();
    }


}
