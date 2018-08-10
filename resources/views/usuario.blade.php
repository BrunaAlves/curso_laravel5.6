@auth 
        <h4>Você esta logado</h4>
        <p>{{ Auth::user()->name}}</p>
        <p>{{ Auth::user()->email}}</p>
        <p>{{ Auth::user()->id}}</p>
           
@endauth

@guest 
    <h4>Você NÃO está logado!</h4>
@endguest