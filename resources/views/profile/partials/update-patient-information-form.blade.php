<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Biodata Pasien') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Lengkapi data diri Anda untuk keperluan rekam medis dan pendaftaran.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.patient.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tgl_lahir" name="tgl_lahir" type="date" class="mt-1 block w-full" 
                :value="old('tgl_lahir', $user->pasien?->tgl_lahir)" required />
            <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="L" {{ old('gender', $user->pasien?->gender) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ old('gender', $user->pasien?->gender) === 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="no_hp" :value="__('Nomor WhatsApp / HP')" />
            <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" 
                :value="old('no_hp', $user->pasien?->no_hp)" required placeholder="08xxxxxxxx" />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>

        <div>
            <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
            <textarea id="alamat" name="alamat" rows="3" 
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                required placeholder="Nama Jalan, RT/RW, Kota">{{ old('alamat', $user->pasien?->alamat) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan Biodata') }}</x-primary-button>

            @if (session('status') === 'patient-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>