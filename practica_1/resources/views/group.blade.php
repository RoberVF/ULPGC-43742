@extends('user', ['nombre' => 'Nuestro Equipo'])

@section('content')
    <div class="team-grid">
        <div class="member-card">
            <h3>Roberto</h3>
            <p>Desarrollador Backend</p>
            <a href="{{ url('/paginaPersonal/Roberto') }}">Ver Perfil Privado</a>
        </div>
        <div class="member-card">
            <h3>Miguel</h3>
            <p>Desarrollador Frontend</p>
            <a href="{{ url('/paginaPersonal/Miguel') }}">Ver Perfil Privado</a>
        </div>
        <div class="member-card">
            <h3>Angel</h3>
            <p>Desarrollador FullStack</p>
            <a href="{{ url('/paginaPersonal/Angel') }}">Ver Perfil Privado</a>
        </div>
    </div>
@endsection