<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Responsable;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ResponsableFormRequest;

use DB;

class ResponsableController extends Controller
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
            $responsables=DB::table('responsables as re')
            ->select('re.*')
            ->where('descri_responsable','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('registro.responsable.index',["responsables"=>$responsables,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("registro.responsable.create");
    }
    public function store (Request $request)
    {
        $this->validate($request, [
            'descri_responsable' => 'required|max:80|unique:responsables,descri_responsable',
        
        ]);

        $responsables=new Responsable;
        $responsables->descri_responsable=$request->get('descri_responsable');
        $responsables->save();
        return Redirect::to('registro/responsable')->with('message','Registro creado correctamente!');

    }
    public function show($id)
    {
        return view("registro.responsable.show",["responsable"=>Responsable::findOrFail($id)]);
    }
    public function edit($id)
    {
        $responsable= Responsable::findOrFail($id);
        return view("registro.responsable.edit",["responsable"=>Responsable::findOrFail($id)]);
    }


    
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'descri_responsable' => 'required|max:80|unique:responsables,descri_responsable,'.$id,
        
        ]);
        $responsable= Responsable::findOrFail($id);
        $responsable->descri_responsable=$request->get('descri_responsable');
        $responsable->update();
        return Redirect::to('registro/responsable')
        ->with('message','Registro actualizado correctamente');
    }
    public function destroy($id)
    {
        $responsable=responsable::findOrFail($id);
        try {
            $responsable->delete();
            return Redirect::to('registro/responsable')->with('message','Registro eliminado correctamente');
        }catch(\Exception $e) {
            return Redirect::to('registro/responsable')->with('danger','Registro relacionado imposible de eliminar');
            
        }
    }
}