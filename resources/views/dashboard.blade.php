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
                                    Credito
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    ¿Credito en conjunto?
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Asistencia al ultimo evento
                                </th>
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
                                    {{ $row->credit }}
                                </td>
                                <td class="py-4 px-6">
                                    @if ($row->spouse_credit != null)
                                    Si
                                    @else
                                    No
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{ $row->assistance }}
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
</x-app-layout>
