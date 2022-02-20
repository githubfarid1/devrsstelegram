<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Mlog;
use DateTime;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->email == env('USER_ADMIN')) {
            return redirect()->to(route('users.index'));
        }
        $periods = CarbonPeriod::create(Carbon::now()->subDays( (int)env('STATISTIC_DAYS')), Carbon::now());
        $mess = [];
        $totMess = 0;
        foreach ($periods as $period) {
            $d = $period->toDateString('Y-m-d');
            $mlog = Mlog::where(['user_id' => auth()->user()->id, 'log_at' => $d ])->first();
            if ($mlog){
                $mess[] = ['date'=>$d, 'count' => $mlog->count];
                $totMess += $mlog->count;
            } else {
                $mess[] = ['date'=>$d, 'count' => 0];
            }
        }
        $package = auth()->user()->histories()->latest()->limit(1)->get()->toArray()[0]['package'];
        $tmpExpiredAt = auth()->user()->histories()->latest()->limit(1)->get()->toArray()[0]['expired_at'];
        if ($tmpExpiredAt === null){
            $expire_at = 'n/a';
        } else {
            $d = strtotime($tmpExpiredAt);
            $expire_at = date('d M Y', $d);

        }
        $userId = auth()->user()->id;
        $pidFile = base_path(env('BOT_DESTINATION')) . $userId . '-rssbot/bot.pid';
        if(File::exists($pidFile)){
            $botstatus = true;
        } else{
            $botstatus = false;
        }
        $mlog = Mlog::where(['user_id'=> auth()->user()->id, 'log_at' => \Carbon\Carbon::now()->toDateString('Y-m-d') ])->first();
        if ($mlog) {
            $messtoday = $mlog->count;
        } else {
            $messtoday = 0;
        }
        $isMobile = \Jenssegers\Agent\Facades\Agent::isMobile();
        $walink = ($isMobile ? env('WA_MOBILE_URL') : env('WA_DESKTOP_URL')) . 'send?phone=' . env('WA_PHONE') . '&text=' . urlencode(sprintf(__('home.watext'), auth()->user()->email));

        return view('home', ['botstatus' => $botstatus, 'package' => $package, 'expire_at' => $expire_at, 'messchart' => $mess, 'total_message' => $totMess, 'message_today' => $messtoday, 'walink' => $walink]);

    }
    public function service()
    {
        $userId = auth()->user()->id;
        $pidFile = base_path(env('BOT_DESTINATION')) . $userId . '-rssbot/bot.pid';
        if(File::exists($pidFile)){
            shell_exec("kill -9 `cat $pidFile`");
            File::delete($pidFile);
            //shell_exec("sudo rm ". $pidFile);

        } else {
            $user = \App\Models\User::find($userId);
            $channel = $user->telegram->channel;
            $rss = $user->telegram->rss;
            //dd('dd');
            $tmpExpiredAt = $user->histories()->latest()->limit(1)->get()->toArray()[0]['expired_at'];
            if ($tmpExpiredAt === null) {
                session()->flash('error',__('home.bot_expired'));
            } else {
                if ($channel !== env('BOT_DEFAULT_CHANNEL') && $rss !== env('BOT_DEFAULT_RSS')) {
                    $botFile = base_path(env('BOT_DESTINATION')) . $userId . '-rssbot/bot.php';
                    if (env('BOT_MODE') !== 'sandbox') {
                        shell_exec("php $botFile  > /dev/null 2>/dev/null &");
                    }
                } else {
                    session()->flash('warning',__('telegram.update_channel_first'));
                    return redirect()->to(route('home'));
                }
            }
        }
        sleep(1);
        return redirect()->to(route('home'));
    }
    public function help()
    {
        return view('help');
    }

}
