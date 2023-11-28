<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleMejora extends Model
{
    protected $table='detalle_plan_mejoras';

    protected $primaryKey='id';

    //public $timestamps=false;


    protected $fillable =[
        'dimension_id',
        'plan_mejora_id',
        'recomendacion_mejora',


    ];

    protected $guarded =[

    ];

    public function dimension()
    {
        return $this->belongsTo(Dimension::class);
    }
      public function plan_mejora()
     {
         return $this->belongsTo(Mejora::class);
     }
    public function propuestas(){
        return $this->belongsToMany(Propuesta::class);
    }
}