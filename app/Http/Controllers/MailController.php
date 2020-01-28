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
        $gilden = Gilde::find(1);
        $log = [];
        foreach ($gilden as $gilde) {
            array_push($log, Mail::to($gilde)->send(new GildeHerrineringsMailBeginVanHetJaar($gilde)));
        }

        return dd($log);
    }
}
