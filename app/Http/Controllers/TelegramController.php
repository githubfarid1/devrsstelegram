<?php

namespace App\Http\Controllers;

use App\Models\Telegram;
use Illuminate\Http\Request;
use App\Http\Requests\TelegramRequest;
use Illuminate\Support\Facades\File;

class TelegramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Telegram  $telegram
     * @return \Illuminate\Http\Response
     */
    public function show(Telegram $telegram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return \Illuminate\Http\Response
     */
    public function edit(Telegram $telegram)
    {
        if (!auth()->user()->isAdmin()){
            if ($telegram->id !== auth()->user()->telegram()->get()->toArray()[0]['id']) {
                return redirect()->to(route('home'));
            }
        }
        $pidFile = base_path(env('BOT_DESTINATION')) . $telegram->user->id . '-rssbot/bot.pid';
        if(File::exists($pidFile)){
            $botstatus = true;
        } else{
            $botstatus = false;
        }
        $package = $telegram->user->histories()->latest()->limit(1)->get()->toArray()[0]['package'];
        return view('telegrams.edit', ['telegram' => $telegram, 'botstatus' => $botstatus, 'package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telegram  $telegram
     * @return \Illuminate\Http\Response
     */
    public function update(TelegramRequest $request, Telegram $telegram)
    {
        $this->authorize('update', $telegram);
        if ($request['channel'] == env('BOT_DEFAULT_CHANNEL') || $request['rss'] == env('BOT_DEFAULT_RSS')) {
            session()->flash('warning','Please change RSS and Channel First');
            return redirect()->back();
        }
        $attr = $request->all();
        $attr['rss'] = htmlspecialchars_decode($attr['rss']);
        $telegram->update($attr);
        session()->flash('success','Update Success');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telegram  $telegram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telegram $telegram)
    {
        //
    }
}
