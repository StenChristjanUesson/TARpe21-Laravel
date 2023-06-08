<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf
            <label>{{ __('Booking date and time') }}
                <input type="datetime-local" name="booking_time" value="{{ old('booking_time') }}" step="900"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            </label>
            <x-input-error :messages="$errors->get('booking_time')" class="mt-2" />
            <label>{{ __('Service') }}
                <select name="service_id" id=""
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="0" disabled selected>{{ __('Select service') }}</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->name }}</option>
                    @endforeach
                </select>
            </label>
            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Add Booking') }}</x-primary-button>
        </form>
        @foreach ($bookings as $booking)
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <div>
                    <div class="flex justify-between items-center">
                        <div class="ml-2 text-sm text-gray-600">
                            Booking Time:<span class="text-lg text-gray-800"> {{ $booking->booking_time }}</span><br>
                            Server:<span class="text-lg text-gray-800"> {{ $booking->server->name }}</span><br>
                            @if (isset($booking->client))
                                Client:<span class="text-lg text-gray-800"> {{ $booking->client->name }}</span>
                            @endif
                            {{-- <small class="ml-2 text-sm text-gray-600">{{ $booking->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($booking->created_at->eq($booking->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless --}}
                        </div>
                        @if ($booking->server->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-4 w-4 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('bookings.edit', $booking)">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>
                    @if (isset($booking->service))
                        <div class="ml-2 text-sm text-gray-600">
                            Service:<span class="text-lg text-gray-800"> {{ $service->name }}</span><br>
                            <small class="ml-2 text-sm text-gray-600">Duration:
                                {{ $booking->service->duration_minutes }}minutes.</small>
                        </div>
                        <div class="ml-2 text-sm text-gray-600">
                            Base Price:<span class="text-lg text-gray-800">
                                {{ $booking->service->basePrice_cents / 100 }}€</span>
                        </div>
                        <p class="ml-2 my-4 text-gray-900">{{ $booking->service->description }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
