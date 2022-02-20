<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PaypalController extends Controller
{
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function paypal_out()
    {
        if (App::getLocale() == 'id') {
            return view('welcome');
        } else {
            return view('paypals.global', ['hosted_button_id' => 'JZ6FWG86NFDB6']);
        }
    }

    public function paypal_euro()
    {
        if (App::getLocale() == 'id') {
            return view('welcome');
        } else {
            return view('paypals.global', ['hosted_button_id' => '5KDA2V6NRSVBN']);
        }
    }

    public function paypal_in()
    {
        if (App::getLocale() == 'id') {
            return view('welcome');
        } else {
            return view('paypals.global', ['hosted_button_id' => 'ZJHU6BQ57RGUU']);
        }
    }
}
