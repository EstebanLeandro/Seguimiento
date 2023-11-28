@extends ('layouts.admin')
@section ('contenido')     
    
         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="descri_realizadas">Descripción realizada:</label> 
               <p>{{$realizada->descri_realizadas}}</p>                   
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="medio_verificacion">Medio verificación:</label>
                <p>{{$realizada->medio_verificacion}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="plazo">Palzo</label>
                <p>{{$realizada->plazo}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="responsable">Responsable:</label>
                <p>{{$realizada->responsable}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="cumplimiento">Cumplimiento:</label>
                <p>{{$realizada->cumplimiento}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="resultados">Resultado:</label>
                <p>{{$realizada->resultados}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="avance">Avance:</label>
                <p>{{$realizada->avance}}</p>            
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">            
               <label for="pendiente">Pendiente:</label>
                <p>{{$realizada->pendiente}}</p>            
            </div>
        </div>

  
        <div class="modal-footer">
			<a href="javascript:history.back()"> Volver Atrás</a>
			<a href="\transaccion\realizada" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
		</div>          

    @endsection