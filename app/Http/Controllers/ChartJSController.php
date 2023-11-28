<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Propuesta;
use App\Models\LaravelChart;
use Illuminate\Http\Request;
use App\Http\Requests\PropuestaFormRequest;

use DB;

class ChartJSController extends Controller
{

    /**

     * Escribir código en Método

     *

     * respuesta @return()

     */

    public function index(){

        // $abonos = Abono::select(DB::raw("sum(saldo_abono) as saldo, sum(cantidad) as  tabono, MONTHNAME(fecha) as mes"))
        // ->groupBy("mes")->get();
        $propuestas= DB::table('actividades_propuestas as ap')
        ->join('detalle_plan_mejoras as dp', 'dp.id', '=', 'ap.detalle_plan_mejora_id')
        ->join('responsables as pro', 'pro.id', '=', 'ap.responsable_id')
        ->select('ap.*', 'dp.recomendacion_mejora','pro.descri_responsable')
       // ->where('descri_actividades','LIKE','%'.$query.'%')
        //->orderBy('id','desc')
        ->get();
    
        return view('chart.chartjs',['propuestas'=>$propuestas]);

    }
    

}

