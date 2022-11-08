<x-app-layout>
    @include('layouts.navigation2')
    <main>
        <div class="py-12">
            <div class="overflow-hidden sm:rounded-lg max-w mx-auto px-8">
                <div class="flex flex-col ml-6 mr-6 space-y-5">
                    <div class="flex flex-row space-x-5 sm:rounded-lg">
                        <button
                            id="emails"
                            onclick="makeCoupons()"
                            class="bg-blue-500 hover:bg-blue-700 text-sm text-white py-1 px-4 rounded-full"
                            style="min-width: 200px;">
                            Generar cupones
                        </button>
                    </div>
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-gray-500 text-center">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Cupón
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $row)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="py-4 px-6 font-bold text-gray-900 whitespace-nowrap">
                                        {{ $row->coupon }}
                                    </th>
                                    <td class="py-4 px-6">
                                        @if($row->available === 0)
                                        <span class="text-red-600">
                                            No disponible
                                        </span>
                                        @else
                                        <span class="text-green-600">
                                            Disponible
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="py-3">
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>

        <script>
            function makeCoupons() {
                Swal.fire({
                    title: '¿Cuantos cupones desea generar?',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Generar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (value) => {
                        return fetch(`{{ url("cupon/make") }}/${value}`, {
                            headers:{
                                'Content-Type': 'application/json',
                            },
                            method:'GET'
                        })
                        .then(response => {
                            if (!response.ok) {
                            throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            text: `${result.value.message}`,
                        })
                        .then(() => {
                            location.reload()
                        })
                    }
                })
            }
        </script>
    </main>
</x-app-layout>
