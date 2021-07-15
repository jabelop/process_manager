<?php 

namespace App\Http\Helpers\Response;

interface ResponseInterface {

    public function getResponseArray();

    public function setArrayValues(Array $values);
}