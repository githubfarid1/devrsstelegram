<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\user;
use Illuminate\Support\Facades\DB;
class CheckExpiredCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'frd:checkexpired';

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
        $users = User::all();
        $now = date("Y-m-d");
        foreach ($users as $user) {
            $expiredAt = $user->histories()->latest()->limit(1)->get()->toArray()[0]['expired_at'];
            if ($expiredAt !== null) {
                if ($expiredAt === $now) {
                    \App\Models\History::create([
                        'user_id' => $user->id,
                        'note_at' => date("Y-m-d H:i:s"),
                        'package' => 'free',
                        'expired_at' => null,
                    ]);

                }
            }
        }
        return 0;
    }
}
