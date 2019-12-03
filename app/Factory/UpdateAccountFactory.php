<?php


namespace App\Factory;


use App\Admin;
use App\Gilde;
use App\Organiser;
use App\Raadsheer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class UpdateAccountFactory
{
    static $log = 'A user tried to update his personal info, but somehow the application wanted to update an non existing column. Look into the App/Gilde.php model @updateAccount funtion';


    public function updateAccount(Model $user, $onderdeel, $antwoord){
        if (Schema::hasColumn($user->table, $onderdeel)){

            $user->$onderdeel = $antwoord;
            $user->save();
            return true;

        } else {
            Log::warning($this->log);
            return false;
        }
    }
}
