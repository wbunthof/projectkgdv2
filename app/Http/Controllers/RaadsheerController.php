<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaadsheerController extends Controller
{
  public function index()
  {
      return view('raadsheer.raadsheer');
  }
}

//
// Einde code van Wouter
//
