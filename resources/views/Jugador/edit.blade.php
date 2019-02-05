@extends('layouts.layout')
@section('content')
	<div class="row">
		<section class="content">
			<div class="col-md-8 col-md-offset-2">
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Error!</strong> Revise los campos obligatorios.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				@if(Session::has('success'))
				<div class="alert alert-info">
					{{Session::get('success')}}
				</div>
				@endif
	
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Actualizar Jugador</h3>
					</div>
					<div class="panel-body">					
						<div class="table-container">
							<form method="POST" action="{{ route('jugador.update',$jugador->id) }}"   enctype="multipart/form-data" role="form">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="PATCH">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{$jugador->nombre}}">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<select name="clase" class="form-control">
												<option value="">Selecciona una clase</option>
												<option value="Arquero" {{ $jugador->clase === "Arquero" ? "selected" : "" }}>Arquero</option>
												<option value="Guerrero"  {{ $jugador->clase === "Guerrero" ? "selected" : "" }}>Guerrero</option>
												<option value="Mago"  {{ $jugador->clase === "Mago" ? "selected" : "" }}>Mago</option>
											
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" name="nivel" id="nivel" class="form-control input-sm" value="{{$jugador->nivel}}">
										</div>
									</div>
									
									<div class="col-md-12">
										<div class="form-group">
											<label for="imagen">Imagen de perfil</label>
											<input type="file" name="foto"  class="form-control">    
											@if(($jugador->foto)!="")
												<img src="{{asset('uploads/'.$jugador->foto)}}" width="200">
											@endif
										</div>
									</div>
								</div>
								
								<div class="row">
	
									<div class="col-xs-12 col-sm-12 col-md-12 text-right">
										<input type="submit"  value="Actualizar" class="btn btn-success">
										<a href="{{ route('jugador.index') }}" class="btn btn-info " >Atrás</a>
									</div>		
								</div>
							</form>
						</div>
					</div>
	
				</div>
			</div>
		</section>
	</div>
@endsection