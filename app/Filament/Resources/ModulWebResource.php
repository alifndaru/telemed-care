<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModulWebResource\Pages;
use App\Filament\Resources\ModulWebResource\RelationManagers;
use App\Models\ModulWeb;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ModulWebResource extends Resource
{
    protected static ?string $model = ModulWeb::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('namaWebsite'),
                TextInput::make('Email'),
                TextInput::make('noTelp'),
                TextInput::make('alamat'),
                FileUpload::make('logo'),
                TextInput::make('metaDeskripsi'),
                TextInput::make('metaKeyword'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('namaWebsite'),
                TextColumn::make('Email'),
                TextColumn::make('noTelp'),
                TextColumn::make('alamat'),
                TextColumn::make('metaDeskripsi'),
                TextColumn::make('metaKeyword'),
                ImageColumn::make('logo')->size(50),
            ])
            ->filters([
                //
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
        return [
            //
        ];
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
