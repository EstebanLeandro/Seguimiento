<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Mejora extends Model
{
    protected $table='plan_mejoras';

    protected $primaryKey='id';

  // public $timestamps=false;


    protected $fillable =[
        'sede_id',
        'carrera_id',
        'periodo_id',
        'fecha_presentacion',  
    ];

    protected $guarded =[

    ];
    public function sedes()
    {
        return $this->belongsToMany(Sede::class);
    }
    public function carreras()
        {
            return $this->belongsToMany(Carrera::class);
    }
    public function periodos()
    {
    return $this->belongsTo('App\Models\Periodo', 'periodo_id');
    }


     public function detalle_plan_mejora()
     {

        return $this->hasOne('App\Models\DetalleMejora', 'plan_mejora_id');
    //     // return $this->hasOneThrough(
    //     //     'App\DetalleMejora',
    //     //     'App\Sede',
    //     //     'sede_id', // Foreign key on users table...
    //     //     'sede_id', // Foreign key on history table...
    //     //     'id', // Local key on suppliers table...
    //     //     'id' // Local key on users table...
    //     // );
    }
}