<?php

namespace App\Services;

use Illuminate\Support\Str;

class IpService
{


    public function update(object $request)
    {
        $data           = $request->all();
        $data['slug']   = Str::slug($request->title, '-');
        return $data;
    }
    public function getIpPublic()
    {
        //GET IP PUBLIC
        $clientip = @$_SERVER['HTTP_CLIENT_IP'];
        $forwardip = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remoteip = @$_SERVER['REMOTE_ADDR'];

        if (filter_var($clientip, FILTER_VALIDATE_IP)) {
            $ip = $clientip;
        } elseif (filter_var($forwardip, FILTER_VALIDATE_IP)) {
            $ip = $forwardip;
        } else {
            $ip = $remoteip;
        }
        return $ip;

    }
}
