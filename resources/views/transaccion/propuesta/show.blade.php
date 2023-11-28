@extends ('layouts.admin')
@section ('contenido')    

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
   <div class="form-group">
      <label for="detalle_plan_mejora_id" id="detalle_plan_mejora_id" value="{{old('detalle_plan_mejora_id', $propuesta->detalle_plan_mejora_id)}}">Recomendación Mejora</label>
      <p value="{{$propuesta->detalle_plan_mejora_id}}">{{$propuesta->detalle_plan_mejora->recomendacion_mejora}}</p>
    </div>	
</div>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
   <div class="form-group">
      <label for="descri_actividades">Descripción de Actividad</label>
      <p>{{$propuesta ->descri_actividades}}</p>
    </div>	
</div>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
       <label for="medio_verificacion">Medio de Verificación</label>
       <p>{{$propuesta ->medio_verificacion}}</p>
     </div>	
 </div>

 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
       <label for="plazo">Plazo</label>
       <p>{{$propuesta ->plazo}}</p>
     </div>	
 </div>
{{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
   <div class="form-group">
      <label for="responsable_id" id="responsable_id" value="{{old('responsable_id', $propuesta->responsable_id)}}">Responsable</label>
       <p value="{{$propuesta->responsable_id}}">{{$propuesta->responsables->descri_responsable}}</p>
    </div>	
</div>  --}}

 
 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
       <label for="fuente_financiamiento">Fuente de Financiamiento</label>
       <p>{{$propuesta ->fuente_financiamiento}}</p>
     </div>	
 </div>

 <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <div class="form-group">
       <label for="inversion_prevista">Inversión Prevista</label>
       <p>{{$propuesta ->inversion_prevista}}</p>
     </div>	
 </div>
	       
 <div class="modal-footer">
   <a href="javascript:history.back()"> Volver Atrás</a>
   <a href="\transaccion\mejora" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
</div>
      

    @endsection