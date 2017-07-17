<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class Envio extends Model {
    
    protected $table = 'web_exportacion_brio';
    
    public function getFechaenvioAttribute(){
        
        return Carbon::createFromFormat("Y-n-j G:i:s",$this->attributes['fechaenvio']);
        
    }
    
}
