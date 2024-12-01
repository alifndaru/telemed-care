<?php

namespace App\Livewire\Konsultasi;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Province;
use App\Models\Klinik;
use App\Models\Jadwal;
use App\Models\User; // For doctors and users
use App\Models\Transaction;
use App\Models\Voucher;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Histori extends Component {}
