<!-- resources/views/profile/edit.blade.php -->

<x-jet-action-section>
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Profile details here...') }}
        </div>
    </x-slot>
</x-jet-action-section>
