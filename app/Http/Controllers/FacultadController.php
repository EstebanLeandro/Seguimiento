<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Facultad;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\FacultadFormRequest;
use DB;

class FacultadController extends Controller
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
            $facultades=DB::table('facultads')
            ->where('descri_facultad','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);
            return view('registro.facultad.index',["facultades"=>$facultades,"searchText"=>$query]);
        }
    }

    public function buscar(Request $request){
        $dato=$request->input("dato_buscado");
        $facultades=Facultad::where("descri_facultad","like","%".$dato."%")->orwhere("id","like","%".$dato."%")
        ->paginate(5);
        return view('registro.facultad.search')->with("facultades",$facultades);
      } 

    public function create()
    {
        return view("registro.facultad.create");
    }
    public function store (Request $request)
    {
        $this->validate($request, [
            'descri_facultad' => 'required|max:255|unique:facultads,descri_facultad',
        
        ]);
        $facultads=new Facultad;
        $facultads->descri_facultad=$request->get('descri_facultad');
        $facultads->save();
        return Redirect::to('registro/facultad')->with('message','Registro creado correctamente!');

    }
    public function show($id)
    {
        return view("registro.facultad.show",["facultad"=>Facultad::findOrFail($id)]);
    }
    public function edit($id)
    {
        $facultads= Facultad::findOrFail($id);
        return view("registro.facultad.edit",["facultads"=>Facultad::findOrFail($id)])
        ->with('message','Registro actualizado correctamente!');
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'descri_facultad' => 'required|max:256|unique:facultads,descri_facultad,'.$id
        
        ]);
        $facultads= Facultad::findOrFail($id);
        $facultads->descri_facultad=$request->get('descri_facultad');
        $facultads->update();
        return Redirect::to('registro/facultad')->with('message','Registro actualizado correctamente!');
    }
    public function destroy($id)
    {
        $facultads=Facultad::findOrFail($id);
        try {
            $facultads->delete();
            return Redirect::to('registro/facultad')->with('message','Registro eliminado correctamente');
            
        } catch (\Exception $e) {
            return Redirect::to('registro/facultad')->with('danger','Registro relacionado imposible de eliminar');
        }
      
    }





}
