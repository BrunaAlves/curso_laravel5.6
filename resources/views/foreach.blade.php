<h1>Loop Foreach - Array Associativo</h1>

@foreach($produtos as $p)
    <p>{{ $p['id'] }}: {{ $p['nome'] }} </p>
@endforeach