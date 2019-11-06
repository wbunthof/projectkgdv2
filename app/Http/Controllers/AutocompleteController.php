<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Leden;

class AutocompleteController extends Controller
{
    public function autocompleteId($input)
    {
      $data = Leden::select('id', 'voornaam', 'achternaam')->where("id","LIKE","%{$input}%")->limit(5)->get();
        return response()->json($data);
    }

    public function autocompleteVoornaam($input)
    {
      $data = Leden::select('id', 'voornaam', 'achternaam')->where("voornaam","LIKE","%{$input}%")->limit(5)->get();
        return response()->json($data);
    }

    public function autocompleteAchternaam($input)
    {
      $data = Leden::select('id', 'voornaam', 'achternaam')->where("achternaam","LIKE","%{$input}%")->limit(5)->get();
        return response()->json($data);
    }
}

//
// Einde code van Wouter
//
