<x-form-layout>
    <div class="flex flex-col mb-10 items-center">
        <img class="w-40 h-40" src="{{ asset('images/logo_dom.png') }}" alt="logo_expo_inmobiliaria">
        <p class="text-center">
            <span>
                Bienvenido al Open House de DOM Smart Living
            </span>
        </p>
    </div>
    <form action="{{ route('form_store_dom') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre(s)</label>
            <input type="text" id="name" name="name" required value="{{ old('name') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('name')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="first_surname" class="block mb-2 text-sm font-medium text-gray-900">Apellido Paterno</label>
            <input type="text" id="first_surname" name="first_surname" required value="{{ old('first_surname') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('first_surname')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="second_surname" class="block mb-2 text-sm font-medium text-gray-900">Apellido Materno</label>
            <input type="text" id="second_surname" name="second_surname" required value="{{ old('second_surname') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('second_surname')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900">Telefono</label>
            <input type="text" id="telephone" name="telephone" required value="{{ old('telephone') ?? ''}}" maxlength="10"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('telephone')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ str_replace('telephone', 'número', $message) }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</label>
            <input type="email" id="email" name="email" required value="{{ old('email') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('email')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="type_visit" class="block mb-2 text-sm font-medium text-gray-900">¿De donde nos visita?</label>
            <select id="type_visit" name="type_visit" value="{{ old('type_visit') }}" onchange="typeVisit()" required
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option class="hidden" value="">Selecciona una opción</option>
                <option value="1">Banco</option>
                <option value="2">Particular</option>
                <option value="3">Otro</option>
            </select>
            @error('type_visit')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 hidden" id="bankDiv">
            <label for="bank" class="block mb-2 text-sm font-medium text-gray-900">¿Cual banco?</label>
            <select id="bank" name="bank" value="{{ old('bank') }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" class="hidden">Selecciona una opción</option>
                <option value="1">BBVA</option>
                <option value="2">Citibanamex</option>
                <option value="3">Banorte</option>
                <option value="4">HSBC</option>
                <option value="5">Santander</option>
                <option value="6">Scotiabank</option>
            </select>
            @error('bank')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 hidden" id="otherDiv">
            <label for="other" class="block mb-2 text-sm font-medium text-gray-900">Especifique</label>
            <input type="other" id="other" name="other" value="{{ old('other') }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('other')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <button type="submit"
            class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Registrarme
        </button>
    </form>

    @slot('script')
        <script>
            const visit = document.getElementById('type_visit')
            const bank = document.getElementById('bankDiv')
            const other = document.getElementById('otherDiv')

            function typeVisit() {
                if (visit.value === '1') {
                    other.classList.add('hidden')
                    bank.classList.remove('hidden')
                }
                else if (visit.value === '3') {
                    bank.classList.add('hidden')
                    other.classList.remove('hidden')
                }
                else {
                    bank.classList.add('hidden')
                    other.classList.add('hidden')
                }
            }

        </script>
    @endslot

</x-form-layout>
