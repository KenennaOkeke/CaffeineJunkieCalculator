<?php
namespace App\Games;
use Illuminate\Http\Request;

interface GameInterface{
    public function routeRequest(Request $request);
    public function compute(Request $request);
    public function getPage(Request $request);
}