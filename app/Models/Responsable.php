<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table='responsables';

    protected $primaryKey='id';

    //public $timestamps=false;


    protected $fillable =[
    	'descri_responsable',
    
    ];

    protected $guarded =[

    ];

    public function propuesta(){
        return $this->hasMany(Propuesta::class);
    }
    public function realizada(){
        return $this->hasMany(Realizada::class);
    }

}