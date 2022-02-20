<?php
namespace App\Observers;
use App\Models\Telegram;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class TelegramObserver
{
    /**
     * Handle the Telegram "created" event.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return void
     */
    public function created(Telegram $telegram)
    {
        //
    }

    /**
     * Handle the Telegram "updated" event.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return void
     */
    public function updated(Telegram $telegram)
    {
        $configFileSource = base_path(env('BOT_TEMPLATE')) . 'bot_config.php';
        $configFile = base_path(env('BOT_DESTINATION')) . $telegram->user->id . '-rssbot/bot_config.php';
        $pidFile = base_path(env('BOT_DESTINATION')) . $telegram->user->id . '-rssbot/bot.pid';
        //dd($configFile);
        if(File::exists($configFile)){
            File::delete($configFile);
            //shell_exec("sudo rm ". $configFile);
        }
        if(File::exists($pidFile)){
            shell_exec("kill -9 `cat $pidFile`");
            File::delete($pidFile);
        }
        $package = $telegram->user->histories()->latest()->limit(1)->get()->toArray()[0]['package'];
        $expired = $telegram->user->histories()->latest()->limit(1)->get()->toArray()[0]['expired_at'];
        $expired = new \DateTime($expired);
        if (\App::getLocale() == 'id') {
            $expiredstr = $expired->format('d M Y');
        } else {
            $expiredstr = $expired->format('M d Y');
        }


        foreach (file($configFileSource) as $line) {
            if (strpos($line, '$chat = ') !== false) {
                $insLine = '$chat = ' . "'" . str_replace('https://t.me/', '@', $telegram->channel) . "'" . ';' . "\n";
            } elseif (strpos($line, '$rss = ') !== false) {
                $insLine = '$rss = ' . "'" . $telegram->rss . "'" . ';' . "\n";
            } elseif(strpos($line, '$firstMessage') !== false) {
                $messfree = str_replace('&&', '\n', __('telegram.bot_message_free'));
                $messprem = str_replace('&&', '\n', __('telegram.bot_message_premium'));
                $insLine = '$firstMessage = "' .  ($package == 'free' ? sprintf($messfree,$expiredstr)  : sprintf($messprem, $expiredstr))  . '";' . "\n";
            } elseif(strpos($line, '$botError') !== false) {
                $insLine = '$botError = "' .  str_replace('&&', '\n', __('telegram.bot_failed_rss'))  . '";' . "\n";
            } else {
                $insLine =  $line;
            }
             File::append($configFile, $insLine);
        }
        if ($telegram->channel !== env('BOT_DEFAULT_CHANNEL') && $telegram->rss !== env('BOT_DEFAULT_RSS')) {
            $botFile = base_path(env('BOT_DESTINATION')) . $telegram->user->id . '-rssbot/bot.php';
            if (env('BOT_MODE') !== 'sandbox') {
                shell_exec("php $botFile  > /dev/null 2>/dev/null &");
            }
        }
    }

    /**
     * Handle the Telegram "deleted" event.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return void
     */
    public function deleted(Telegram $telegram)
    {
        //
    }

    /**
     * Handle the Telegram "restored" event.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return void
     */
    public function restored(Telegram $telegram)
    {
        //
    }

    /**
     * Handle the Telegram "force deleted" event.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return void
     */
    public function forceDeleted(Telegram $telegram)
    {
        //
    }
}
