<?php

namespace App\Console\Commands;

use App\Admission;
use App\Fee;
use App\School;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Log::info("Cron is working fine!");
        (new School())->checkActiveDate();
        (new Fee())->generate_cycle();
        if (now()->gt(foqas_setting('add_result_pubtime'))) {
            (new Admission())->cal_merit_with_mark();
        }
        (new Admission())->waiting_1();
        (new Admission())->waiting_2();
        (new Admission())->waiting_3();
        $this->info('Status:Update Command Run successfully!');
    }
}