<form action="{{ route('propuesta.buscar')}}" method ="GET">
        <div class="form-group">
	        <div class="input-group">
             <input type="text" class="form-control" name="busqueda" placeholder="Buscar..." value="{{$busqueda}}">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">Buscar</button>
              </span>
          </div>
        </div>
</form>