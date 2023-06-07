<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('bookings.update', $booking) }}">
            @csrf
            @method('patch')
            <label>{{ __('Booking date and time') }}
                                                                                                                        {{-- yyyy-MM-ddThh:mm --}}
                <input type="datetime-local" name="booking_time" value="{{ old('booking_time', \Carbon\Carbon::parse($booking->booking_time)->toDateTimeLocalString()) }}"
                    step="900"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </label>
                <x-input-error :messages="$errors->get('booking_time')" class="mt-2" />
                    <label>{{ __('Service')}}
                        <select name="service_id" id=""
                        class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="0" disabled selected>{{ __('Select service') }}</option>
                            @foreach ($services as $service)
                            <option value="{{$service->id}}" @selected(old('service_id',$booking->service_id)==$service->id) >{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <x-input-error :messages="$errors->get('service_id')" class="mt-2" />

            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('bookings.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
