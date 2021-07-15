<?php

namespace App\Http\Helpers\Utilities;

class Utilities {
    static function getProcessesPath() {
        
        $laravelFolderInit = strpos(public_path(),'backend');
        
        return substr(public_path(), 0, $laravelFolderInit).'processes/';
        
    }
}