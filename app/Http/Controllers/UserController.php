<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->to(route('home'));
        }
        $users = User::paginate(10);
        return view('users.index', ['users' => $users]);
    }
    public function search()
    {
        $par =  request('query');
        if ($par) {
            $users = User::where('email', '!=', env('USER_ADMIN'))->where(function ($query) {
                $par =  request('query');
                return $query
                    ->where('name', 'LIKE', "%$par%")->orWhere('email', 'LIKE', "%$par%");
            })->latest()->paginate(9);
        } else {
            $users = User::where('email', '!=', env('USER_ADMIN'))->latest()->paginate(9);
        }
        return view('users.index2', ['users' => $users]);
    }
    public function index2()
    {
        if (!auth()->user()->isAdmin()) {
            return redirect()->to(route('home'));
        }
        $users = User::where('email', '!=', env('USER_ADMIN'))->latest()->paginate(9);
        foreach ($users as $key => $user) {
            $pidFile = base_path(env('BOT_DESTINATION')) . $user->id . '-rssbot/bot.pid';
            if (File::exists($pidFile)) {
                $user->botstatus = true;
            } else {
                $user->botstatus = false;
            }
            $mlogs = $user->mlogs()->where(['log_at' => \Carbon\Carbon::now()->toDateString('Y-m-d')]);
            if (isset($mlogs->get()->toArray()[0]['count'])) {
                $user->messtoday = $mlogs->get()->toArray()[0]['count'];
            } else {
                $user->messtoday = 0;
            }
            $users[$key] = $user;
        }
        //dd($users);
        return view('users.index2', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->delete();
        session()->flash('success', 'Delete Success');
        return redirect()->back();
    }
    public function upgrade(User $user)
    {
        if ($user->telegram->channel == env('BOT_DEFAULT_CHANNEL') || $user->telegram->rss == env('BOT_DEFAULT_RSS')) {
            session()->flash('warning', 'Process Failed because CHANNEL AND RSS have not been updated');
            return redirect()->back();
        }
        $package = $user->histories()->latest()->limit(1)->get()->toArray()[0]['package'];
        $expiredAt = $user->histories()->latest()->limit(1)->get()->toArray()[0]['expired_at'];
        if ($expiredAt !== null) {
            $dt = strtotime($expiredAt);
        } else {
            $dt = strtotime('now');
        }
        \App\Models\History::create([
            'user_id' => $user->id,
            'note_at' => date("Y-m-d H:i:s"),
            'package' => 'premium',
            'expired_at' => date('Y-m-d', strtotime('+1 month', $dt)),
        ]);

        //dd($package);
        // if ($package == 'premium') {
        //     \App\Models\History::create([
        //         'user_id' => $user->id,
        //         'note_at' => date("Y-m-d H:i:s"),
        //         'package' => 'free',
        //         'expired_at' => null,
        //     ]);
        // } else {
        //     $dt = strtotime('now');
        //     \App\Models\History::create([
        //         'user_id' => $user->id,
        //         'note_at' => date("Y-m-d H:i:s"),
        //         'package' => 'premium',
        //         'expired_at' => date('Y-m-d', strtotime('+1 month', $dt)),
        //     ]);
        // }
        return redirect()->back();
    }

    public function downgrade(User $user)
    {
        if ($user->telegram->channel == env('BOT_DEFAULT_CHANNEL') || $user->telegram->rss == env('BOT_DEFAULT_RSS')) {
            session()->flash('warning', 'Process Failed because CHANNEL AND RSS have not been updated');
            return redirect()->back();
        }
        \App\Models\History::create([
            'user_id' => $user->id,
            'note_at' => date("Y-m-d H:i:s"),
            'package' => 'free',
            'expired_at' => null,
        ]);
        return redirect()->back();
    }
    public function plus7(User $user)
    {
        /*if ($user->telegram->channel == env('BOT_DEFAULT_CHANNEL') || $user->telegram->rss == env('BOT_DEFAULT_RSS')) {
            session()->flash('warning', 'Process Failed because CHANNEL AND RSS have not been updated');
            return redirect()->back();
        }*/
        $dt = strtotime('now');
        \App\Models\History::create([
            'user_id' => $user->id,
            'note_at' => date("Y-m-d H:i:s"),
            'package' => 'free',
            'expired_at' => date('Y-m-d', strtotime('+7 day', $dt)),
        ]);
        return redirect()->back();
    }
}
