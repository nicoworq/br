<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Envio extends Model {

    protected $table = 'Web_Exportacion_Brio';

    public function getFechaenvioAttribute() {

        return Carbon::createFromFormat("Y-n-j G:i:s", $this->attributes['fechaenvio']);
    }

    public function getClientedestinoAttribute() {
      
        return ucfirst(strtolower($this->attributes['clientedestino']));
    }
    public function getDomiciliodestinoAttribute() {
      
        return ucfirst(strtolower($this->attributes['domiciliodestino']));
    }
    public function getLocalidaddestinoAttribute() {
      
        return ucfirst(strtolower($this->attributes['localidaddestino']));
    }

}
