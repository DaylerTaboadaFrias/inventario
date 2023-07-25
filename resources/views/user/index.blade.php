@extends('layout.panel')

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Listado de administradores  <a href="{{url('user/create')}}" class="btn btn-success rounded-round">Nuevo</a> 
    </h6>
</div>
<!-- /basic tables title -->


<!-- Basic table -->
<div class="card">

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Nombre </th>
                    <th> Perfil </th>
                    <th> Email </th>
                    <th> Tipo usuario </th>
                    <th> Opciones </th>
                </tr>
            </thead>
            <tbody>
            	@foreach($users as $item)
                <tr >
                    <td>  {{$item->id}} </td>
                    <td> {{$item->name}}</td>
                    <td> 
                    	<img src="{{asset($item->perfil)}}" alt="perfil" style="width: 70px; height: 70px;object-fit: contain;">
                    </td>
                    <td> {{$item->email}} </td>
                    <td> 
                    	@if($item->tipoUsuario==1)
                    		Administrador
                    	@else
                    		Participante
                    	@endif
                    </td>
                    <td>      
                		<a href="{{url('user/'.$item->id)}}" class="btn btn-secondary rounded-round">Ver detalle</a> 
                		<a href="{{url('user/'.$item->id.'/edit')}}" class="btn btn-primary rounded-round">Editar</a> 
                		@if($item->estado==0)
                            <button type="button" data-target="#user{{$item->id}}" data-toggle="modal" class="btn btn-danger rounded-round">Inhabilitar</button>
                        @else
                             <button type="button" data-target="#user{{$item->id}}" data-toggle="modal" class="btn btn-success rounded-round">Habilitar</button>
                        @endif 
                        @include('user.modal-estado')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /basic table -->

@endsection
@push('scripts')     
<script>

$('#navUser').addClass('nav-item-open');

$(document).ready(function(){

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


    inhabilitar = function (id){
      var idAdministrador = id;
      $.ajax({
        type: "POST",
        url: "{{url('user/estado')}}",
        data: {id: idAdministrador,estado:1},
        success: function( response ) {
          if (response.codigo==0) {
            setTimeout(function(){window.location = "/user"} , 100);   
          }else{

	          alert(response.mensaje);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
         
        }

      });
    }

    habilitar = function (id){
      var idAdministrador = id;
      $.ajax({
        type: "POST",
        url: "{{url('user/estado')}}",
        data: {id: idAdministrador,estado:0},
        success: function( response ) {
          if (response.codigo==0) {
            setTimeout(function(){window.location = "/user"} , 100);   
          }else{

              alert(response.mensaje);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
         
        }

      });
    }


});




</script>
@endpush