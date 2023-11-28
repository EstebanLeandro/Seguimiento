<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    protected $table='dimensions';

    protected $primaryKey='id';

   // public $timestamps=false;


    protected $fillable =[
    	'descri_dimenion'
    ];

    protected $guarded =[

    ];

    public function detalle_plan_mejora()
    {
        return $this->belongsToMany(DetalleMejora::class);
}
}