<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Factura extends Model {

    protected $table = "Web_Exportacion_Facturas_CtaCte";

    public function getFechacomprobanteAttribute() {
 
        return Carbon::createFromFormat("Y-n-j G:i:s", $this->attributes['FechaComprobante']);
    }

    /*
      public function getImporteTotalAttribute(){
      return number_format($this->attributes['ImporteTotal'],2,",",".");
      }
      public function getImportePagadoAttribute(){
      return number_format($this->attributes['ImportePagado'],2,",",".");
      } */
}
