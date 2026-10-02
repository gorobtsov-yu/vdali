<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public function toArray(){
        
        $array = parent::toArray();
        $camelArray = array();

        foreach($array as $name => $value){
            $camelArray[str_replace('_', '', ucwords($name))] = $value;
        }
        return $camelArray;
    }
}
