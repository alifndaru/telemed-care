<?php

namespace App\Filament\Resources\ModulKlinikResource\Pages;

use App\Filament\Resources\ModulKlinikResource;
use Filament\Resources\Pages\Page;
use App\Models\Jadwal;
use App\Models\Klinik;
use Filament\Forms;
use App\Models\User;
use Filament\Notifications\Notification;

class AddJadwalDokter extends Page
{
    protected static string $resource = ModulKlinikResource::class;
    protected static ?string $model = Jadwal::class;
    protected static string $view = 'filament.pages.modul-klinik-resource.add-jadwal-dokter';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $title = 'Add Doctor Schedule';

    public $users_id;
    public $klinik_id;
    public $start;
    public $end;
    public $kuota;

    // Form schema definition
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('users_id')
                ->label('Doctor')
                ->options(User::where('role_id', '3')->pluck('name', 'id')->filter())
                ->required(),

            Forms\Components\Select::make('klinik_id')
                ->label('Clinic')
                ->options(Klinik::all()->pluck('namaKlinik', 'id')->filter())
                ->required(),

            Forms\Components\TimePicker::make('start')
                ->label('Start Time')
                ->required(),

            Forms\Components\TimePicker::make('end')
                ->label('End Time')
                ->required(),

            Forms\Components\TextInput::make('kuota')
                ->label('Quota')
                ->numeric()
                ->required(),
        ];
    }

    // Handle form submission
    public function submit()
    {
        $this->validate();

        // Save the doctor's schedule to the database
        Jadwal::create([
            'users_id' => $this->users_id,
            'klinik_id' => $this->klinik_id,
            'start' => $this->start,
            'end' => $this->end,
            'kuota' => $this->kuota,
        ]);

        // Optionally, redirect or display success message
        Notification::make()
            ->title('Success')
            ->body('Doctor schedule added successfully!')
            ->success()
            ->send();
        $this->redirect(ModulKlinikResource::getUrl('index'));
    }

    public function mount()
    {
        $this->form->fill();
    }
}
