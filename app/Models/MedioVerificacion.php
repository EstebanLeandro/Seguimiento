<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioVerificacion extends Model
{
    protected $table='medio_verificacions';

    protected $primaryKey='id';

    //public $timestamps=false;


    protected $fillable =[
    	'descri_verificacion',
        'url'
    ];
    
    

    protected $guarded =[

    ];

    //RELATIONSHIP
    public function detalles()
    {
        return $this->belongsTo(DetalleMedio::class);
    }
    
   
}