@extends('layout.panel')

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Listado de diagramas  <a href="{{url('lienzo/create')}}" class="btn btn-success rounded-round">Nuevo</a> 
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
	                <th> Opciones </th>
                </tr>
            </thead>
            <tbody>
            	@foreach($lienzos as $item)
                <tr >
                    <td> {{$item->id}} </td>
                    <td> {{$item->nombre}}</td>
                    <td >       
                		<a href="{{url('lienzo/'.$item->id)}}" class="btn btn-secondary rounded-round">Ver detalle</a> 
                		<a href="{{url('lienzo/'.$item->id.'/edit')}}" class="btn btn-primary rounded-round">Editar</a> 
                		<button type="button" data-target="#lienzo{{$item->id}}" data-toggle="modal" class="btn btn-danger rounded-round">Eliminar</button> 
                        @include('lienzo.modal-delete')
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

$('#navPuzzle').addClass('nav-item-open');

$(document).ready(function(){

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


    eliminar = function (id){
      var idAdministrador = id;
      $.ajax({
        type: "POST",
        url: "{{url('lienzo/delete')}}",
        data: {id: idAdministrador},
        success: function( response ) {
          if (response.codigo==0) {
            setTimeout(function(){window.location = "/lienzo"} , 100);   
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