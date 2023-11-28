@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h4><label >Editar Actividad de mejora:</label>{{$plan_mejora->fecha_presentacion}}</h4>
  

    </div>
</div>
<div class="panel panel-primary"></div>


<form action="{{ route('mejora.update', $plan_mejora->id) }}" method ="POST">
	@csrf
	{{ method_field('PUT') }}

	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="fom-group">
						{{-- @php
							@dd($sc->id);
							@endphp  --}}
						<label for="sede_id">Sede/Filial:</label>	
						<select name="sede_id" id="sede_id"  value="$plan_mejora->sede_id}}" class="form-control selectpicker" data-live-search="true">
							<option value="{{$plan_mejora->sede_id}}">{{$plan_mejora->sede}}</option>
							@foreach($sede as $sc)
							  <option value="{{$sc->sede_id}}">{{ $sc->sede}} </option>
							@endforeach  
						</select>
						<div id="sede_id-error" class="error text-danger pl-3" for="sede_id" style="display: block;">
						<strong>{{ $errors->first('sede_id') }}</strong>
					    </div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="fom-group"> 
					 <label for="carrera_id">Carrera:</label>
					 <select name="carrera_id" id="carrera_id" value="$plan_mejora->carrera_id}}" typr="hidden" class="form-control">
						<option value="{{$plan_mejora->carrera_id}}">{{$plan_mejora->carrera}}</option>
					</select> 
					<div id="carrera_id-error" class="error text-danger pl-3" for="carrera_id" style="display: block;">
						<strong>{{ $errors->first('carrera_id') }}</strong>
					    </div>
					</div>
				 </div>
			
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <div class="form-group">
            	  <label for="fecha_presentacion">Fecha de Presentación:</label>
            	  <input type="text" name="fecha_presentacion" id="fecha_presentacion" value="{{ \Carbon\Carbon::parse($plan_mejora->fecha_presentacion)->format('Y/m/d') }}" class="form-control">
				  <div id="fecha_presentacion-error" class="error text-danger pl-3" for="fecha_presentacion" style="display: block;">
					<strong>{{ $errors->first('fecha_presentacion') }}</strong>
				   </div>
				</div>
		    </div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">            
				  <label for="periodo">Periodo:</label>
				  <select name="periodo_id" value="{{$plan_mejora->periodo_id}}" class="form-control selectpicker" id="periodo_id" data-live-search="true">
					<option value="{{$plan_mejora->periodo_id}}">{{$plan_mejora->periodo}}</option>
					@foreach($periodo as $per)
					  <option value="{{$per -> id}}">{{$per->descri_periodo}}</option>
					  @endforeach
				  </select>
				  <div id="periodo_id-error" class="error text-danger pl-3" for="periodo_id" style="display: block;">
					<strong>{{ $errors->first('periodo_id') }}</strong>
				   </div>
				</div>
			</div>

			    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

					<div class="form-group">
						 <button class="btn btn-primary" type="submit" data-dismiss="success" role="alert">Actualizar</button>
						<button class="btn btn-danger" type="reset">Cancelar</button>
				   </div>
				</div>
		</div>
	</div>			
	<div class="modal-footer">
		<a href="javascript:history.back()"> Volver Atrás</a>
		<a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
	</div>
</form>
			{{-- {!!Form::close()!!}		 --}}
            @push('js')
            <script type="text/javascript">
               $(document).ready(function(){
                   $('#sede_id').on('change', onSelectCarrera);
   
   
   
               });
               function onSelectCarrera(){
                   var sed_id = $(this).val(); 
                   if(! sed_id){
                       $('#carrera_id').html('<option value="">Seleccione la carrera</option>')
                       return;
                   }
                   $.get('/sede/'+sed_id+'/carrera', function (data){
                       var html_select = '';
                        var html_select = '<option value="">Selecciona una carrera</option>';
                        
                        for (var i=0; i<data.length; ++i)
                           html_select += '<option value="'+data[i].id+'">'+data[i].descri_carrera+'</option>';
                       
                        $('#carrera_id').html(html_select);
   
                          //console.log(html_select);			
   
                           
                        });
                       
               }
               
            </script>  
   
       <script type="text/javascript">
   
       $("body").on("keydown", "input, select, textarea", function(e) {
           var self = $(this),
             form = self.parents("form:eq(0)"),
             focusable,
             next;
           
           // si presiono el enter
           if (e.keyCode == 13) {
             // busco el siguiente elemento
             focusable = form.find("input,a,select,button,textarea").filter(":visible");
             next = focusable.eq(focusable.index(this) + 1);
             
             // si existe siguiente elemento, hago foco
             if (next.length) {
               next.focus();
             } else {
               // si no existe otro elemento, hago submit
               // esto lo podrías quitar pero creo que puede
               // ser bastante útil
               form.submit();
             }
             return false;
           }
         });
   
         </script>
       @endpush
	@endsection