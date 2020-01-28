<?php

namespace App\Http\Controllers;

use App\Gilde;
use App\Mail\GildeHerrineringsMailBeginVanHetJaar;
use Exception;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function GildeHerrineringsMailBeginVanHetJaar()
    {
        $gilden = Gilde::all();
        $log = [];
        $error = [];
        foreach ($gilden as $gilde) {
            try {
                array_push($log, Mail::to($gilde)->send(new GildeHerrineringsMailBeginVanHetJaar($gilde)));
            } catch (Exception $e) {
                array_push($error, $e);
            }
        }

        return dd($log, $error, $gilden);
    }
}
