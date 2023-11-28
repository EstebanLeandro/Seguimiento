<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Dimension;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\DimensionFormRequest;
use DB;

class DimensionController extends Controller
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
            $dimensiones=DB::table('dimensions')
            ->where('descri_dimension','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('registro.dimension.index',["dimensiones"=>$dimensiones,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("registro.dimension.create");
    }
    public function store (Request $request)
    {
        $this->validate($request, [
            'descri_dimension' => 'required|max:256|unique:dimensions,descri_dimension',
        
        ]);
        $dimensions=new Dimension;
        $dimensions->descri_dimension=$request->get('descri_dimension');
        $dimensions->save();
        return Redirect::to('registro/dimension')->with('message','Registro creado correctamente!');

    }
    public function show($id)
    {
        return view("registro.dimension.show",["dimensions"=>Dimension::findOrFail($id)]);
    }
    public function edit($id)
    {
        $dimensions= Dimension::findOrFail($id);
        return view("registro.dimension.edit",["dimensions"=>Dimension::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'descri_dimension' => 'required|max:256|unique:dimensions,descri_dimension,'.$id,
        
        ]);
        $dimensions= Dimension::findOrFail($id);
        $dimensions->descri_dimension=$request->get('descri_dimension');
        $dimensions->update();
        return Redirect::to('registro/dimension')
        ->with('message','Registro actualizado correctamente');
    }
    public function destroy($id)
    {
        $dimensions=Dimension::findOrFail($id);
        try {
            $dimensions->delete();
            return Redirect::to('registro/dimension')->with('message','Registro eliminado correctamente');
        }catch(\Exception $e) {
            return Redirect::to('registro/dimension')->with('danger','Registro relacionado imposible de eliminar');
            
        }
       
    }





}

