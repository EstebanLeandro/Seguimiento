<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
     protected $table='carreras';

    protected $primaryKey='id';
    

//public $timestamps=false;


    protected $fillable =[
        'facultad_id',
        
    	'descri_carrera'

    ];

    protected $guarded =[];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    public function sedes()
    {
        return $this->belongsToMany(Sede::class, 'carrera_sede');
    }
}