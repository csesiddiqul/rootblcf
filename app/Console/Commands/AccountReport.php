<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AccountReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Account Opening & Closing Balance Calculation';

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
     *
     * @return int
     */
    public function handle()
    {
        (new \App\AccountReport())->dailyCalculations();
        $this->info('Status:Command Run successfully! Time:'.now());
        return 0;
    }
}
