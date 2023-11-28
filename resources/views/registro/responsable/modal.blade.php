<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$re->id}}">
	{{-- {{Form::Open(array('action'=>array('ResponsableController@destroy',$re->id),'method'=>'delete'))}} --}}
	<form action="{{ route('responsable.delete', $re->id) }}", method=>'delete'>
		@csrf
		{{ method_field('DELETE') }}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Responsable</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea eliminar Responsable</p>
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