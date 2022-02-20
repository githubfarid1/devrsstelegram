<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $sourceFolder = base_path(env('BOT_TEMPLATE'));
        $destForlder = base_path(env('BOT_DESTINATION')) . $user->id . '-rssbot';
        if (!File::exists(base_path(env('BOT_DESTINATION')))){
            File::makeDirectory(base_path(env('BOT_DESTINATION')));
            shell_exec("chmod 777  " . base_path(env('BOT_DESTINATION')) . " -R");
        }
        if(File::exists($destForlder)){
            File::deleteDirectory($destForlder);
        }
        File::copyDirectory($sourceFolder, $destForlder);
        shell_exec("chmod 777  " . $destForlder . " -R");

        \App\Models\Telegram::create([
            'user_id' => $user->id,
            'channel' => env('BOT_DEFAULT_CHANNEL'),
            'rss' => env('BOT_DEFAULT_RSS'),
        ]);
        $dt = strtotime('now');
        \App\Models\History::create([
            'user_id' => $user->id,
            'note_at' => date("Y-m-d H:i:s"),
            'package' => 'free',
            'expired_at' => date('Y-m-d', strtotime('+7 day', $dt)),
        ]);


    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $pidFile = base_path(env('BOT_DESTINATION')) . $user->id . '-rssbot/bot.pid';
        if(File::exists($pidFile)){
            shell_exec("kill -9 `cat $pidFile`");
            File::delete($pidFile);
        }
        File::deleteDirectory(base_path(env('BOT_DESTINATION')) . $user->id . '-rssbot/');
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
