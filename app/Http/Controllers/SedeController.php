<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Sede;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\SedeFormRequest;
use DB;

class SedeController extends Controller
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
        return view("registro.sede.create");
    }
    public function store (Request $request)
    {
        $this->validate($request, [
            'descri_sede' => 'required|max:255|unique:sedes,descri_sede',
        ]);
        $sedes=new Sede;
        $sedes->descri_sede=$request->get('descri_sede');
        $sedes->save();
        return Redirect::to('registro/sede')->with('message','Registro creado correctamente!');

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
