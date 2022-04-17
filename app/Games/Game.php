<?php
namespace App\Games;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Game {
    /**
     * The default API response
     *
     * @var array
     */
    private $apiResponse = array("success" => false, "data" => array(), "errors" => array());
    private $name;

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
        $this->apiResponse['data'][$key] = $data;
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
    function snakeCaseToPascalCase(string $name){
        return str_replace('_', '', ucwords($name, '_'));
    }

    private function getConfig(){
        $gameName = strtolower(explode("\\", get_class($this))[2]);
        $contents = Storage::get('private/games/'.$gameName.'/config.json');
        return json_decode($contents);
    }

    function handleGetConfigRequest(){
        $this->setResponseSuccess();
        $this->addResponseDataItem("config", $this->getConfig());
        return $this->getResponse();
    }

    function getPage(Request $request){
        $pages = [];
        foreach($this->getConfig()->pageData->pages as $page){
            $pages[$page->name] = $page;
        }

        if(!isset($pages[$request['page']])){
            abort(404);
        }
        $this->setResponseSuccess(true);
        $this->addResponseDataItem("pageContent", base64_encode(view('Games.'.(explode("\\", get_class($this))[2]).'.Pages.' .$pages[$request['page']]->name)->render()));
        $this->addResponseDataItem("pageTitle", $pages[$request['page']]->title);
        return $this->getResponse();
    }

    function validateComputeRequest(Request $request){
        $config = $this->getConfig();

        foreach($config->inputData->inputs as $input){
            if($input->type == "currency" || $input->type == "number" || $input->type == "percentage"){
                if(!is_numeric($request[$input->name])){
                    $this->addResponseError($input->name, "Must be a numeric value.");
                    continue;
                }
                if(isset($input->min)){
                    if(($request[$input->name]) < $input->min){
                        $this->addResponseError($input->name, "Must be greater or equal to ". number_format($input->min) .".");
                    }
                }
                if(isset($input->max)){
                    if(($request[$input->name]) > $input->max){
                        $this->addResponseError($input->name, "Must be less or equal to ". number_format($input->max) .".");
                    }
                }
            } else if($input->type == "select"){
                $options = array();
                foreach($input->options as $option){
                    array_push($options, $option->value);
                }
                if(!in_array($request[$input->name], $options)){
                    $this->addResponseError($input->name, "Invalid option selected.");
                }
            } else {
                $this->addResponseError($input->name, "Please try again later...");
            }
        }
        return $this->getErrorCount() === 0;
    }

    function modifyOutputData(){
        foreach($this->apiResponse['data']['outputData'] as $idk=>$data){
            if(!is_array($data)){
                $this->apiResponse['data']['outputData'][$idk] = array($data);
            }
        }
    }
}