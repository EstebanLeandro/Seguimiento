<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Mejora;
use App\Models\SedeCarrera;
use App\Models\DetalleMejora;
use App\Models\Dimension;
use App\Models\Carrera;
use App\Models\Responsable;
use App\Models\Propuesta;
use App\Models\Sede;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\MejoraFormRequest;
use App\Http\Requests\DetalleMejoraFormRequest;
use App\Http\Requests\sedeCarreraFormRequest;
use App\Http\Requests\ResponsableFormRequest;
use App\Http\Requests\DimensionFormRequest;
use App\Http\Requests\CarreraFormRequest;
use App\Http\Requests\SedeFormRequest;
use DB;
use PDF;


class MejoraController extends Controller
{
  function __construct()
  {
        $this->middleware('permission:ver-plan-mejoras|crear-plan-mejoras|editar-plan-mejoras|borrar-plan-mejoras', ['only' => ['index','create','createDetalle','detalleMejora']]);
        $this->middleware('permission:crear-plan-mejoras', ['only' => ['create','store','detalleMejora','createDetalle','storeDetalle']]);
        $this->middleware('permission:editar-plan-mejoras', ['only' => ['edit','update','editDetalle','updateDetalle']]);
        $this->middleware('permission:borrar-plan-mejoras', ['only' => ['destroy','eliminar']]);
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
           -> orderBy('pm.id', 'asc')
           ->paginate(10);
            return view('transaccion.mejora.index',["plan_mejoras"=>$plan_mejoras,"searchText"=>$query]);
        }
    }


    public function detalleMejora(Request $request){
        $detalle = DetalleMejora::findOrFail($request->id);
        $responsables = Responsable::all();
        $dimension = Dimension::all();
        $propuesta = Propuesta::all();
        return view ('transaccion.propuesta.create', ['propuesta'=>$propuesta ,'responsables'=> $responsables , 'detalle' =>$detalle]);

        // $propuesta = Propuesta::all();
        // $detalle_mejoras = DetalleMejora::all();  
        // return $detalle_mejoras;

    }

    public function create()
    
    {   
        $sede = Sede::get();
       /* $sede = DB::table('carrera_sede')
        ->join('sedes', 'sedes.id','=','carrera_sede.sede_id')
        ->select('carrera_sede.sede_id','sedes.descri_sede as sede')
        ->distinct('sede')
        ->get();*/
        
        $carrera = Carrera::all();
        $plan_mejoras = Mejora::all();
        $periodos = Periodo::all();
       // $sede_carrera = SedeCarrera::all();
        $detalle_plan_mejoras = DetalleMejora::orderBy('id', 'DESC')->paginate(5);
        //$detalle_plan_mejoras = DetalleMejora::latest()->take(5)->get();
        $dimension = Dimension::all();
        $responsables = DB::table('responsables')-> get();
    	return view('transaccion.mejora.create', [ 'periodos'=>$periodos ,'responsables'=> $responsables,'carrera' =>$carrera,'sede'=>$sede, 'plan_mejoras'=> $plan_mejoras, 'detalle_plan_mejoras' => $detalle_plan_mejoras, 'dimension' => $dimension]);
    }
    public function store(MejoraFormRequest $request)

    {
        $input = $request->all();
      // dd($request->all());
        try {

            
            DB::beginTransaction();

             $plan_mejora = Mejora::create([
                 "fecha_presentacion" => $input["fecha_presentacion"],
                 "periodo_id" => $input["periodo_id"],
                 "sede_id" =>  $input["sede_id"],
                 "carrera_id" =>  $input["carrera_id"],
                
            ]);
                //dd($request->all());
          // foreach($input["dimension_id"] as $key => $value){
               /*  $detalle = DetalleMejora::create([
                   "dimension_id"=>$input["dimension_id"],
                     "plan_mejora_id"=>$plan_mejora->id,
                     "recomendacion_mejora" => $input["recomendacion_mejora"]
                 ]);*/
             
    	DB::commit();
    } catch (\Exception $e) {
    	DB::rollback();
        dd($e->getMessage());
    }
       return Redirect::to('transaccion/mejora')->with('message','Registro creado correctamente');
       // return redirect()->route('miroute/nombre', ['variable' => $plan_mejora->id]);
       //dd($detalle->recomendacion_mejora);
       // return view('transaccion/mejora/create', ['responsables'=> $responsables,'detalle'=> $detalle->id, 'mejora'=> $detalle->recomendacion_mejora]);

    }

    public function createDetalle(Request $request){
    /*  $id = $request->input("id");
      $detalle = [];
      if($id != null){
          $detalle = DetalleMejora::select("dimensions.*", "detalle_plan_mejoras.dimension_id as dimension")
          ->join("detalle_plan_mejoras", "dimension.id", "=", "detalle_plan_mejoras.dimension_id")
          ->where("detalle_plan_mejoras.dimension_id", $id)
          ->get();
      }

      $dimension= Dimension::select("dimensions.*", "detalle_plan_mejoras.recomendacion_mejora as recomendacion_mejora")
      ->join("detalle_plan_mejoras", "detalle_plan_mejoras.dimension_id", "=", "dimensions.id")
      ->get();*/

        $detalle =  DB::table('detalle_plan_mejoras as dp') 
        -> join('plan_mejoras as pm','pm.id','=','dp.plan_mejora_id')
        -> join('dimensions as dm','dp.dimension_id','=','dm.id')
        -> select('dp.*', 'dm.descri_dimension','dp.recomendacion_mejora')
        -> where('pm.id', '=', $request->id) 
        -> orderBy('dp.id', 'desc')
        -> paginate(10);      
        $plan_mejoras=DB::table('plan_mejoras as pm')
        -> join('carreras as ca','pm.carrera_id','=','ca.id')
        -> join('sedes as se','pm.sede_id','=','se.id')
        -> join('periodos as pr','pr.id','=','pm.periodo_id')
        -> select('pm.*','pm.fecha_presentacion','pr.descri_periodo as periodo','se.descri_sede as sede','ca.descri_carrera as carrera')
        -> where('pm.id','=',$request->id)         
        -> orderBy('pm.id', 'asc')
        -> first();
        $dimension = Dimension::distinct('dimemsions')->get();

        //$dimension = DB::table('detalle_plan_mejoras as dp') 
        // -> where('dimensions as dm','detalle_plan_mejoras.dimension_id','=','dm.id')        
        // //-> select('dp.*', 'dm.descri_dimension')
        // ->get();
        return view("transaccion.detalle.create",["dimension"=>$dimension,"detalle"=>$detalle, "plan_mejoras" =>$plan_mejoras]);

    }
    public function storeDetalle(DetalleMejoraFormRequest $request){
       // dd($request->all());
        $detalle=new DetalleMejora;
        $detalle->recomendacion_mejora=$request->get('recomendacion_mejora');
        $detalle->plan_mejora_id=$request->get('plan_mejora_id');
        $detalle->dimension_id=$request->get('dimension_id');
        $detalle->save();
        return back()->with('message','Registro creado correctamente!');

    }

    public function show(Request $request){

      // $plan_mejoras=DB::table('plan_mejoras as pm')
      // -> join('sede_carrera as sc', 'sc.id', '=', 'pm.sede_carrera_id')
      // -> join('detalle_plan_mejoras as dp','pm.id','=','dp.plan_mejora_id')
      // -> join('sede as sd', 'sd.id', '=', 'sc.sede_id')
      // -> join('carrera as ca', 'ca.id', '=', 'sc.carrera_id')
      // -> select('pm.id', 'pm.fecha_presentacion as fecha_presentacion', 'pm.periodo as periodo','sd.descri_sede as sede','ca.descri_carrera as carrera', 'dp.recomendacion_mejora')
      // //  -> select('*')
      // -> where ('pm.id','=', $id)
      // -> first();


      //   $detalles = DB::table('detalle_plan_mejora as dp') 
      //    -> join('dimension as dm','dp.dimension_id','=','dm.id')
      //    -> select('*')
      //    -> where ('dp.id', '=', $id) 
      //    -> get();

         $id = $request->input("id");
         $detalles = [];
         if($id != null){
             $detalles = DetalleMejora::select("dimension.*", "detalle_plan_mejoras.dimension_id as dimension")
             ->join("detalle_plan_mejoras", "dimension.id", "=", "detalle_plan_mejoras.dimension_id")
             ->where("detalle_plan_mejoras.producto_id", $id)
             ->get();
         }
 
        //  $dimension= Dimension::select("dimension.*", "detalle_plan_mejoras.nombre as detalle_plan_mejoras")
        //  ->join("detalle_plan_mejoras", "detalle_plan_mejoras.dimension_id", "=", "dimension.id")
        //  ->get();
 
         return view("transaccion.mejora.crear", compact("dimension", "detalles"));
     

        //  return view('transaccion.mejora.show', ['plan_mejoras'=> $plan_mejoras, 'detalles' => $detalles]);
    
    }
    public function edit($id)
    {
        $sede = DB::table('carrera_sede')
        ->join('sedes', 'sedes.id','=','carrera_sede.sede_id')
        ->select('carrera_sede.sede_id','sedes.descri_sede as sede')
        ->distinct('sede')
        ->get();
       // $plan_mejora = Mejora::findOrFail($id);
        $plan_mejora=DB::table('plan_mejoras as pm')
        -> join('carreras as ca','pm.carrera_id','=','ca.id')
        -> join('sedes as se','pm.sede_id','=','se.id')
        -> join('periodos as pr','pr.id','=','pm.periodo_id')
        -> select('pm.*','pm.fecha_presentacion','pr.descri_periodo as periodo','se.descri_sede as sede','ca.descri_carrera as carrera')
        -> where('pm.id','=',$id)         
        -> orderBy('pm.id', 'asc')
        -> first();
        $periodo =  Periodo::all();
  
        return view ('transaccion.mejora.edit', ['sede'=>$sede,'periodo'=>$periodo,'plan_mejora'=>$plan_mejora]);
    }


    public function editDetalle($id)
    { 
       
        $detalle =  DetalleMejora::findOrFail($id);
        $dimension = DB::table('dimensions')->get();
       
  
          return view ('transaccion.detalle.editar', ['dimension' => $dimension, 'detalle' =>DetalleMejora::findOrFail($id)]);
    }

    public function updateDetalle(DetalleMejoraFormRequest $request,$id){
      //  dd($request->all());
    $detalle= DetalleMejora::findOrFail($id);
    $detalle->dimension_id = $request->get('dimension_id');
    $detalle->recomendacion_mejora = $request->get('recomendacion_mejora');

    $detalle->update();
    return Redirect::to('transaccion/mejora/create')
    ->with('message','Registro actualizado correctamente!');
  // return Redirect::to('transaccion/mejora/create')->with('message','Registro actualizado correctamente');
}
    public function update(MejoraFormRequest $request,$id)
     {
       // dd($request->all());
         $plan_mejora= Mejora::findOrFail($id);
         $plan_mejora ->periodo_id = $request -> get('periodo_id');
         $plan_mejora ->sede_id = $request ->get('sede_id');
         $plan_mejora ->carrera_id = $request -> get('carrera_id');
         $plan_mejora->fecha_presentacion=$request->get('fecha_presentacion');
         $plan_mejora->update();
         return Redirect::to('transaccion/mejora')->with('message','Registro actualizado correctamente');
     }
    public function destroy($id)
    {           
          $plan_mejoras=Mejora::findOrFail($id);

        try {       

            $plan_mejoras->delete();
            return back()->with('message','Registro eliminado correctamente');
        } catch (\Exception $e) {
           return back()->with('danger','Registro relacionado imposible de eliminar.');
        }
      
    }
    public function eliminar(Request $request)

    {
        
       $detalle =Mejora::where('id', $request->plan_mejora_id)->delete();       

        $detalle=DetalleMejora::findOrFail($request->id);
        try {   

            $detalle->delete();
            return back()
            ->with('message','Registro eliminado correctamente');
         } catch (\Exception $e) {
            return back()
            ->with('danger','Registro relacionado imposible de eliminar.');
      }
      
    }
     
    // public function miFuncion(Request $request)
    // {
    //     // id de sala
    //     $carrera_id = $request->get('id');
    //     // instancia sala
    //     $carrera = Carrera::with('sede')->find($carrera_id);

    //     return $carrera;
    // }
    
    public function byCarrera($id){
        
         $sede = Sede::with('carreras')->find($id);
          return $carreras = $sede->carreras;
        //return  $sede = Sede::with('carreras')->findOrFail($id); 
         // $carreras = $sede->carreras; 
          
         // return Redirect::to('sede/carrera');

         
        
     }

    //  public function informe(Request $request) 
    // {
    //     //require('fpdf181/fpdf.php');
    //     $pdf = new FPDF('p', 'mm', 'A4');
    //     $pdf->AddPage();
    //     $pdf->SetFont('Arial','B',16);
    //     $pdf->Cell(40,10,'Hello World!');
    //     $pdf->Output(); 

    //    // exit;
    // }


    public function reporte(){
        //Obtenemos los registros
        $registros=DB::table('plan_mejoras as pm')
        -> join('detalle_plan_mejoras as dp','pm.id','=','dp.plan_mejora_id')
        -> join('periodos as pe','pe.id','=','pm.periodo_id')
        -> select('pm.id', 'pm.fecha_presentacion', 'dp.recomendacion_mejora','pe.descri_periodo as periodo')
        //->orderBy('pm.fecha_presentacion','asc')
        ->get();
        $datos=date('d/m/Y');
        $pdf=PDF::loadView('pdf.mejora',['registros'=>$registros, 'datos'=> $datos]);
        return $pdf->stream('mejora.pdf');
         $pdf = new PDF();
         $pdf::AddPage();
          $pdf::SetTextColor(35,56,113);
          $pdf::SetFont('Arial','B',11);
          $pdf::Cell(0,10,utf8_decode("Listado Plan de Mejora"),0,"","C");
          $pdf::Ln();
          $pdf::Ln();
          $pdf::SetTextColor(0,0,0); // Establece el color del texto 
          $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
          $pdf::SetFont('Arial','B',10); 
         //El ancho de las columnas debe de sumar promedio 190 
          $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
          $pdf::cell(80,8,utf8_decode("Fecha"),1,"","L",true);
       
          $pdf::cell(65,8,utf8_decode("Sede"),1,"","L",true);
          $pdf::cell(15,8,utf8_decode("Carrera"),1,"","L",true);
          $pdf::cell(15,8,utf8_decode("Recomendación"),1,"","L",true);

          $pdf::Ln();
          $pdf::SetTextColor(0,0,0); // Establece el color del texto 
          $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
          $pdf::SetFont("Arial","",9);
          foreach ($registros as $reg)
          {
          $pdf::cell(30,6,utf8_decode($reg->id),1,"","L",true);
          $pdf::cell(80,6,utf8_decode($reg->fecha_presentacion),1,"","L",true);
          $pdf::cell(65,6,utf8_decode($reg->sede),1,"","L",true);
          $pdf::cell(15,6,utf8_decode($reg->carrera),1,"","L",true);
            $pdf::cell(15,6,utf8_decode($reg->recomendacion_mejora),1,"","L",true);

         $pdf::Ln(); 
         }
         $pdf::Output();
         exit;
         }
        }


