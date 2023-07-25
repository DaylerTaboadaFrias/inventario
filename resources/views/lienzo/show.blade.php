@extends('layout.panel')


@section('content')
<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Detalle del diagrama
    </h6>
</div>
<!-- /basic tables title -->


<div class="card">
    <div class="col-md-4">
        <div class="card-body border-top-0">
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Nombre:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$lienzo->nombre}}</div>
            </div>
            
        </div>
    </div>
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th> Nombre </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lienzo->participantes as $item)
                    <tr >
                        <td> {{$item->usuario->name}}</td>
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
$('#navPuzzle').addClass('nav-item-open');
</script>
@endpush