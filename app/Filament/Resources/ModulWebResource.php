<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModulWebResource\Pages;
use App\Models\ModulWeb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;

class ModulWebResource extends Resource
{
    protected static ?string $model = ModulWeb::class;
    protected static ?string $navigationGroup = 'Modul Web';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('namaWebsite')
                    ->label('Nama Website')
                    ->required()
                    ->maxLength(255),

            TextInput::make('Email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            TextInput::make('noTelp')
                ->label('Nomor Telepon')
                ->tel()
                ->required()
                ->maxLength(20),

            Textarea::make('alamat')
                ->label('Alamat')
                ->required()
                ->maxLength(500),

            FileUpload::make('logo')
                ->label('Logo')
                ->image()
                ->required()
            ->maxSize(5024)
            ->directory('website-logos'),

            Textarea::make('metaDeskripsi')
                ->label('Meta Description')
                ->required()
            ->maxLength(160),

            TextInput::make('metaKeyword')
                ->label('Meta Keywords')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('namaWebsite')
                    ->label('Nama Website')
                    ->searchable()
                    ->sortable(),

            TextColumn::make('Email')
                ->label('Email')
            ->searchable(),

            TextColumn::make('noTelp')
            ->label('Nomor Telepon'),

            TextColumn::make('alamat')
                ->label('Alamat')
            ->limit(50),

            ImageColumn::make('logo')
            ->label('Logo')
            ->size(50),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            Action::make('detail')
            ->label('Detail')
            ->icon('heroicon-o-eye')
            ->color('primary')
            ->modalContent(fn(ModulWeb $record) => view(
                'filament.modals.modul-web-details',
                ['modulWeb' => $record]
            ))
                ->modalSubmitAction(false)
                ->modalCancelAction(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModulWebs::route('/'),
            'create' => Pages\CreateModulWeb::route('/create'),
            'edit' => Pages\EditModulWeb::route('/{record}/edit'),
        ];
    }
}
