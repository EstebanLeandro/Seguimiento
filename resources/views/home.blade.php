<!DOCTYPE html>                    <html>                       
     <head>                        
        <title>Dashboard</title>                        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">                       
    </head>                        
    <body>                       
    <style>
    .blue-color {
        color:blue;
    }
     
    .green-color {
        color:green;
    }
     
    .teal-color {
        color:teal;
    }
     
    .yellow-color {
    color:yellow;
    }
    
    .red-color {
        color:red;
    }
   </style>                      
        </body>                    
        </html>                    
@extends('layouts.admin')

@section('contenido')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading" style="font-weight: bold">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                    <div class="col-md-4 col-xl-4">
                                    
                                    <div class="card bg-c-blue order-card" >
                                            <div class="card-block" style="background-color:#6777ef">
                                            <h2 style="color:#fff;">Usuarios</h2>                                               
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/usuarios" class="text-white" style="color:#fff;">Ver más</a></p>
                                            </div>                                            
                                        </div>                                    
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card"  style="background-color:#E53935;">
                                            <div class="card-block">
                                            <h2 style="color:#fff;">Roles</h2>                                               
                                                @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-user-lock"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/roles" class="text-white" style="color:#fff;">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-xl-4">
                                        <div class="card bg-c-green order-card"  style="background-color:#35e570;">
                                            <div class="card-block">
                                            <h2 style="color:#fff;">Mejoras propuesta</h2>                                               
                                                @php
                                                use App\Models\Propuesta;
                                                 $cant_mejoras = Propuesta::count();                                                
                                                @endphp
                                                <h2 class="text-right"><i class="fas fa-list-alt"></i><span>{{$cant_mejoras}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="/transaccion/mejora" class="text-white" style="color:#fff;">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>    
                                    
                               
                                </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection