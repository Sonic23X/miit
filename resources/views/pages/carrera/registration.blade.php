<x-form-layout>
    <div class="flex flex-col mb-10 items-center">
        <img class="w-40 h-40 mb-6" src="{{ asset('images/logo_carrera.png') }}" alt="logo_carrera_canadevi">
        <p class="text-center">
            <span>
                ¡Bienvenida a la carrera Canadevi Hidalgo 2022!  Por favor llena todos los campos del formulario a continuación para llevar a cabo tu registro. ¡Por favor comparte esta liga para que seamos muchos los que nos sumemos!
            </span>
        </p>
    </div>
    <form action="{{ route('form_store_race') }}" method="POST">
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
            <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900">Fecha de nacimiento</label>
            <input type="date" id="birthdate" name="birthdate" required value="{{ old('birthdate') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('birthdate')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Genero</label>
            <select id="gender" name="gender" required value="{{ old('gender') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                <option value="0">Masculino</option>
                <option value="1">Femenino</option>
                <option value="2">Otro</option>
                <option value="3">Prefiero no especificar</option>
            </select>
            @error('gender')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="size" class="block mb-2 text-sm font-medium text-gray-900">Talla</label>
            <select id="size" name="size" required value="{{ old('size') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
            @error('size')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="grid grid-cols-2 gap-2 mb-6">
            <div>
                <label for="state" class="block mb-2 text-sm font-medium text-gray-900">Estado</label>
                <select id="state" name="state" required value="{{ old('state') ?? ''}}" onchange="stateChange()"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Selecciona una opción</option>
                    @foreach ($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('state')
                <p class="text-xs font-normal text-red-600 mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Ciudad / Municipio</label>
                <select id="city" name="city" required value="{{ old('city') ?? ''}}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </select>
                @error('city')
                <p class="text-xs font-normal text-red-600 mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
        </div>
        <div class="">
            <label for="position" class="block mb-2 text-sm font-medium text-gray-900">
                Modalidad de la carrera
            </label>
        </div>
        <div class="flex flex-row space-x-5 mb-3">
            <div class="flex items-center pl-4 w-full">
                <input id="event-2" type="radio" value="0" name="event"
                    @if (old('event') == null || old('event') == 0) checked @endif
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                <label for="event-2" class="py-4 ml-2 w-full text-sm font-medium text-gray-900">
                    Carrera de 7 KM
                    <p class="text-xs font-bold text-gray-900">
                        $160.00
                    </p>
                </label>
            </div>
            <div class="flex items-center pl-4 w-full">
                <input id="event-1" type="radio" value="1" name="event"
                    @if (old('event') != null && old('event') == 1) checked @endif
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                <label for="event-1" class="py-4 ml-2 w-full text-sm font-medium text-gray-900">
                    Caminata de 3KM
                    <p class="text-xs font-bold text-gray-900">
                        $60.00
                    </p>
                </label>
            </div>
        </div>

        <button type="submit"
            class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Registrarme
        </button>
    </form>

    @slot('script')
        <script>
            function stateChange() {
                var select = document.getElementById('state')
                var cities = document.getElementById('city')

                fetch(`{{ url("cities") }}/${select.value}`, {
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    method:'GET'
                })
                .then(response => response.json())
                .then((result) => {
                    cities.innerHTML = ''

                    result.cities.forEach(element => {
                        var option = document.createElement('option')
                        option.value = element.id
                        option.text = element.name

                        cities.append(option)
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        </script>
    @endslot

</x-form-layout>
