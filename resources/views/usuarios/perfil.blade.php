@extends('layout.panel')

@section('title', 'Mi Perfil')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid py-3">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 {{auth()->user()->is_dia? 'bg-light' : 'bg-dark'}}">
                <h6 class="m-0 font-weight-bold text-primary">Mi Perfil</h6>
                <ul class="nav nav-pills">
                    <li class="nav-item px-2">
                        <a class="btn btn-primary" href="#" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Cerrar sesión </a>
                    </li>
                    <li class="nav-item px-2">
                        <form  method="POST" action="{{route('perfil.diaNoche', [auth()->user(), 'modo'])}}">
                            @csrf
                            @method('PATCH')
                        <button class="btn {{auth()->user()->is_dia? 'btn-light' : 'btn-dark'}}">
                            Modo {{auth()->user()->is_dia? 'Noche':'Dia'}}</button>
                        </form>
                    </li>
                    <li class="nav-item px-2">
                        <form method="POST" action="{{route('perfil.diaNoche', [auth()->user(), 'Infantil'])}}">
                            @csrf @method('PATCH')
                            <button class="btn btn-warning">
                                Tema Infantil </button>
                        </form>
                    </li>
                    <li class="nav-item px-2">
                        <form method="POST" action="{{route('perfil.diaNoche', [auth()->user(), 'Juvenil'])}}">
                            @csrf @method('PATCH')
                            <button class="btn btn-danger">
                                Tema Juvenil </button>
                        </form>
                    </li>
                    <li class="nav-item px-2">
                        <form method="POST" action="{{route('perfil.diaNoche', [auth()->user(), 'Adultos'])}}">
                            @csrf @method('PATCH')
                            <button class="btn btn-secondary">
                                Tema Adultos </button>
                        </form>
                    </li>
                </ul>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Activo</th>
                            <th>Grupo</th>
                            <th>Modo dia</th>
                            <th>Tema</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Activo</th>
                            <th>Grupo</th>
                            <th>Modo dia</th>
                            <th>Tema</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr>
                            <td>{{auth()->user()->id}}</td>
                            <td>{{auth()->user()->nombres}}</td>
                            <td>{{auth()->user()->apellidos}}</td>
                            <td>{{auth()->user()->email}}</td>
                            <td>{{auth()->user()->is_active ? 'Si': 'No'}}</td>
                            <td>{{$grupo->nombre}}</td>
                            <td>{{auth()->user()->is_dia ? 'Si' : 'No'}}</td>
                            <td>
                                {{auth()->user()->tema}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
