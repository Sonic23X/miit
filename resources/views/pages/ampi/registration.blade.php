<x-form-layout>
    <div class="flex flex-col mb-10 items-center">
        <img class="h-24 mb-6" src="{{ asset('images/logo_ampi.png') }}" alt="logo">
        <p class="text-center">
            <span>
                ¡Bienvenido al registro de asistencia para el 10mo foro de convergencia inmobiliaria en Pachuca!
            </span>
        </p>
        <p class="text-center">
            <span>
                Al haber terminado tu registro, recibirás un correo con más información para la asistencia al foro.
            </span>
        </p>
    </div>
    <form action="{{ route('form_store_ampi') }}" method="POST">
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
            <label for="real_estate" class="block mb-2 text-sm font-medium text-gray-900">Nombre de inmobiliaria</label>
            <input type="text" id="real_estate" name="real_estate" required value="{{ old('real_estate') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('real_estate')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 flex md:flex-row flex-col md:space-x-5">
            <div class="flex flex-col w-full">
                <label for="partner" class="block mb-2 text-sm font-medium text-gray-900">¿Eres socio de AMPI?</label>
                <select id="partner" name="partner" value="{{ old('partner') }}" onchange="regionDisplay()"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
                @error('partner')
                <p class="text-xs font-normal text-red-600 mt-1">
                {{ $message }}
                </p>
                @enderror
            </div>
            <div class="hidden flex-col w-full mt-6 md:mt-0" id="regionDiv">
                <label for="region" class="block mb-2 text-sm font-medium text-gray-900">Región</label>
                <input type="text" id="region" name="region" required value="{{ old('region') ?? ''}}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('region')
                <p class="text-xs font-normal text-red-600 mt-1">
                {{ $message }}
                </p>
                @enderror
            </div>
        </div>
        <div class="mb-6 hidden">
            <label for="coupon" class="block mb-2 text-sm font-medium text-gray-900">Cupón</label>
            <input type="text" id="coupon" name="coupon"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <p class="text-xs font-normal text-red-600 mt-1" id="couponAlert"></p>
        </div>
        <button type="submit" id="nextStep"
            class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2">
            Registrarme - <span id="costo">$950.00</span>
        </button>
    </form>

    @slot('script')
        <script>
            function regionDisplay() {
                var div = document.getElementById('regionDiv')
                var select = document.getElementById('partner')

                if (select.value === '1') {
                    div.classList.add('flex')
                    div.classList.remove('hidden')
                } else {
                    div.classList.add('hidden')
                    div.classList.remove('flex')
                }
            }

            /*function validateCoupon() {
                var coupon = document.getElementById('coupon')

                if (condition) {

                }
            }*/
        </script>
    @endslot

</x-form-layout>
