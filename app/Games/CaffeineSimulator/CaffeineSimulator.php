<?php

namespace App\Games\CaffeineSimulator;

use App\Games\Game;
use App\Games\GameInterface;
use Illuminate\Http\Request;

class CaffeineSimulator extends Game implements GameInterface {

    function routeRequest(Request $request){
        switch($request->route()->getName()){
            case "api.compute.store":
                return $this->compute($request);
                break;
            case "api.page.index":
                return $this->getPage($request);
                break;
            case "api.config.index":
                return $this->handleGetConfigRequest();
                break;
            default:
                abort(404);
                break;
        }
    }

    function compute(Request $request){
        if($this->validateComputeRequest($request)){
            $_output = $this->computeMath($request);

            $this->addResponseDataItem("outputData", $_output);
            $this->modifyOutputData();
            $this->setResponseSuccess(true);
        }
        return $this->getResponse();
    }

    private function computeMath(Request $request){
        $outputData = array();

        //A simple model; we will generate based on theses mins/maxes then average. Values were taken from random sources on the internet; this is for demo use only
        $itemData = [
            'black_tea' => ['min' => 47, 'max' => 90],
            'green_tea' => ['min' => 20, 'max' => 45],
            'white_tea' => ['min' => 6, 'max' => 60],
            'coffee' => ['min' => 31, 'max' => 96],
            'sodiepop' => ['min' => 30, 'max' => 50],
            'energy_drink' => ['min' => 80, 'max' => 300],
            'energy_shot' => ['min' => 50, 'max' => 500]
        ];

        $min_caffeine = 0;
        $max_caffeine = 0;

        $min_caffeine += $itemData['black_tea']['min'] * $request->black_tea;
        $max_caffeine += $itemData['black_tea']['max'] * $request->black_tea;
        $min_caffeine += $itemData['green_tea']['min'] * $request->green_tea;
        $max_caffeine += $itemData['green_tea']['max'] * $request->green_tea;
        $min_caffeine += $itemData['white_tea']['min'] * $request->white_tea;
        $max_caffeine += $itemData['white_tea']['max'] * $request->white_tea;

        $min_caffeine += $itemData['coffee']['min'] * $request->coffee;
        $max_caffeine += $itemData['coffee']['max'] * $request->coffee;

        $min_caffeine += $itemData['sodiepop']['min'] * $request->sodiepop;
        $max_caffeine += $itemData['sodiepop']['max'] * $request->sodiepop;

        $min_caffeine += $itemData['energy_drink']['min'] * $request->energy_drink;
        $max_caffeine += $itemData['energy_drink']['max'] * $request->energy_drink;

        $min_caffeine += $itemData['energy_shot']['min'] * $request->energy_shot;
        $max_caffeine += $itemData['energy_shot']['max'] * $request->energy_shot;

        $outputData = [
            'min_c' => $min_caffeine,
            'average' => round(($max_caffeine + $min_caffeine) / 2, 0),
            'max_c' => $max_caffeine
        ];

        return $outputData;
    }
}