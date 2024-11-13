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

class ModulWebResource extends Resource
{
    protected static ?string $model = ModulWeb::class;
    protected static ?string $navigationGroup = 'Modul Web';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Website Settings';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([TextInput::make('namaWebsite')
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
                ->rows(3)
                ->maxLength(500),

            FileUpload::make('logo')
                ->label('Logo')
                ->image()
                ->required()
                ->maxSize(5024)
                ->directory('website-logos')
                ->visibility('public')
                ->imageResizeMode('contain')
                ->imageCropAspectRatio('16:9'),

            Textarea::make('metaDeskripsi')
                ->label('Meta Description')
                ->required()
                ->maxLength(160)
                ->rows(2),

            TextInput::make('metaKeyword')
                ->label('Meta Keywords')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ImageColumn::make('logo')
                ->label('Logo')
                ->size(50)
                ->circular(),

            TextColumn::make('namaWebsite')
                ->label('Nama Website')
                ->searchable()
                ->sortable(),

            TextColumn::make('Email')
                ->label('Email')
                ->searchable()
                ->sortable(),

            TextColumn::make('noTelp')
                ->label('Nomor Telepon')
                ->searchable(),

            TextColumn::make('alamat')
                ->label('Alamat')
                ->limit(50)
                ->searchable(),

            TextColumn::make('metaDeskripsi')
                ->label('Meta Description')
                ->limit(50)
                ->searchable(),

            TextColumn::make('metaKeyword')
                ->label('Meta Keywords')
                ->limit(50)
                ->searchable(),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
