<?php

namespace App\Console\Commands;

use Clarkeash\Doorman\Facades\Doorman;
use Illuminate\Console\Command;

class GenerateInviteCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // Signire with arguments
    protected $signature = 'invite:generate {count=1} {duration=2} {email=null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates an invitation code for the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = $this->argument('count');
        $duration = $this->argument('duration');
        $email = $this->argument('email');

        $inviteCode = Doorman::generate($count)
            ->expiresIn($duration)
            ->for($email)
            ->make();

        $this->info("Invite Code: $inviteCode");

        return 0;
    }
}
