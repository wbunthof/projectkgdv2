<?php

namespace App\Http\Controllers;

use App\Gilde;
use App\Mail\GildeHerrineringsMailBeginVanHetJaar;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function GildeHerrineringsMailBeginVanHetJaar()
    {
//        $gilden = Gilde::all();

        $mail = Mail::to('secretariskringkempenland@gmail.com')->send(new GildeHerrineringsMailBeginVanHetJaar(Gilde::find(1)));

        return new GildeHerrineringsMailBeginVanHetJaar(Gilde::find(1));
    }
}
