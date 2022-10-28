<table>
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Compañia</th>
        <th>Posición</th>
        <th>Modo</th>
        <th>Status</th>
        <th>Asistencia</th>
    </tr>
    </thead>
    <tbody>
    @foreach($persons as $person)
        <tr>
            <td>{{ $person->name . ' ' . $person->first_surname . ' ' . $person->second_surname }}</td>
            <td>{{ $person->email }}</td>
            <td>{{ $person->telephone }}</td>
            <td>{{ $person->company }}</td>
            <td>{{ $person->position }}</td>
            <td>
                @if ($person->mode == App\Models\Canadevi::VIRTUAL)
                Virtual
                @else
                Presencial
                @endif
            </td>
            <td>
                @if ($person->payment_mode == App\Models\Canadevi::MODE_CARD)
                Pago
                @elseif ($person->payment_mode == App\Models\Canadevi::MODE_INV)
                Invitado
                @else
                No encontrado
                @endif
            </td>
            <td>
                @if ($person->assistance == 1 && $person->mode == App\Models\Canadevi::PRESENT)
                Asistió
                @elseif ($person->assistance == 0 && $person->mode == App\Models\Canadevi::VIRTUAL)
                N/A
                @else
                No asistió
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
