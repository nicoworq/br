<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model {
    protected $table = "web_exportacion_facturas_ctacte";
    
    /*
    public function getImporteTotalAttribute(){
        return number_format($this->attributes['ImporteTotal'],2,",",".");
    }
    public function getImportePagadoAttribute(){
        return number_format($this->attributes['ImportePagado'],2,",",".");
    }*/
}
