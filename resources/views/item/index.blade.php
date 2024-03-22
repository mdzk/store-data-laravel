<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('item.store') }}">
        @csrf

        <!-- Item name -->
        <div>
            <x-input-label for="name" :value="__('Item Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                autofocus placeholder="Book" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Item quantity -->
        <div>
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input id="quantity" class="block w-full mt-1" type="number" name="quantity" :value="old('quantity')"
                required placeholder="5" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-3">
                {{ __('Add') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
