<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updatePatient(Request $request): \Illuminate\Http\RedirectResponse
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'tgl_lahir' => ['required', 'date'],
            'gender'    => ['required', 'in:L,P'],
            'no_hp'     => ['required', 'string', 'max:15'],
            'alamat'    => ['required', 'string', 'max:500'],
        ]);

        // 2. Update Data di tabel 'pasiens'
        // updateOrCreate berguna: jika data belum ada dia buat, jika sudah ada dia update.
        $request->user()->pasien()->updateOrCreate(
            ['user_id' => $request->user()->id], // Kondisi pencarian
            $validated                           // Data yang disimpan
        );

        return redirect()->route('profile.edit')->with('status', 'patient-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
