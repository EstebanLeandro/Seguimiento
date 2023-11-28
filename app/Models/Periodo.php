<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table='periodos';

    protected $primaryKey='id';

   // public $timestamps=false;


    protected $fillable =[
    	'descri_periodo'
    ];

    protected $guarded =[

    ];

  
    public function detalle_plan_mejora()
        {
            return $this->belongsToMany(DetalleMejora::class);
    }
}