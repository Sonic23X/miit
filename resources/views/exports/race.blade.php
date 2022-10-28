<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Tamaño camiseta</th>
        <th>Modalidad</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($persons as $person)
        <tr>
            <td>{{ $person->name . ' ' . $person->first_surname . ' ' . $person->second_surname }}</td>
            <td>{{ $person->email }}</td>
            <td>{{ $person->telephone }}</td>
            <td>{{ $person->size }}</td>
            <td>
                @if ($person->event == App\Models\Race::WALK)
                Caminata 3 KM
                @else
                Carrera 7 KM
                @endif
            </td>
            <td>
                @if ($person->payment_mode == App\Models\Race::MODE_CARD || $person->payment_mode == App\Models\Race::MODE_FIS)
                Pago
                @else
                Sin pagar
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
