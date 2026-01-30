<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <x-input-label for="airport" :value="__('Airport Name')" :required="true" />
            <x-text-input id="airport" name="airport" type="text" :value="old('airport', $airportCode?->airport)" required autofocus />
            <x-input-error :messages="$errors->get('airport')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="airport_type" :value="__('Airport Type')" :required="true" />
            <x-text-input id="airport_type" name="airport_type" type="text" :value="old('airport_type', $airportCode?->airport_type)" required />
            <x-input-error :messages="$errors->get('airport_type')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="city" :value="__('City')" :required="true" />
            <x-text-input id="city" name="city" type="text" :value="old('city', $airportCode?->city)" required />
            <x-input-error :messages="$errors->get('city')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="country" :value="__('Country')" :required="true" />
            <x-text-input id="country" name="country" type="text" :value="old('country', $airportCode?->country)" required />
            <x-input-error :messages="$errors->get('country')" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label for="iata" :value="__('IATA Code')" :required="true" />
            <x-text-input id="iata" name="iata" type="text" :value="old('iata', $airportCode?->iata)" required maxlength="10" class="text-uppercase" />
            <x-input-error :messages="$errors->get('iata')" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label for="icao" :value="__('ICAO Code')" :required="true" />
            <x-text-input id="icao" name="icao" type="text" :value="old('icao', $airportCode?->icao)" required maxlength="10" class="text-uppercase" />
            <x-input-error :messages="$errors->get('icao')" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label for="faa" :value="__('FAA Code')" :required="true" />
            <x-text-input id="faa" name="faa" type="text" :value="old('faa', $airportCode?->faa)" required maxlength="10" class="text-uppercase" />
            <x-input-error :messages="$errors->get('faa')" />
        </div>

        <div class="col-12 pt-2">
            <x-primary-button>
                {{ $airportCode ? __('Update Airport Code') : __('Create Airport Code') }}
            </x-primary-button>
            <a href="{{ route('airport-codes.index') }}" class="btn btn-outline-secondary ms-2">
                {{ __('Cancel') }}
            </a>
        </div>
    </div>
</form>