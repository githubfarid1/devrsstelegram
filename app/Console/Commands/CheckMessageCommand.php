<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Mlog;

class CheckMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'frd:checkmessage';

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
        foreach ($users as $user) {
            $folder = base_path(env('BOT_DESTINATION')) . $user->id . '-rssbot/messages/';
            if (file_exists($folder)) {
                $files = File::files($folder);
                $fileCount = 0;
                if ($files !== false) {
                    $fileCount = count($files);
                }
                File::cleanDirectory($folder);

                $now = date('Y-m-d');
                $mlog = Mlog::where(['user_id' => $user->id, 'log_at' => $now])->first();
                if ($mlog !== null) {
                    $mlog->update(['count'=>$mlog->count + $fileCount]);
                } else {
                    Mlog::create([
                        'user_id' => $user->id,
                        'log_at' => $now,
                        'count' => $fileCount,
                    ]);

                }

            }
        }
        return 0;
    }
}
