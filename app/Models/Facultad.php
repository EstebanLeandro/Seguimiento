<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    protected $table='facultads';

    protected $primaryKey='id';

    //public $timestamps=false;


    protected $fillable =[
    	'descri_facultad'
    ];

    

    protected $guarded =[

    ];

    //RELATIONSHIP

    public function carreras()
    {
        return $this->hasMany(Carrera::class);
    }

}