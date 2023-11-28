<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Sede;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\SedeFormRequest;
use DB;

class ArchivoController extends Controller
{
    function __construct()
    {
        //   $this->middleware('permission:ver-registro|crear-registro|editar-registro|borrar-registro', ['only' => ['index']]);
        //   $this->middleware('permission:crear-registro', ['only' => ['create','store']]);
        //   $this->middleware('permission:editar-registro', ['only' => ['edit','update']]);
        //   $this->middleware('permission:borrar-registro', ['only' => ['destroy']]);
     }
    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $sedes=DB::table('sedes')
            ->where('descri_sede','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('registro.sede.index',["sedes"=>$sedes,"searchText"=>$query]);
        }
    }
    public function byCarrera($id){
        return Sede::where('carrera','=',$id)->get();
    }
    
    public function create()
    {
        return view("transaccion.realizada.medio_verificacion");
    }
    public function store (Request $request)
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
         $request->file('url')->storeAs('public/documentos',$nombre_a_guardar);

        $medio = new MedioVerificacion();    
        $medio->descri_verificacion= $request->descri_verificacion;
        $medio->url = $nombre_a_guardar;            
      
        $medio->save();    
        return back()->with('message','Registro actualizado correctamente!');

    }
    public function show($id)
    {
        return view("registro.sede.show",["sedes"=>Sede::findOrFail($id)]);
    }
    public function edit($id)
    {
        $sedes= Sede::findOrFail($id);
        return view("registro.sede.edit",["sedes"=>Sede::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
           'descri_sede' => 'required|max:255|unique:sedes,descri_sede,'.$id,
        ]);
        $sedes= Sede::findOrFail($id);
        $sedes->descri_sede=$request->get('descri_sede');
        $sedes->update();
        return Redirect::to('registro/sede')->with('message','Registro actualizado correctamente!');
    }
    public function destroy($id)
    {
        $sedes=sede::findOrFail($id);
        try {
           $sedes->delete();
           return Redirect::to('registro/sede')->with('message','Registro elimidado correctamente!');
        } catch (\Exception $e) {
           return Redirect::to('registro/sede')->with('message','Registro relacionado imposible de eliminar!');
        }
        
    }

    public function bySede($id){
        return Sede::get();
        }



}