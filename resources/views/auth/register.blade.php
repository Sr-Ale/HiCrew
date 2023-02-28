
<x-guest-layout>
    @php
        include '../config.php';

        $usedCallsigns = [];
        $i = 0;
    @endphp
    @if($va_register == 0)
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->

        <div>
            <x-input-label for="name" :value="__('messages.name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="callsign" :value="__('messages.callsign')" />
            <select id="callsign" name="callsign" class="block mt-1 w-full">

            {{$va_icao}}
            @php
                    $callsigns = array_map(function($n) { return sprintf('%03d',$n); }, range(1, 999) );
            @endphp

            @foreach(\App\Models\User::orderBy('callsign','ASC')->get() as $item)
                @php
                    $usedCallsigns[$i] = $item->callsign;
                    $i++;
                @endphp
            @endforeach
            @foreach($callsigns as $callsigns)
                @php
                    $callsigns = $va_icao . $callsigns;

                        if (in_array($callsigns, $usedCallsigns)) {
                            continue;
                        }
                        echo "<option value='$callsigns'>Callsign: $callsigns</option>";
                @endphp

            @endforeach

            </select>
            <x-input-error :messages="$errors->get('callsign')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="ivao" :value="__('messages.ivao')" />
            <x-text-input id="ivao" class="block mt-1 w-full" type="number" name="ivao" :value="old('ivao')" required />
            <x-input-error :messages="$errors->get('ivao')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-input-label for="vatsim" :value="__('messages.vatsim')" />
            <x-text-input id="vatsim" class="block mt-1 w-full" type="number" name="vatsim" :value="old('vatsim')" />
            <x-input-error :messages="$errors->get('vatsim')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date" :value="__('messages.date')" />
            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('messages.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('messages.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('messages.repitpassword')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('messages.already') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('messages.register') }}
            </x-primary-button>
        </div>
    </form>
    @else
    <center>{{__('messages.no_register_permit')}}</center>
    @endif
</x-guest-layout>
