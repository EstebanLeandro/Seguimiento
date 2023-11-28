<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Periodo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PeriodoFormRequest;
use DB;

class PeriodoController extends Controller
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
            $periodos=DB::table('periodos')
            ->where('descri_periodo','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate(7);
            return view('registro.periodo.index',["periodos"=>$periodos,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("registro.periodo.create");
    }
    public function store (Request $request)
    {
        $this->validate($request, [
            'descri_periodo' => 'required|max:80|unique:periodos,descri_periodo',
        
        ]);
        $periodos=new Periodo;
        $periodos->descri_periodo=$request->get('descri_periodo');
        $periodos->save();
        return Redirect::to('registro/periodo')->with('message','Registro creado correctamente!');

    }
    public function show($id)
    {
        return view("registro.periodo.show",["periodos"=>Periodo::findOrFail($id)]);
    }
    public function edit($id)
    {
        $periodos= Periodo::findOrFail($id);
        return view("registro.periodo.edit",["periodos"=>Periodo::findOrFail($id)]);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'descri_periodo' => 'required|max:80|unique:periodos,descri_periodo,'.$id,
        
        ]);
        $periodos= Periodo::findOrFail($id);
        $periodos->descri_periodo=$request->get('descri_periodo');
        $periodos->update();
        return Redirect::to('registro/periodo')
        ->with('message','Registro actualizado correctamente');
    }
    public function destroy($id)
    {
        $periodos=Periodo::findOrFail($id);
        try {
            $periodos->delete();
            return Redirect::to('registro/periodo')->with('message','Registro eliminado correctamente');
        }catch(\Exception $e) {
            return Redirect::to('registro/periodo')->with('danger','Registro relacionado imposible de eliminar');
            
        }
       
    }
}
