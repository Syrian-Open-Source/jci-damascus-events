<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-logo-center class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ trans('global.texts.needs_approved') }}
        </div>
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <a class="btn btn-outline-primary" href="/">
            {{ trans('global.buttons.home') }} ?
        </a>
    </x-auth-card>
</x-guest-layout>
