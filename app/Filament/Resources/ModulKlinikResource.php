<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModulKlinikResource\Pages;
use App\Models\Klinik;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;

class ModulKlinikResource extends Resource
{
    protected static ?string $model = Klinik::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationLabel = 'Manajemen Klinik';
    protected static ?string $pluralModelLabel = 'Klinik';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->description('Masukkan informasi dasar klinik')
                    ->schema([
                        TextInput::make('namaKlinik')
                            ->label('Nama Klinik')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama klinik')
                            ->unique(ignorable: fn($record) => $record),

                        TextInput::make('alamat')
                            ->label('Alamat Klinik')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan alamat lengkap')
                            ->columnSpan('full'),

                        TextInput::make('noTelp')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(20)
                            ->required()
                            ->placeholder('Contoh: 081234567890')
                            ->regex('/^[0-9]+$/'),

                        TextInput::make('email')
                            ->email()
                            ->label('Email Klinik')
                            ->maxLength(255)
                            ->required()
                            ->unique(ignorable: fn($record) => $record)
                            ->placeholder('contoh@klinik.com'),

                        FileUpload::make('logo')
                            ->label('Logo Klinik')
                            ->image() // Hanya menerima file gambar
                            ->imageResizeMode('contain')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('klinik-logos') // Direktori penyimpanan di storage
                            ->disk('public') // Disk penyimpanan
                            ->visibility('public') // Akses publik
                            ->preserveFilenames()
                            ->maxSize(2048) // 2MB
                            ->helperText('Format: JPG, PNG, GIF. Maksimal 2MB')
                            ->columnSpan('full'),
                    ])->columns(2),

                Section::make('Informasi Tambahan')
                    ->description('Masukkan informasi pendukung klinik')
                    ->schema([
                        TextInput::make('bank')
                            ->label('Nama Bank')
                            ->maxLength(100)
                            ->placeholder('Nama Bank'),

                        TextInput::make('noRekening')
                            ->label('Nomor Rekening')
                            ->maxLength(20)
                            ->placeholder('Nomor Rekening Bank')
                            ->regex('/^[0-9]+$/'),

                        TextInput::make('atasNama')
                            ->label('Atas Nama')
                            ->maxLength(100)
                            ->placeholder('Nama Pemilik Rekening'),

                        Checkbox::make('status')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Centang jika klinik aktif beroperasi'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->square()
                ->defaultImageUrl(url('images/kliniks/default-image.png'))
                    ->disk('public')
                    ->visibility('public'), // Tambahkan ini
                TextColumn::make('namaKlinik')
                    ->label('Nama Klinik')
                    ->sortable()
                    ->searchable()
                    ->wrap(),

                TextColumn::make('alamat')
                    ->label('Alamat Klinik')
                    ->sortable()
                    ->searchable()
                    ->wrap()
                    ->limit(50),

                TextColumn::make('noTelp')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip('Edit Klinik'),
                Tables\Actions\DeleteAction::make()
                    ->tooltip('Hapus Klinik'),
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
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModulKliniks::route('/'),
            'create' => Pages\CreateModulKlinik::route('/create'),
            'edit' => Pages\EditModulKlinik::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}
