<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SedeCarrera extends Model
{
    protected $table='carrera_sede';

    protected $primaryKey='id';
    

  // public $timestamps=false;


    protected $fillable =[
        'carrera_id',
    	'sede_id'

    ];

    protected $guarded =[

    ];
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class);
    }
    public function sedes()
    {
        return $this->belongsToMany(Sede::class);
    }
}