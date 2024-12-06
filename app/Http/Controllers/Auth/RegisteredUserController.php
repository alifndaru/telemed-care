<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DataUser;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'jenis_kelamin' => ['required', 'string', 'max:2'],
            // 'tempat_lahir' => ['required', 'string', 'max:100'],
            // 'tanggal_lahir' => ['required', 'date'],
            // 'status_pernikahan' => ['required', 'string', 'max:2'],
            // 'agama' => ['required', 'string', 'max:50'],
            // 'no_telp' => ['required', 'string', 'max:20'],
            // 'alamat' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        DataUser::create([
            'user_id' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_pernikahan' => $request->status_pernikahan,
            'agama' => $request->agama,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        event(new Registered($user));

        // Mengirimkan pesan ke session
        session()->flash('status', 'Akun berhasil dibuat! Silahkan login.');

        // Auth::login($user);
        return redirect(to: '/login');
    }
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:100'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'jenis_kelamin' => ['required', 'string', 'max:2'],
    //         'tempat_lahir' => ['required', 'string', 'max:100'],
    //         'tanggal_lahir' => ['required', 'date'],
    //         'status_pernikahan' => ['required', 'string', 'max:20'],
    //         'agama' => ['required', 'string', 'max:50'],
    //         'no_telp' => ['required', 'string', 'max:20'],
    //         'alamat' => ['required', 'string', 'max:255'],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     DataUser::create([
    //         'user_id' => $user->id,
    //         'jenis_kelamin' => $request->jenis_kelamin,
    //         'tempat_lahir' => $request->tempat_lahir,
    //         'tanggal_lahir' => $request->tanggal_lahir,
    //         'status_pernikahan' => $request->status_pernikahan,
    //         'agama' => $request->agama,
    //         'no_telp' => $request->no_telp,
    //         'alamat' => $request->alamat,
    //     ]);

    //     dd($request->all());
    //     event(new Registered($user));

    //     session()->flash('status', 'Akun berhasil dibuat! Silahkan login.');

    //     return redirect(to: '/login');
    // }
}
