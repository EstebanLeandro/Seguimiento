<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$dim->id}}">
	{{-- {{Form::Open(array('action'=>array('DimensionController@destroy',$dim->id),'method'=>'delete'))}} --}}
	<form action="{{ route('dimension.delete', $dim->id) }}", method=>'delete'>
		@csrf
		{{ method_field('DELETE') }}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar dimensión</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar la dimensión</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
</form>
	{{-- {{Form::Close()}} --}}

</div>