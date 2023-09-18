<div>
    <h1>Liste des employés</h1>

    <ul>
        @foreach ($employes as $employe)
            <li>{{$employe->nom}}</li>
        @endforeach
    </ul>
</div>
