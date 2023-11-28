<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table='sedes';

    protected $primaryKey='id';

    //public $timestamps=false;
    protected $fillable =[   
    	'descri_sede'

    ];

    protected $guarded =[];
    
    public function carreras()
    {
        return $this->belongsToMany(Carrera::class);
    }
    public function plan_mejoras()
    {
        return $this->hasMany(Mejora::class);
    }
    
}