<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace AaronFrancis\Pulse\Outdated\Livewire;

use Illuminate\Support\Facades\View;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Livewire\Card;
use Livewire\Attributes\Lazy;

class NpmOutdated extends Card
{
    #[Lazy]
    public function render()
    {
        $packages = Pulse::values('npm_outdated', ['result'])->first();

        $packages = $packages
        ? json_decode($packages->value, associative: true, flags: JSON_THROW_ON_ERROR)
        : [];

        return View::make('npm_outdated::livewire.npm_outdated', [
            'packages' => $packages,
        ]);
    }
}
