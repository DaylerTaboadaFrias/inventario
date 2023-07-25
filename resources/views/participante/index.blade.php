@extends('layout.panel')

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Listado de diagramas  
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
            	@foreach($participante->participaciones as $item)
                <tr >
                    <td>  {{$item->lienzo->id}} </td>
                    <td> {{$item->lienzo->nombre}}</td>
                    <td>    
                		<a href="{{url('participante/'.$item->lienzo->id)}}" class="btn btn-success rounded-round">Ver</a>
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
$(document).ready(function(){


	$('#navJuego').addClass('nav-item-open');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


	
});




</script>
@endpush