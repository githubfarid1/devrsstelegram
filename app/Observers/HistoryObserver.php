<?php

namespace App\Observers;

use App\Models\History;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class HistoryObserver
{
    /**
     * Handle the History "created" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function created(History $history)
    {

        $configFile = base_path(env('BOT_DESTINATION')) . $history->user->id . '-rssbot/bot_config.php';
        if (File::exists($configFile . '.tmp')) {
            File::delete($configFile . '.tmp');
        }
        File::copy($configFile, $configFile . '.tmp');
        File::delete($configFile);
        $pidFile = base_path(env('BOT_DESTINATION')) . $history->user->id . '-rssbot/bot.pid';
        if (File::exists($pidFile)) {
            shell_exec("kill -9 `cat $pidFile`");
            File::delete($pidFile);
        }
        $package = $history['package'];
        $expired = $history->expired_at;
        // dd($expired);
        if ($expired !== null) {
            $expired = new \DateTime($expired);
            if (\App::getLocale() == 'id') {
                $expiredstr = $expired->format('d M Y');
            } else {
                $expiredstr = $expired->format('M d Y');
            }
        } else {
            $expiredstr = '';
        }
        // $expiredstr = $expired;
        $messfree = str_replace('&&', '\n', __('telegram.bot_message_free'));
        $messprem = str_replace('&&', '\n', __('telegram.bot_message_premium'));

        foreach (file($configFile . '.tmp') as $line) {
            if (strpos($line, '$firstMessage') !== false) {
                // $insLine = '$firstMessage = "' .  ($package == 'free' ? str_replace('&&', '\n', __('telegram.bot_message_free') ) : str_replace('&&', '\n', __('telegram.bot_message_premium')) )  . '";' . "\n";
                $insLine = '$firstMessage = "' .  ($package == 'free' ? sprintf($messfree, $expiredstr)  : sprintf($messprem, $expiredstr))  . '";' . "\n";
            } elseif (strpos($line, '$botError') !== false) {
                $insLine = '$botError = "' .  str_replace('&&', '\n', __('telegram.bot_failed_rss'))  . '";' . "\n";
            } else {
                $insLine = $line;
            }
            File::append($configFile, $insLine);
        }
        $telegram = \App\Models\Telegram::where(['user_id' => $history->user->id])->first();
        if ($telegram->channel !== env('BOT_DEFAULT_CHANNEL') && $telegram->rss !== env('BOT_DEFAULT_RSS')) {
            $botFile = base_path(env('BOT_DESTINATION')) . $history->user->id . '-rssbot/bot.php';
            if (env('BOT_MODE') !== 'sandbox' && $expired !== null) {
                shell_exec("php $botFile  > /dev/null 2>/dev/null &");
            }
        }
    }

    /**
     * Handle the History "updated" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function updated(History $history)
    {
        //
    }

    /**
     * Handle the History "deleted" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function deleted(History $history)
    {
        //
    }

    /**
     * Handle the History "restored" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function restored(History $history)
    {
        //
    }

    /**
     * Handle the History "force deleted" event.
     *
     * @param  \App\Models\History  $history
     * @return void
     */
    public function forceDeleted(History $history)
    {
        //
    }
}
