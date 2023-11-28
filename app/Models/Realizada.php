<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realizada extends Model
{
    protected $table='actividades_realizadas';

    protected $primaryKey='id';

   // public $timestamps=false;


    protected $fillable =[
        'actividades_propuesta_id',
        'responsable_id',
        'descri_realizadas',
        'plazo',
        'cumplimiento',
        'resultados',
        'avance',
        'pendientes',
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

    public function propuestas()
    {
        return $this->belongsTo('App\Models\Propuesta', 'actividades_propuesta_id');
    }
    public function medio_verificacions()
    {
        return $this->hasMany('App\Models\DetalleMedio', 'medio_verificacion_id');
    }
}