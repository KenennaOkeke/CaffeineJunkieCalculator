<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameApiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $className = ("App\Games\\" . $this->snakeCaseToPascalCase($request->route('game')) . "\\" . $this->snakeCaseToPascalCase($request->route('game')));
        if(class_exists($className)) {
            if(method_exists($className, 'routeRequest')){
                return (new $className())->routeRequest($request);
            }
        }
       abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $className = ("App\Games\\" . $this->snakeCaseToPascalCase($request->route('game')) . "\\" . $this->snakeCaseToPascalCase($request->route('game')));
        if(class_exists($className)) {
            if(method_exists($className, 'routeRequest')){
                return (new $className())->routeRequest($request);
            }
        }
       abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
