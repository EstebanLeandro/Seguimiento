@extends ('layouts.admin')
@section ('contenido')  

    <div class="row">
    </div>

        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label  for="fecha_presentacion">Fecha de Presentación:</label>
               <p>{{$plan_mejora -> fecha_presentacion}}</p>         
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="periodo">Periodo:</label>
               <p>{{$plan_mejora -> periodo}}</p>         
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="sede">Sede:</label>
                <p>{{$plan_mejora -> sede}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="carrera">Carrera:</label>
                <p>{{$plan_mejora -> carrera}}</p>            
            </div>
        </div>
</div>
    <div class="row">
       
       <div class="form-group">
           <div class="panel-body">               
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">                            
                            <th>Dimensión</th>
                            <th>Recomendación Mejora</th>
                        </thead>
                           
                            @foreach($detalles as  $det)
                                <tr>
                                    <td>{{$det ->descri_dimension}}</td>
                                    <td>{{$det ->recomendacion_mejora}}</td>
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
       </div>
       
    </div> 
    <div class="modal-footer">
        <a href="javascript:history.back()"> Volver Atrás</a>
        <a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
    </div>              

    @endsection