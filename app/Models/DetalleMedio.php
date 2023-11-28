<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleMedio extends Model
{
    protected $table='detalle_verificacions';

    protected $primaryKey='id';

    //public $timestamps=false;


    protected $fillable =[
        'medio_verificacion_id',
        'actividades_realizada_id',
    ];

    protected $guarded =[

    ];
    public function medio_verificacions()
    {
        return $this->belongsTo(MedioVericacion::class);
    }
    public function realizadas()
    {
        return $this->belongsTo(Realizada::class);
    }

   
}