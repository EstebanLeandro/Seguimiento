<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Propuesta;
use App\Models\Responsable;
use App\Models\DetalleMejora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ActividadesPropuestasFormRequest;
use App\Http\Requests\DetalleMejoraFormRequest;
use App\Http\Requests\ResponsableFormRequest;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PropuestaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-plan-mejoras|crear-plan-mejoras|editar-plan-mejoras|borrar-plan-mejoras', ['only' => ['index']]);
        $this->middleware('permission:crear-plan-mejoras', ['only' => ['create','store']]);
        $this->middleware('permission:editar-plan-mejoras', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-plan-mejoras', ['only' => ['eliminar']]);
     }
    public function index(Request $request)
    {
     
           if ($request)
               {
             $query=trim($request->get('searchText'));
            
              $propuestas= DB::table('actividades_propuestas as ap')
              ->join('detalle_plan_mejoras as dp', 'dp.id', '=', 'ap.detalle_plan_mejora_id')
              ->join('responsables as pro', 'pro.id', '=', 'ap.responsable_id')
              ->select('ap.*', 'dp.recomendacion_mejora','pro.descri_responsable')
              ->where('descri_actividades','LIKE','%'.$query.'%')
              ->orderBy('id','desc')
              ->paginate(7);
             return view('transaccion.propuesta.index',["propuestas"=>$propuestas,"searchText"=>$query]);
         }
        }
    public function create(Request $request)
    { 
       
        $query=trim($request->get('busqueda'));
        $propuesta =  DB::table('actividades_propuestas as ap')
        ->join('detalle_plan_mejoras as dp', 'dp.id', '=', 'ap.detalle_plan_mejora_id')
        ->join('responsables as pro', 'pro.id', '=', 'ap.responsable_id')
        ->select('ap.*', 'dp.recomendacion_mejora','pro.descri_responsable')
        -> where('dp.id','=',$request->id) 
        ->where('dp.id','LIKE','%'.$query.'%')        
        -> orderBy('ap.id', 'desc')
        ->paginate(10);
        $responsable = Responsable::all();
        $detalle= DetalleMejora::findOrFail($request->id);
        return view("transaccion.propuesta.create", ['propuesta'=>$propuesta,'detalle' => $detalle,'responsable'=> $responsable, "busqueda"=>$query]);
    
}
    public function store (ActividadesPropuestasFormRequest $request)
    {
        //dd($request->all());
        $propuesta =new Propuesta;
        $propuesta-> detalle_plan_mejora_id = $request-> get('detalle_plan_mejora_id');
        $propuesta-> descri_actividades = $request-> get('descri_actividades');
        $propuesta-> medio_verificacion = $request-> get('medio_verificacion');
        $propuesta-> plazo= $request-> get('plazo');
        $propuesta-> responsable_id= $request-> get('responsable_id');
        $propuesta-> fuente_financiamiento= $request-> get('fuente_financiamiento');
        $propuesta-> inversion_prevista= $request-> get('inversion_prevista');
        $propuesta-> estado='Propuesta';
        $propuesta->save();
        return back()->with('message','Registro creado correctamente!');

    }
    public function show($id)
    { 
        return view("transaccion.propuesta.show",["propuesta"=>Propuesta::findOrFail($id)]);
    }
    public function edit($id)
    { 
        $propuestas= Propuesta::findOrFail($id);
        $responsable = Responsable::all();
       /* $responsable = DB::table('responsables as rp')
        ->join('actividades_propuestas as ap', 'ap.responsable_id', '=', 'rp.id')
        ->select('rp.nombre as nombre')->get();*/
        $detalle = DetalleMejora::all();
       
        return view("transaccion.propuesta.edit",['responsable'=> $responsable, 'detalle'=> $detalle ,"propuestas"=>$propuestas]);
    }
    public function update(ActividadesPropuestasFormRequest $request,$id)
    {
             //   dd($request->all());

        $propuesta= Propuesta::findOrFail($id);
        $propuesta-> detalle_plan_mejora_id= $request-> get('detalle_plan_mejora_id');
        $propuesta-> descri_actividades = $request-> get('descri_actividades');
        $propuesta-> medio_verificacion = $request-> get('medio_verificacion');
        $propuesta-> plazo= $request-> get('plazo');
        $propuesta-> responsable_id= $request-> get('responsable_id');
        $propuesta-> fuente_financiamiento= $request-> get('fuente_financiamiento');
        $propuesta-> inversion_prevista= $request-> get('inversion_prevista');
        $propuesta-> estado='Propuesta';
       // $propuesta->updated_at = Carbon\Carbon::now();
        $propuesta->update();

        return back()->with('message','Registro actualizado correctamente!');
    }
    public function eliminar(Request $request)
    {
        $propuesta=Propuesta::findOrFail($request->id);
        try {
        $propuesta->estado='Propuesta';
        $propuesta->delete();
        return back()->with('message','Registro eliminado correctamente!');
    } catch (\Exception $e) {
        return back()->with('danger','Registro relacionado imposible de eliminar.');

    }
}

    public function byPropuesta(){
        return Propuesta::get();
    }

    
    
    public function reporte(){
        //Obtenemos los registros
       
        $propuestas= DB::table('actividades_propuestas as ap')
        ->join('detalle_plan_mejoras as dp', 'dp.id', '=', 'ap.detalle_plan_mejora_id')
        ->join('responsables as pro', 'pro.id', '=', 'ap.responsable_id')
        ->select('ap.*', 'dp.recomendacion_mejora','pro.descri_responsable')
        ->orderBy('id','desc')        
        ->get();
        $datos=date('d/m/Y');
        $pdf=PDF::loadView('pdf.propuesta',['propuestas'=>$propuestas, 'datos'=> $datos]);
        return $pdf->stream('propuesta.pdf');

    }

}

