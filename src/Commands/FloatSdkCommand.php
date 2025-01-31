<?php

namespace Spatie\FloatSdk\Commands;

use Illuminate\Console\Command;

class FloatSdkCommand extends Command
{
    public $signature = 'laravel-float-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
