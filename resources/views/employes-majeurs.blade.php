<div>
    <h1>Liste des employés</h1>

    <ul>
        @foreach ($employes as $employe)
            <li>{{$employe}}</li>
        @endforeach
    </ul>
</div>
