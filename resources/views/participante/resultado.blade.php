@extends('layout.panel')


@section('content')
<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Resultado del juego
    </h6>
</div>
<!-- /basic tables title -->


<div class="card">
    <div class="col-md-4">
        <div class="card-body border-top-0">
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Nombre:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$juego->name}}</div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Filas:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$juego->fila}}</div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Columnas:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$juego->columna}}</div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Tipo:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">
                    @if($juego->tipo==1)
                        Simple
                    @else
                        Multijugador
                    @endif
                </div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Estado:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">
                    @if($juego->estado==0)
                        Creado
                    @endif
                    @if($juego->estado==1)
                        Guardado
                    @endif
                    @if($juego->estado==2)
                        Finalizado
                    @endif
                </div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Imagen:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0"><img src="{{asset($juego->imagen)}}" alt="Imagen" style="width: 150px;object-fit: contain;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> Nombre </th>
                        <th> Total piezas movidas </th>
                        <th> Correctos </th>
                        <th> Incorrectos </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($juego->jugadores as $item)
                    <tr >
                        <td> {{$item->usuario->name}}</td>
                        <td> {{$item->piezasMovidas}}</td>
                        <td> {{$item->bien}}</td>
                        <td> {{$item->mal}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    </div>


</div>


@endsection  
@push('scripts')
<script>
$('#navJuego').addClass('nav-item-open');
</script>
@endpush