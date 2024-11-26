<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpesialisasiDokterResource\Pages;
use App\Filament\Resources\SpesialisasiDokterResource\RelationManagers;
use App\Models\SpesialisasiDokter;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpesialisasiDokterResource extends Resource
{
    protected static ?string $model = SpesialisasiDokter::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Users Management';
    protected static ?string $navigationLabel = 'Kategori Spesialisasi Dokter';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Spesialisasi')
                    ->required()
                    ->unique(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Spesialisasi')
                    ->searchable()
                    ->sortable(),

                ToggleColumn::make('status')
                    ->label('Status')
                    ->alignRight(),
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
            'index' => Pages\ListSpesialisasiDokters::route('/'),
            'create' => Pages\CreateSpesialisasiDokter::route('/create'),
            'edit' => Pages\EditSpesialisasiDokter::route('/{record}/edit'),
        ];
    }
}
