@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <x-filament-panels::avatar.user
            size="lg"
            :user="$user"
            loading="lazy"
        />

        <div class="fi-account-widget-main">
            <h2 class="fi-account-widget-heading">
                {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}
            </h2>

            <p class="fi-account-widget-user-name">
                {{ filament()->getUserName($user) }}
            </p>
        </div>

        
        <x-filament::button
            color="gray"
            :icon="\Filament\Support\Icons\Heroicon::ArrowLeftEndOnRectangle"
            :icon-alias="\Filament\View\PanelsIconAlias::WIDGETS_ACCOUNT_LOGOUT_BUTTON"
            labeled-from="sm"
            tag="button"
            wire:click="goHome"
        >
            {{ __('filament/widgets/widgets.return_to_home') }}
        </x-filament::button>
        
    </x-filament::section>
</x-filament-widgets::widget>
