<div>
    <h1>Liste des employés</h1>

    <ul>
        @foreach ($employes as $employe)
            <li>{{strtoupper($employe->nom)}} Age : {{$employe->age}}</li>
        @endforeach
    </ul>
</div>
