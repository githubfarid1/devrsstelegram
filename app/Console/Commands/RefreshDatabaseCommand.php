<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RefreshDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'frd:dbrefresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Database and Seed them';

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
        if (File::exists(base_path(env('BOT_DESTINATION')))){
            File::deleteDirectory(base_path(env('BOT_DESTINATION')));
        }
        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->info('Finish...');
        return 0;
    }
}
