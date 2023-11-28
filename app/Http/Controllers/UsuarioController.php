<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos lo siguiente
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    function __construct()
    {
          $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
          $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
          $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
          $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        //Sin paginación
        /* $usuarios = User::all();
        return view('usuarios.index',compact('usuarios')); */
        //Con paginación
        $busqueda=$request->busqueda;

        $usuarios = User::where('name','LIKE','%'.$busqueda.'%')
        ->orderBy('id','desc')
        ->paginate(5);
      //  return view('usuarios.index',compact('usuarios'));
       // return view('usuarios.index',["usuarios"=>$usuarios,"busqueda"=>$busqueda]);
        return view('usuarios.index',compact('usuarios','busqueda'));


        //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $usuarios->links() !!}
    }
    public function search(Request $request)
    {
          $search = $request->get('term');
      
          $result = User::where('name', 'LIKE', '%'. $search. '%')->get();
 
          return response()->json($result);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //aqui trabajamos con name de las tablas de users
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return Redirect::to('usuarios')->with('message','Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('usuarios.editar',compact('user','roles','userRole'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return Redirect::to('usuarios')->with('message','Registro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with('message','Registro elimidado correctamente!');

    } catch (\Exception $e) {
        return redirect()->route('usuarios.index')->with('message','Registro relacionado imposible de eliminar!');
     }                     
    }
    
}
