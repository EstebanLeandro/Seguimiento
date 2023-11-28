<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Realizada;
use App\Models\Propuesta;
use App\Models\Responsable;

use App\Models\Dimension;
use App\Models\DetalleMejora;
use App\Models\DetalleMedio;
use App\Models\MedioVerificacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ActividadesRealizadasFormRequest;
use App\Http\Requests\ActividadesPropuestasFormRequest;
use App\Http\Requests\DetalleMejoraFormRequest;
use App\Http\Requests\DimensionFormRequest;
use App\Http\Requests\ResponsableFormRequest;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



class RealizadaController extends Controller


{
    function __construct()
    {
          $this->middleware('permission:ver-seguimiento-plan-mejoras|crear-seguimiento-plan-mejoras|editar-seguimiento-plan-mejoras|borrar-seguimiento-plan-mejoras', ['only' => ['index','verMejora','verPropuesta']]);
          $this->middleware('permission:crear-seguimiento-plan-mejoras', ['only' => ['create','store','createArchivo','storeArchivo']]);
          $this->middleware('permission:editar-seguimiento-plan-mejoras', ['only' => ['edit','update']]);
          $this->middleware('permission:borrar-seguimiento-plan-mejoras', ['only' => ['eliminar']]);
     }
    public function index(Request $request)
    {
        if ($request)

        {
            $query=trim($request->get('searchText'));
           // $plan_mejoras= Mejora::orderBy('id', 'DESC')->where('sede_id', auth()->sedes()->id);

            $plan_mejoras=DB::table('plan_mejoras as pm')
           //-> join('detalle_plan_mejoras as dpm','pm.id','=','dpm.plan_mejora_id')
           -> join('carreras as ca','pm.carrera_id','=','ca.id')
           -> join('sedes as se','pm.sede_id','=','se.id')
           -> join('periodos as pr','pr.id','=','pm.periodo_id')

          // -> join('carrera_sede as cs','cs.sede_id','=','pm.sede_id')
           -> select('pm.id','pm.fecha_presentacion','pr.descri_periodo as periodo','se.descri_sede as sede','ca.descri_carrera as carrera')
        //   -> select('*')

           -> where('pm.fecha_presentacion','LIKE','%'.$query.'%')
//->where('pm.id', $request->id)         
           -> orderBy('pm.id', 'desc')
           ->paginate(7);
            return view('transaccion.realizada.index',["plan_mejoras"=>$plan_mejoras,"searchText"=>$query]);
        }
    }

    public function create(Request $request)
    {
       // dd($request).all();
        //$detalle = DetalleMejora::findOrFail($request->id);
        $real = MedioVerificacion::all();
        // $dimension= MedioVerificacion::select("dimension.*", "detalle_plan_mejoras.nombre as detalle_plan_mejoras")
        // ->join("detalle_plan_mejoras", "detalle_plan_mejoras.dimension_id", "=", "dimension.id")
        // ->get();

        $propuestas = Propuesta::findOrFail($request->id);
        $medio_verificacion = DB::table('medio_verificacions')-> get();
        $responsables = DB::table('responsables')-> get();
        $realizadas= DB::table('actividades_realizadas as ar')
        ->join('actividades_propuestas as ap', 'ap.id', '=', 'ar.actividades_propuesta_id')
        ->join('detalle_verificacions as dv', 'dv.actividades_realizada_id', '=', 'ar.id')
        ->join('medio_verificacions as mv', 'dv.medio_verificacion_id', '=', 'mv.id')
        ->join('responsables as pro', 'pro.id', '=', 'ar.responsable_id')
        ->select('ar.*', 'ap.descri_actividades','pro.descri_responsable','mv.descri_verificacion as verificacion')
        -> where('ap.id','=',$request->id)         
        -> orderBy('ar.id', 'desc')
        -> paginate(7);
        $detalles=DB::table('detalle_verificacions as d')
        ->join('medio_verificacions as a', 'd.medio_verificacion_id', '=', 'a.id')
        ->select('a.descri_verificacion as verificacion')
        ->where('d.actividades_realizada_id', '=', $request->id)->get();
       // dd($realizadas).all();
        return view("transaccion.realizada.create", ['detalles'=>$detalles,'medio_verificacion'=>$medio_verificacion,'responsables'=>$responsables ,'real' => $real,'realizadas' => $realizadas, 'propuestas'=> $propuestas]);
    }
    public function store (ActividadesRealizadasFormRequest $request)
    {
        $this->validate($request, [
            'descri_verificacion' => 'required',
        ]);
        try {
       // dd($request).all();
    	//DB::beginTransaction();
        // $realizada = Realizada::create([
            DB::beginTransaction();

             $realizada = Realizada::create([
                
            "actividades_propuesta_id" => $request->input('actividades_propuesta_id'),
            "responsable_id" =>$request-> input('responsable_id'),
          "descri_realizadas" => $request-> input('descri_realizadas'),
         "medio_verificacion" => $request-> input('medio_verificacion'),
         "plazo"=> $request-> input('plazo'),
         "cumplimiento"=> $request-> input('cumplimiento'),
         "resultados"=> $request-> input('resultados'),
         "avance"=> $request-> input('avance'),
         "pendientes"=> $request-> input('pendientes'),
          "estado"=> 'realizada',
        ]);

         
         $input = $request->all();
      /*   foreach($input["descri_verificacion"] as $key1 => $value1){
                     $results1[] = array("descri_verificacion"=>$value1);
                 }
        $realizada->medio_verificacions()->createMany($results1);*/
        foreach($input["descri_verificacion"] as $key => $value){
              $detalle = DetalleMedio::create([
                "medio_verificacion_id"=>$value,
                  "actividades_realizada_id"=>$realizada->id,
              ]);

            }
        DB::commit();

             } catch (\Exception $e) {
                 DB::rollback();
                 dd($e->getMessage());

             }
             return back()->with('message','Registro creado correctamente!');
    
         }
   //   try {

    // 	DB::beginTransaction();


    //     $realizada =new Realizada;
    //     $realizada-> actividades_propuesta_id = $request-> get('actividades_propuesta_id');
    //     $realizada-> responsable_id = $request-> get('responsable_id');
    //     $realizada-> descri_realizadas = $request-> get('descri_realizadas');
    //    // $realizada-> medio_verificacion = $request-> get('medio_verificacion');
    //     $realizada-> plazo= $request-> get('plazo');
    //     $realizada-> cumplimiento= $request-> get('cumplimiento');
    //     $realizada-> resultados= $request-> get('resultados');
    //     $realizada-> avance= $request-> get('avance');
    //     $realizada-> pendientes= $request-> get('pendientes');
    //     $realizada-> estado= 'realizada';
    //     $realizada->save();


   
    // $cont=0;

    // foreach($request as $med){

    //         $detalle = new DetalleMedio();
    //         $detalle -> actividades_realizada_id = $realizada -> id;
    //         $detalle -> medio_verificacion_id = $med->medio_id;
    //         $detalle -> save();
    //         $cont+1;
    //         dd($request).all();

    // }
        
    //         DB::commit();

    //     } catch (\Exception $e) {
    //         DB::rollback();

    //     }
    //     return back()->with('message','Registro creado correctamente!');

    // }



    public function createArchivo(Request $request)
    {
        return view("transaccion.realizada.medio_verificacion");

	}
    public function storeArchivo(Request $request)
    {
        $request->validate([
            'url' => 'required|unique:medio_verificacions,url',

            //'file' => 'required|pdf',
            'descri_verificacion' => 'required'

            ]);

            //Obtener el nombre de la imagen completo con su extension
            $nombre_imagen_con_extension = $request->file('url')->getClientOriginalName();

            // Obtener solo el nombre de la imagen, sin la extension
            $nombre_imagen = pathinfo($nombre_imagen_con_extension,PATHINFO_FILENAME);
            
            //Obtener solo la extension de la imagen
            $extension_imagen = $request->file('url')->getClientOriginalExtension();

            /**
             * Aqui especificas el nombre de la imagen que quieres guardarlo asi: imagen.jpg
             * pero si por casualidad se llega a subir dos imagenes con el mismo nombre y
             * la misma extension habria un error o se reemplazaria la imagen anterior,
             * es por eso que deberias concatenar el nombre de las imagenes con algun
             * numero o texto aleatorio asi: imagen_4374384738.jpg
             */

            $nombre_a_guardar = $nombre_imagen.'.'.$extension_imagen;
            //$nombre_a_guardar = $nombre_imagen.'_'.time().'.'.$extension_imagen; //por si lo quieres hacer asi

            // Subir la imagen
            $request->file('url');


         $request->file('url')->storeAs('public/documentos',$nombre_a_guardar);

        $medio = new MedioVerificacion();    
        $medio->descri_verificacion= $request->descri_verificacion;
        $medio->url = $nombre_a_guardar;            
      
        $medio->save(); 
        //return response()->json($medio);   
        return back()->with('message','Registro creado correctamente!');
    }   
    public function show($id)
    {
        return view("transaccion.realizada.show",["realizada"=>realizada::findOrFail($id)]);
    }
    public function edit(Request $request, $id)
    {
     //$realizada= Realizada::findOrFail($id);
       $realizada= DB::table('actividades_realizadas as ar')
       ->join('actividades_propuestas as ap', 'ap.id', '=', 'ar.actividades_propuesta_id')
       ->join('responsables as pro', 'pro.id', '=', 'ar.responsable_id')
       ->select('ar.*', 'ap.descri_actividades','pro.descri_responsable')
       -> where('ar.id','=',$id)         
       -> first();

       $detalles=DB::table('detalle_verificacions as d')
       ->join('medio_verificacions as a', 'd.medio_verificacion_id', '=', 'a.id')
       ->select('a.descri_verificacion as verificacion')
       ->where('d.actividades_realizada_id', '=', $id)->get();
       $responsable = Responsable::all();
        $propuesta = Propuesta::all();
        $medio_verificacion = DB::table('medio_verificacions')-> get();

        return view("transaccion.realizada.edit",['detalles'=> $detalles, 'medio_verificacion'=> $medio_verificacion,'responsable'=> $responsable,'propuesta'=> $propuesta, "realizada"=>$realizada]);
    }
    public function update(ActividadesRealizadasFormRequest $request,$id)
    {
        $realizada= Realizada::findOrFail($id);
        $realizada-> actividades_propuesta_id= $request-> get('actividades_propuesta_id');
        $realizada-> responsable_id= $request-> get('responsable_id');
        $realizada-> descri_realizadas = $request-> get('descri_realizadas');
     //   $realizada-> medio_verificacion = $request-> get('medio_verificacion');
        $realizada-> cumplimiento= $request-> get('cumplimiento');
        $realizada-> resultados= $request-> get('resultados');
        $realizada-> plazo= $request-> get('plazo');
        $realizada-> avance= $request-> get('avance');
        $realizada-> pendientes= $request-> get('pendientes');
        $realizada-> estado= 'realizada';
        $realizada->update();



        // $input = $request->all();
        // /*   foreach($input["descri_verificacion"] as $key1 => $value1){
        //                $results1[] = array("descri_verificacion"=>$value1);
        //            }
        //   $realizada->medio_verificacions()->createMany($results1);*/
        //   foreach($input["descri_verificacion"] as $key => $value){
        //         $detalle = DetalleMedio::sync([
        //           "medio_verificacion_id"=>$value,
        //             "actividades_realizada_id"=>$realizada->id,
        //         ]);
  
        //       }
        return back()->with('message','Registro actualizado correctamente!');
    }
    public function eliminar($id)
    {
        $realizada=Realizada::findOrFail($id);
        try {
            $realizada->estado='realizada';
            $realizada->delete();
            return back()->with('message','Registro eliminado correctamente!');
        } catch (\Exception $e) {
            return back()->with('message','Registro relacionado imposible de eliminar');

        }

    }
    public function verMejora(Request $request){
        $detalle =  DB::table('detalle_plan_mejoras as dp') 
        -> join('plan_mejoras as pm','pm.id','=','dp.plan_mejora_id')
        -> join('dimensions as dm','dp.dimension_id','=','dm.id')
        -> select('dp.*', 'dm.descri_dimension')
        -> where('pm.id', '=', $request->id) 
        -> paginate(7);
        $plan_mejoras=DB::table('plan_mejoras as pm')
        -> join('carreras as ca','pm.carrera_id','=','ca.id')
        -> join('sedes as se','pm.sede_id','=','se.id')
        -> join('periodos as pr','pr.id','=','pm.periodo_id')
        -> select('pm.*','pm.fecha_presentacion','pr.descri_periodo as periodo','se.descri_sede as sede','ca.descri_carrera as carrera')
        -> where('pm.id','=',$request->id)         
        -> orderBy('pm.id', 'asc')
        -> first();
        //$detalle = DetalleMejora::all();

        $dimension = Dimension::all();
        return view("transaccion.realizada.ver_mejora",["dimension"=>$dimension,"detalle"=>$detalle, "plan_mejoras" =>$plan_mejoras]);

    }
    public function verPropuesta(Request $request){
        {
            $detalle = DetalleMejora::findOrFail($request->id);
            $propuesta =  DB::table('actividades_propuestas as ap')
            ->join('detalle_plan_mejoras as dp', 'dp.id', '=', 'ap.detalle_plan_mejora_id')
            ->join('responsables as pro', 'pro.id', '=', 'ap.responsable_id')
            ->select('ap.*', 'dp.recomendacion_mejora','pro.descri_responsable')
            -> where('dp.id','=',$request->id)         
            -> orderBy('ap.id', 'asc')
            -> get();
            $responsable = DB::table('responsables')->get();
          //  $detalle= DetalleMejora::findOrFail($request->id);
            return view("transaccion.realizada.ver_propuesta", ['propuesta'=>$propuesta,'detalle' => $detalle, 'responsable'=> $responsable]);
        }

    }
    public function byPropuesta($id){
       /*return  $propuesta =  DB::table('actividades_propuestas as ap')
            ->join('detalle_plan_mejoras as dp', 'dp.id', '=', 'ap.detalle_plan_mejora_id')
            ->join('responsables as pro', 'pro.id', '=', 'ap.responsable_id')
            ->select('ap.*', 'dp.recomendacion_mejora','pro.descri_responsable')
            ->where('ap.id','=',$id)
            ->get();*/
            return   Propuesta::find($id);
            //return $propuesta = $propuestas->detalle_plan_mejoras;
        
    }

    public function reporte(){
        //Obtenemos los registros
       
        $realizadas= DB::table('actividades_realizadas as ar')
              ->join('actividades_propuestas as ap', 'ap.id','=','ar.actividades_propuesta_id')
              ->join('responsables as re', 're.id','=','ar.responsable_id')
              ->join('responsables as pro', 'pro.id', '=', 'ar.responsable_id')
              ->select('ar.*','ap.*','re.*')
              ->orderBy('ar.id','desc')        

        ->get();
        $datos=date('d/m/Y');
        $pdf=PDF::loadView('pdf.realizada',['realizadas'=>$realizadas, 'datos'=> $datos]);
        return $pdf->stream('realizada.pdf');

    }

}

