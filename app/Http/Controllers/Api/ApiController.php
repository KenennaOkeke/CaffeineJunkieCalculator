<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller {

    /**
     * The default API response
     *
     * @var array
     */
    private $apiResponse = array("success" => false, "data" => array(), "errors" => array());

    /**
     * Set the response success to true
     *
     * @return void
     */
    function setResponseSuccess() {
        $this->apiResponse['success'] = true;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  string $key
     * @param  object $data
     * @return void
     */
    function addResponseDataItem(string $key, $data) {
        $this->apiResponse[$key] = $data;
    }
    
    /**
     * Returns the stored api response
     *
     * @return array
     */
    function getResponse(){
        return $this->apiResponse;
    }

    /**
     * Adds an error message to the api response
     *
     * @param  string  $error
     * @return void
     */
    function addResponseError($error, $error1 = null){
        if($error1 == null){
            if(is_array($error)){
                $this->apiResponse['errors'] = array_merge($this->apiResponse['errors'], $error);
            } else {
                $this->apiResponse['errors'][] = $error;
            }
        } else {
            $this->apiResponse['errors'][$error] = $error1;
        }
    }

    /**
     * Gets the number of errors
     *
     * @return int
     */
    function getErrorCount(){
        return count($this->apiResponse['errors']);
    }

    /**
     * Converts Snake Case to Pascal Case
     * We use this as we store snake case in the DB but our classes/file names are pascal case
     *
     * @param  string  $name
     * @return string
     */
    static function snakeCaseToPascalCase(string $name){
        return str_replace('_', '', ucwords($name, '_'));
    }
}