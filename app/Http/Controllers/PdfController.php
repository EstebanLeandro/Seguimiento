<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mejora;
use App\Models\Realizada;
use App\Models\Propuesta;
use App\Models\Dimension;
use App\Http\Requests\MejoraFormRequest;
use DB;
use PDF;

class PdfController extends Controller
{
        public function __construct()
        {
       //     $this->middleware('auth');
        }
        public function mejoraPDF($id)
{
        $mejora = Mejora::find($id)
        ->join("detalle_plan_mejoras","detalle_plan_mejoras.plan_mejora_id","=","plan_mejoras.id")
        -> join('sedes', 'sedes.id', '=', 'plan_mejoras.sede_id')
        -> join('carreras', 'carreras.id', '=', 'plan_mejoras.carrera_id')
        -> join('periodos', 'periodos.id', '=', 'plan_mejoras.periodo_id') 
        -> select('plan_mejoras.fecha_presentacion','periodos.descri_periodo as periodos','sedes.descri_sede as sede','carreras.descri_carrera as carrera')
       ->where("plan_mejoras.id",'=',$id)
       ->first();

       $dimension  = Dimension::get();
    
       $propuesta = Propuesta::join("detalle_plan_mejoras","detalle_plan_mejoras.id","=","actividades_propuestas.detalle_plan_mejora_id")
       ->join("plan_mejoras","plan_mejoras.id","=","detalle_plan_mejoras.plan_mejora_id")
       ->join("responsables","responsables.id","=","actividades_propuestas.responsable_id")
       ->join('dimensions','dimensions.id','=','detalle_plan_mejoras.dimension_id')
       ->select( DB::raw("SELECT dimension_id,SUM(DISTINCT quantity)as descri_dimension  FROM detalle_plan_mejoras GROUP BY dimension_id ORDER BY descri_dimension DESC LIMIT 1"))
       ->select(
         'detalle_plan_mejoras.recomendacion_mejora',
         'actividades_propuestas.descri_actividades', 
         'actividades_propuestas.plazo', 
         'actividades_propuestas.medio_verificacion', 
         'actividades_propuestas.fuente_financiamiento', 
         'actividades_propuestas.inversion_prevista',
         'dimensions.descri_dimension',
         'responsables.descri_responsable')

      ->where("plan_mejoras.id",'=',$id) 
       ->where('dimensions.id','!=','dimensions.id')     
      ->groupBy( 
       'detalle_plan_mejoras.recomendacion_mejora',
       'actividades_propuestas.descri_actividades', 
       'actividades_propuestas.plazo', 
       'actividades_propuestas.medio_verificacion', 
       'actividades_propuestas.fuente_financiamiento', 
       'actividades_propuestas.inversion_prevista',
       'dimensions.descri_dimension',
       'responsables.descri_responsable'
       )
       ->get();
      
     

       
 
     //dd($informe, $realizada);
       $datos=date('d/m/Y');
       $pdf=PDF::loadView('pdf.mejora',['mejora'=>$mejora,'dimension'=>$dimension, 'propuesta'=>$propuesta, 'datos'=> $datos])->setPaper('a4', 'landscape');
       return $pdf->stream('mejora.pdf');
      
    }

        public function informePDF($id)

    {
       $informe = Mejora::find($id)
        ->join("detalle_plan_mejoras","detalle_plan_mejoras.plan_mejora_id","=","plan_mejoras.id")
        -> join('sedes', 'sedes.id', '=', 'plan_mejoras.sede_id')
        -> join('carreras', 'carreras.id', '=', 'plan_mejoras.carrera_id')
        -> join('periodos', 'periodos.id', '=', 'plan_mejoras.periodo_id') 
        -> select('plan_mejoras.fecha_presentacion','periodos.descri_periodo as periodos','sedes.descri_sede as sede','carreras.descri_carrera as carrera')
       ->where("plan_mejoras.id",'=',$id)
       ->first();

       $dimension  = Dimension::get();
    
       $realizada = Realizada::join("actividades_propuestas","actividades_propuestas.id","=","actividades_realizadas.actividades_propuesta_id")
       ->join("detalle_plan_mejoras","detalle_plan_mejoras.id","=","actividades_propuestas.detalle_plan_mejora_id")
       ->join("plan_mejoras","plan_mejoras.id","=","detalle_plan_mejoras.plan_mejora_id")
       ->join('detalle_verificacions', 'detalle_verificacions.actividades_realizada_id', '=', 'actividades_realizadas.id')
       ->join('medio_verificacions', 'detalle_verificacions.medio_verificacion_id', '=', 'medio_verificacions.id')
       ->join("responsables","responsables.id","=","actividades_propuestas.responsable_id")
       ->join('dimensions','dimensions.id','=','detalle_plan_mejoras.dimension_id')
       ->select( DB::raw("SELECT dimension_id,SUM(DISTINCT quantity)as descri_dimension  FROM detalle_plan_mejoras GROUP BY dimension_id ORDER BY descri_dimension DESC LIMIT 1"))
       ->select(
        'medio_verificacions.descri_verificacion',
        'actividades_propuestas.descri_actividades',
       'actividades_realizadas.descri_realizadas', 
       'actividades_realizadas.plazo', 
       'actividades_realizadas.cumplimiento',
       'actividades_realizadas.resultados',
       'actividades_realizadas.avance',
       'actividades_realizadas.pendientes',
       'dimensions.descri_dimension',
       'responsables.descri_responsable')

      ->where("plan_mejoras.id",'=',$id) 
       ->where('dimensions.id','!=','dimensions.id')     
      ->groupBy( 
        'medio_verificacions.descri_verificacion',
       'actividades_propuestas.descri_actividades',
       'actividades_realizadas.descri_realizadas', 
       'actividades_realizadas.plazo', 
       'actividades_realizadas.cumplimiento',
       'actividades_realizadas.resultados',
       'actividades_realizadas.avance',
       'actividades_realizadas.pendientes',
       'responsables.descri_responsable',
       )
       ->get();

      //  $dimension= MedioVerificacion::select("dimension.*", "detalle_plan_mejoras.nombre as detalle_plan_mejoras")
      //  ->join("detalle_plan_mejoras", "detalle_plan_mejoras.dimension_id", "=", "dimension.id")
      //  ->get();
      
     

       
 
     //dd($informe, $realizada);
       $datos=date('d/m/Y');
       $pdf=PDF::loadView('pdf.informe',['informe'=>$informe,'dimension'=>$dimension, 'realizada'=>$realizada, 'datos'=> $datos])->setPaper('a4', 'landscape');
       return $pdf->stream('informe.pdf');
  
    }
    //  $pdf = new Fpdf();
    //  $pdf::AddPage();
    //  $pdf::SetTextColor(35,56,113);
    //  $pdf::SetFont('Arial','B',11);
    //  $pdf::Cell(0,10,utf8_decode("Listado Plan de Mejora"),0,"","C");
    //  $pdf::Ln();
    //  $pdf::Ln();
    //  $pdf::SetTextColor(0,0,0); // Establece el color del texto 
    //  $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
    //  $pdf::SetFont('Arial','B',10); 
    //  //El ancho de las columnas debe de sumar promedio 190 
    //  $pdf::cell(30,8,utf8_decode("Código"),1,"","L",true);
    //  $pdf::cell(80,8,utf8_decode("Fecha"),1,"","L",true);
    
    //  $pdf::cell(65,8,utf8_decode("Sede"),1,"","L",true);
    //  $pdf::cell(15,8,utf8_decode("Carrera"),1,"","L",true);
    //  $pdf::cell(15,8,utf8_decode("Recomendación"),1,"","L",true);

    //  $pdf::Ln();
    //  $pdf::SetTextColor(0,0,0); // Establece el color del texto 
    //  $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
    //  $pdf::SetFont("Arial","",9);
    //  foreach ($registros as $reg)
    //  {
    //  $pdf::cell(30,6,utf8_decode($reg->id),1,"","L",true);
    //  $pdf::cell(80,6,utf8_decode($reg->fecha_presentacion),1,"","L",true);
    //  $pdf::cell(65,6,utf8_decode($reg->sede),1,"","L",true);
    //  $pdf::cell(15,6,utf8_decode($reg->carrera),1,"","L",true);
    //  $pdf::cell(15,6,utf8_decode($reg->recomendacion_mejora),1,"","L",true);

    //  $pdf::Ln(); 

    //  }

    //  $pdf::Output();
    //  exit;
    //  }
}
