<?php
/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace AaronFrancis\Pulse\Outdated\Recorders;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Process;
use Laravel\Pulse\Events\SharedBeat;
use Laravel\Pulse\Pulse;
use RuntimeException;

class OutdatedRecorder
{
    /**
     * The events to listen for.
     *
     * @var class-string
     */
    public string $listen = SharedBeat::class;

    /**
     * Create a new recorder instance.
     */
    public function __construct(
        protected Pulse $pulse,
        protected Repository $config
    ) {
        //
    }

    public function record(SharedBeat $event): void
    {
        if ($event->time !== $event->time->startOfDay()) {
            return;
        }

        $result = Process::run('composer outdated -D -f json');

        if ($result->failed()) {
            throw new RuntimeException('Composer outdated failed: '.$result->errorOutput());
        }

        json_decode($result->output(), flags: JSON_THROW_ON_ERROR);

        $this->pulse->set('composer_outdated', 'result', $result->output());

        $npmResult = Process::run('npm outdated --long --json');

        json_decode($npmResult->output(), flags: JSON_THROW_ON_ERROR);

        $this->pulse->set('npm_outdated', 'result', $npmResult->output());
    }
}
