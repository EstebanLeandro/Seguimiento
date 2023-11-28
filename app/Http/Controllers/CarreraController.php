<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Carrera;
use App\Models\Facultad;
use App\Models\Sede;
use App\Models\SedeCarrera;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CarreraFormRequest;
use App\Http\Requests\SedeFormRequest;
use App\Http\Requests\SedeCarreraFormRequest;
use App\Http\Requests\FacultadFormRequest;

use DB;

class CarreraController extends Controller
{
    function __construct()
    {
          $this->middleware('permission:ver-registro|crear-registro|editar-registro|borrar-registro', ['only' => ['index']]);
          $this->middleware('permission:crear-registro', ['only' => ['create','store']]);
          $this->middleware('permission:editar-registro', ['only' => ['edit','update']]);
          $this->middleware('permission:borrar-registro', ['only' => ['destroy']]);
     }
    public function index(Request $request)
    {


        if ($request)
        { 
            $query=trim($request->get('searchText'));
           // $sedes = Sede::with('carreras')->all();
            //dd($sedes->carreras()->all());
            //$sede_carreras = SedeCarrera::all();
        //    return view("productoinsumo.index", compact("sedes", "sedecarreras"));
         //   $carreras = Carrera::all();
            $carreras=DB::table('carreras as ca')
            -> join('facultads as fa', 'fa.id', '=', 'ca.facultad_id')
            -> select('ca.id', 'ca.descri_carrera','fa.descri_facultad as facultads',/*'sc.idsede_carrera.descri_sede as nombre'*/)
            ->where('descri_carrera','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
    
            
            return view('registro.carrera.index',["carreras"=>$carreras,"searchText"=>$query]);
        } 
        
    } 

    public function byCarrera($id){
    return Carrera::where('sede_id','=',$id)->get();
     }
    
     public function bySede($id){
        
        $carrera = Carrera::with('sedes')->find($id);
         return $sedes = $carrera->sedes;

       
    }

    public function create()
    {
        $facultad = DB::table('facultads')-> get();
       // $sede = Sede::with('carreras ')->all();
       $sede = Sede::all();
      //  dd($sede);
    	return view('registro.carrera.create', ["facultad" => $facultad, "sede" => $sede ]);
    }
    public function store (Request $request)
    {
        $this->validate($request, [
            'facultad_id' => 'required',
            'skills' => 'required',
            'descri_carrera' => 'required|max:256|unique:carreras,descri_carrera',
        
        ]);
     //   dd($request->all());
        $facultad = Facultad::find($request->facultad_id);
        $carrera = $facultad->carreras()->create(['descri_carrera' => $request->descri_carrera]); // OK

        //Convertiremos el array de sedes a enteros
        $data = array_map('intval', $request->skills); 

        // Se pasa un segundo parametro cuando tu tabla pivote tiene otros atributos aparte de las 
        // llaves foraneas, en este caso no necesita pasar otro parametro mas que los IDs de las Sedes.
        
        $carrera->sedes()->attach($data);

        /******AQUI NO VA ESTO, TIENES QUE CREAR UN METODO PARA 
        SOLO ALMACENAR LAS SEDES EN EL CONTROLADOR 
z        SedeController */

        // $sede=new Sede;
        // $sede->descri_sede=$request->get('descri_sede');
        // $sede->save();
      /*  $data = $request;

        $sede_carrera = DB::table('sede_carrera')
            ->where('idcarrera', $request->input('idcarrera'))
            ->where('idsede', $request->input('idsede'))
            ->count();
*/
   
        return Redirect::to('registro/carrera')->with('message','Registro creado correctamente!');

    }
    public function show($id)
    {
        $facultad = DB::table('facultads') -> get();
        return view("registro.carrera.show",["carrera"=>Carrera::findOrFail($id)]);
    }
    public function edit($id)
    {   
        $facultad = DB::table('facultads')-> get();
        $carrera = Carrera::findOrFail($id);
        $sede = Sede::all();

       $carrera_sede = DB::table('carrera_sede')->get();
   // dd($carrera_sede);

       $carrera_sede = $carrera->sedes->toArray();


             // dd($sede);

        return view("registro.carrera.edit" ,['carrera_sede'=>$carrera_sede,"facultad"=>$facultad,"sede"=>$sede, "carrera"=>$carrera]);
    }
    
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'facultad_id' => 'required',
            'skills' => 'required',
            'descri_carrera' => 'required|max:256|unique:carreras,descri_carrera,'.$id,
        
        ]);
       
      //dd($request->all());
        $carrera= Carrera::findOrFail($id);
        $carrera -> facultad_id = $request -> get('facultad_id');
        $carrera->descri_carrera=$request->get('descri_carrera');
        //Convertiremos el array de sedes a enteros
        $data = array_map('intval', $request->skills); 
        
        $carrera->sedes()->sync($data);
      
        $carrera->update();
        return Redirect::to('registro/carrera')
        ->with('message','Registro actualizado correctamente!');
    }
    public function destroy($id)
    {
        if (DB::table('plan_mejoras')->where('carrera_id', '=', $id)->first() != null) {
            return Redirect::to('registro/carrera')->with('danger','Registro relacionado imposible de eliminar');
        }
       
        else {            
             $carrera=Carrera::findOrFail($id);   
            $carrera->sedes()->detach();
            $carrera->delete(); 
            return Redirect::to('registro/carrera')->with('message','Registro eliminado correctamente!');
        // } catch (\Exception $e) {
        //     return Redirect::to('registro/carrera')->with('danger','Registro relacionado imposible de eliminar');
         }
        
    }
}

