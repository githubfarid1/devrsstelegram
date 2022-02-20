<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Http\Request;

class UpdatePasswordController extends UpdateUserPassword
{
    public function edit()
    {
        return view('auth.passwords.edit');
    }
    public function updatePassword()
    {
        $this->update(request()->user(), request()->all());
        session()->flash('success','Update Password Success');
        return redirect()->back();
    }
}
