<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace AaronFrancis\Pulse\Outdated\Livewire;

use Illuminate\Support\Facades\View;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Livewire\Card;
use Livewire\Attributes\Lazy;

class Outdated extends Card
{
    #[Lazy]
    public function render()
    {
        // Get the data out of the Pulse data store.
        $packages = Pulse::values('composer_outdated', ['result'])->first();

        $packages = $packages
            ? json_decode($packages->value, JSON_THROW_ON_ERROR)['installed']
            : [];

        return View::make('outdated::livewire.outdated', [
            'packages' => $packages,
        ]);
    }
}