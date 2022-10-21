<x-app-layout>

    <div class="py-12">
        <div class="overflow-hidden sm:rounded-lg max-w mx-auto px-8">
            <div class="ml-6 mr-6">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-500 text-center">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Nombre
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Correo
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Teléfono
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Modalidad
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Invitado
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pago físico
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pago con tarjeta
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registration as $row)
                            <tr class="bg-white border-b">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->name }} {{ $row->first_surname }} {{ $row->second_surname }}
                                </th>
                                <td class="py-4 px-6">
                                   {{ $row->email }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $row->telephone }}
                                </td>
                                <td class="py-4 px-6">
                                    @if ($row->mode === App\Models\Canadevi::PRESENT)
                                    Presencial
                                    @else
                                    Virtual
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center">
                                        <input id="option_{{ App\Models\Canadevi::MODE_INV . '_' . $row->id }}" type="checkbox" value="{{ App\Models\Canadevi::MODE_INV }}"
                                            @if ($row->payment_mode === App\Models\Canadevi::MODE_INV) checked @endif
                                            @if ($row->payment_status === 1)
                                            disabled
                                            class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @else
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @endif
                                            onclick="validate({{ App\Models\Canadevi::MODE_INV }}, {{ $row->id }})">
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center">
                                        <input id="option_{{ App\Models\Canadevi::MODE_FIS . '_' . $row->id }}" type="checkbox" value="1"
                                            @if ($row->payment_mode === App\Models\Canadevi::MODE_FIS) checked @endif
                                            @if ($row->payment_status === 1)
                                            disabled
                                            class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @else
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @endif
                                            onclick="validate({{ App\Models\Canadevi::MODE_FIS }}, {{ $row->id }})">
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center">
                                        <input id="option_{{ App\Models\Canadevi::MODE_CARD . '_' . $row->id }}" type="checkbox" value="1"
                                            @if ($row->payment_mode === App\Models\Canadevi::MODE_CARD) checked @endif
                                            @if ($row->payment_status === 1)
                                            disabled
                                            class="w-4 h-4 text-blue-600 bg-gray-400 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @else
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2"
                                            @endif
                                            onclick="validate({{ App\Models\Canadevi::MODE_CARD }}, {{ $row->id }})">
                                    </div>
                                </td>
                                <td class="py-4 px-6" id="row_user_{{ $row->id }}">
                                    @if ($row->payment_status !== 1)
                                    <button
                                        onclick="setPayment({{ $row->id }})"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-light py-1 px-2 text-xs rounded-full">
                                        Actualizar
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="py-3">
                {{ $registration->links() }}
            </div>
        </div>
    </div>

    <script>
        function setPayment(id) {
            let selection = null;

            if (document.getElementById(`option_{{ App\Models\Canadevi::MODE_CARD }}_${id}`).checked)
                selection = {{ App\Models\Canadevi::MODE_CARD }}
            else if (document.getElementById(`option_{{ App\Models\Canadevi::MODE_FIS }}_${id}`).checked)
                selection = {{ App\Models\Canadevi::MODE_FIS }}
            else if (document.getElementById(`option_{{ App\Models\Canadevi::MODE_INV }}_${id}`).checked)
                selection = {{ App\Models\Canadevi::MODE_INV }}

            fetch('{{ url("api/admin/forum") }}', {
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method:'POST',
                body: JSON.stringify({ mode: selection, user: id })
            })
            .then(response => response.json())
            .then(function(result){
                let card = document.getElementById(`option_{{ App\Models\Canadevi::MODE_CARD }}_${id}`)
                card.disabled = true
                card.classList.remove('bg-gray-100')
                card.classList.add('bg-gray-400')

                let fis = document.getElementById(`option_{{ App\Models\Canadevi::MODE_FIS }}_${id}`)
                fis.disabled = true
                fis.classList.remove('bg-gray-100')
                fis.classList.add('bg-gray-400')

                let inv = document.getElementById(`option_{{ App\Models\Canadevi::MODE_INV }}_${id}`)
                inv.disabled = true
                inv.classList.remove('bg-gray-100')
                inv.classList.add('bg-gray-400')

                document.getElementById(`row_user_${id}`).innerHTML = ''

                Swal.fire({
                    icon: 'success',
                    title: '¡Hecho!',
                    text: result.message,
                })
            });
        }

        function validate(type, id) {
            switch (type) {
                case {{ App\Models\Canadevi::MODE_CARD }}:
                    if (document.getElementById(`option_${type}_${id}`).checked) {
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_FIS }}}_${id}`).checked = false
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_INV }}}_${id}`).checked = false
                    }
                    break;
                case {{ App\Models\Canadevi::MODE_FIS }}:
                    if (document.getElementById(`option_${type}_${id}`).checked) {
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_CARD }}}_${id}`).checked = false
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_INV }}}_${id}`).checked = false
                    }
                    break;
                case {{ App\Models\Canadevi::MODE_INV }}:
                    if (document.getElementById(`option_${type}_${id}`).checked) {
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_FIS }}}_${id}`).checked = false
                        document.getElementById(`option_{{{ App\Models\Canadevi::MODE_CARD }}}_${id}`).checked = false
                    }
                    break;
            }
        }
    </script>
</x-app-layout>
