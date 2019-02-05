@extends('layouts.layout')
@section('content')
  <div class="row">
    <section class="content">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="pull-left"><h3>Lista Jugadores</h3></div>
            <div class="pull-right">
              <div class="btn-group">
                <a href="{{ route('jugador.create') }}" class="btn btn-info" >Añadir Jugador</a>
              </div>
            </div>
            <div class="table-container">
              <table id="jugadores" class="table table-bordred table-striped">
              <thead>
                <tr>
                  <th><button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Eliminar seleccionados</button></th>  
                  <th>Nombre</th>
                  <th>Clase</th>
                  <th>Nivel</th>
                  <th>Foto</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
                  <th>Detalles</th>
                </tr>
              </thead>
              <tbody>
                @if($jugadores->count())  
                  @foreach($jugadores as $jugador)  
                    <tr id="tr_{{$jugador->id}}">
                      <td class="text-center"><input type="checkbox" class="checkbox" data-id="{{$jugador->id}}"></td>
                      <td>{{$jugador->nombre}}</td>
                      <td>{{$jugador->clase}}</td>
                      <td>{{$jugador->nivel}}</td>
                      <td><img class="card-img-top img-fluid"
                                  src="{{url($jugador->foto? 'uploads/'.$jugador->foto:'images/noimage.jpg')}}"
                                  alt="{{$jugador->nombre}}" width="30"/></td>
                      <td class="text-center"><a class="btn btn-primary btn-xs" href="{{action('JugadorController@edit', $jugador->id)}}" ><span class="glyphicon glyphicon-pencil"></span></a></td>
                      <td class="text-center">
                        <form action="{{action('JugadorController@destroy', $jugador->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">

                        <button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-primary btn-xs" href="{{action('JugadorController@show', $jugador->id)}}" ><span class="glyphicon glyphicon-eye-open"></span></a>
                      </td>
                    </tr>
                  @endforeach 
                @else
                <tr>
                  <td colspan="8">No hay registro !!</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    $(document).ready(function () {
      $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
          $('#check_all').prop('checked',true);
        }else{
          $('#check_all').prop('checked',false);
        }
      });
      $('.delete-all').on('click', function(e) {
        var idsArr = [];  
        $(".checkbox:checked").each(function() {  
          idsArr.push($(this).attr('data-id'));
        });
        if(idsArr.length <=0){  
          bootbox.alert("Selecciona al menos un registro");
        }  else { 
          bootbox.confirm({ 
            size: "small",
            message: "Are you sure?", 
            callback: function(result){ 
              if(result){
                var strIds = idsArr.join(","); 
                $.ajax({
                  url: "{{ route('jugador.multipleEliminacion') }}",
                  type: 'DELETE',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: 'ids='+strIds,
                  success: function (data) {
                    if (data['status']==true) {
                      $(".checkbox:checked").each(function() {  
                        $(this).parents("tr").remove();
                      });
                      bootbox.alert(data['message']);
                    } else {
                      bootbox.alert('Whoops Something went wrong!!');
                    }
                  },
                  error: function (data) {
                    bootbox.alert(data.responseText);
                  }
                });
              }
            }
          })
        }  
      });
      $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
          element.closest('form').submit();
        }
      });   
    });
  </script>
@endsection