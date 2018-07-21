@extends('layout.meulayout')

@section('minha_secao_produtos')
    @if(isset($palavra))
        Palavra: {{$palavra}}
    @endif
@endsection