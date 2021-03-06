<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

/**
 * Console command that removes users that are banned or inactive for too long
 */
class RemoveOldUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:remove-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove users that are long banned or inactive';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = User::toBeRemoved()->delete();

        $this->info("$count users were removed.");
    }
}
