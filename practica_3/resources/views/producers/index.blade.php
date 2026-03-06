@extends('layouts.app')

@section('content')
    <h1>Nuestros Productores Sostenibles</h1>
    <ul>
        @foreach($producers as $producer)
            <li>
                <strong>{{ $producer->user->name }}</strong> 
                - Certificado: {{ $producer->cert_ods }}
            </li>
        @endforeach
    </ul>
@endsection