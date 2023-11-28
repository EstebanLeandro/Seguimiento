<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model
{
    protected $table='actividades_propuestas';

    protected $primaryKey='id';

 //   public $timestamps=false;


    protected $fillable =[
        'detalle_plan_mejora_id',
        'responsable_id',
        'descri_actividades',
        'medio_verificacion',
        'plazo',
        'responsable',
        'fuente_financiamiento',
        'inversion_prevista',
        'estado',
    




    ];

    protected $guarded =[

    ];
     public function detalle_plan_mejora()
    {
        return $this->belongsTo(DetalleMejora::class);
    }
   
     public function responsables()
    {
        return $this->belongsTo('App\Models\Responsable', 'responsable_id');
    }
    public function realizadas()
    {
        return $this->belongsToMany(Realizada::class);
    }

}