# Outdated Composer and npm Dependencies card for Laravel Pulse

This card will show you outdated Composer and npm dependencies.

## Installation

Require the package with Composer:

```shell
composer require aaronfrancis/pulse-outdated
```

## Register the recorder

Right now, the Composer and npm dependencies will only be checked once per day. To run the checks you must add the `OutdatedRecorder` to the `pulse.php` file.

```diff
return [
    // ...
    
    'recorders' => [
+        \AaronFrancis\Pulse\Outdated\Recorders\OutdatedRecorder::class => [],
    ]
]
```

You also need to be running [the `pulse:check` command](https://laravel.com/docs/10.x/pulse#dashboard-cards).

## Add to your dashboard

To add the card to the Pulse dashboard, you must first [publish the vendor view](https://laravel.com/docs/10.x/pulse#dashboard-customization).

Then, you can modify the `dashboard.blade.php` file:

```diff
<x-pulse>
+    <livewire:outdated cols='4' rows='2' />

+    <livewire:npm_outdated cols='4' rows='2' />

    <livewire:pulse.servers cols="full" />

    <livewire:pulse.usage cols="4" rows="2" />

    <livewire:pulse.queues cols="4" />

    <livewire:pulse.cache cols="4" />

    <livewire:pulse.slow-queries cols="8" />

    <livewire:pulse.exceptions cols="6" />

    <livewire:pulse.slow-requests cols="6" />

    <livewire:pulse.slow-jobs cols="6" />

    <livewire:pulse.slow-outgoing-requests cols="6" />

</x-pulse>
```

That's it!



