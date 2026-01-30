<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="row g-3">
        <div class="col-12 col-md-6">
            <x-input-label for="airport" :value="__('Airport Name')" />
            <x-text-input id="airport" name="airport" type="text" :value="old('airport', $airportCode?->airport)" autofocus />
            <x-input-error :messages="$errors->get('airport')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="iata_code" :value="__('IATA Code')" />
            <x-text-input id="iata_code" name="iata_code" type="text" :value="old('iata_code', $airportCode?->iata_code)" maxlength="10" class="text-uppercase" />
            <x-input-error :messages="$errors->get('iata_code')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" :value="old('city', $airportCode?->city)" />
            <x-input-error :messages="$errors->get('city')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="iso_country" :value="__('ISO Country')" />
            <x-text-input id="iso_country" name="iso_country" type="text" :value="old('iso_country', $airportCode?->iso_country)" />
            <x-input-error :messages="$errors->get('iso_country')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="iso_region" :value="__('ISO Region')" />
            <x-text-input id="iso_region" name="iso_region" type="text" :value="old('iso_region', $airportCode?->iso_region)" />
            <x-input-error :messages="$errors->get('iso_region')" />
        </div>

        <div class="col-12 col-md-6">
            <x-input-label for="icao_code" :value="__('ICAO Code')" />
            <x-text-input id="icao_code" name="icao_code" type="text" :value="old('icao_code', $airportCode?->icao_code)" maxlength="10" class="text-uppercase" />
            <x-input-error :messages="$errors->get('icao_code')" />
        </div>

        <div class="col-12">
            <x-input-label for="coordinates" :value="__('Coordinates')" />
            <x-text-input id="coordinates" name="coordinates" type="text" :value="old('coordinates', $airportCode?->coordinates)" />
            <x-input-error :messages="$errors->get('coordinates')" />
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