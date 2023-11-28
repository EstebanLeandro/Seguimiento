<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true close-btn">×</span>
				</button>
			</div>
		   <div class="modal-body">
				<form>

{{-- <form method="POST" id="addModal"> --}}
	@csrf                
	<div class="modal-body">
		<div class="form-group">
			<div class="col-xm-6">
				<label for="descri_verificacion">Medio de verificación:</label>
				<textarea  style=" width: 100%; resize: none;" type="text" name="descri_verificacion" id="descri_verificacion" class="form-control" placeholder="Medio de verificación...">{{old('descri_verificacion')}}</textarea>
				<div id="descri_verificacion-error" class="error text-danger pl-3" for="descri_verificacion" style="display: block;">
				   <strong>{{ $errors->first('descri_verificacion') }}</strong>
				</div>               
			 </div>
		  </div> 

		  <div class="form-group">
			<div class="col-xm-6">
				<label class=" control-label">Nuevo Archivo</label>
				<div >
				  <input type="file" class="form-control" name="url" id="url">

				  <div id="url-error" class="error text-danger pl-3" for="url" style="display: block;">
					<strong>{{ $errors->first('url') }}</strong>
				 </div> 
				</div>
		  </div>
		</div> 

			  

</form>									
<div class="modal-footer">
		{{-- <button type="submit" class="btn btn-success">Guardar</button> --}}
		<button type="button" wire:click.prevent="storeArchivo()" class="btn btn-primary close-modal">Save changes</button>

		<button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Cerrar</button>
	</div> 
</div>  

</div>
</div>
</div>