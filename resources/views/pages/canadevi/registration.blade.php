<x-form-layout>
    <div class="flex flex-col mb-10 items-center">
        <img class="w-40 h-40" src="{{ asset('images/foto_canadevi.png') }}" alt="logo">
        <p class="text-center">
            <span>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio aspernatur vitae dolores, nisi reiciendis nihil debitis tenetur at illo id earum beatae fuga culpa blanditiis minima obcaecati eius reprehenderit cupiditate.
            </span>
        </p>
    </div>
    <form action="{{ route('form_store_canadevi') }}" method="POST">
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
            <label for="company" class="block mb-2 text-sm font-medium text-gray-900">Empresa</label>
            <input type="text" id="company" name="company" required value="{{ old('company') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('company')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="position" class="block mb-2 text-sm font-medium text-gray-900">Puesto</label>
            <input type="text" id="position" name="position" required value="{{ old('position') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('position')
            <p class="text-xs font-normal text-red-600 mt-1">
               {{ $message }}
            </p>
            @enderror
        </div>
        <div class="">
            <label for="position" class="block mb-2 text-sm font-medium text-gray-900">
                Asistencia
            </label>
        </div>
        <div class="flex flex-row space-x-5 mb-3">
            <div class="flex items-center pl-4 w-full">
                <input id="mode-2" type="radio" value="0" name="mode"
                    @if (old('mode') == null || old('mode') == 0) checked @endif
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                <label for="mode-2" class="py-4 ml-2 w-full text-sm font-medium text-gray-900">
                    Virtual
                </label>
            </div>
            <div class="flex items-center pl-4 w-full">
                <input id="mode-1" type="radio" value="1" name="mode"
                    @if ($counts >= $limit) disabled @endif
                    @if (old('mode') != null && old('mode') == 1) checked @endif
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                <label for="mode-1" class="py-4 ml-2 w-full text-sm font-medium text-gray-900">
                    Presencial
                    <p class="text-xs font-normal text-gray-500">
                    @if ($counts >= $limit)
                        Cupo completo
                    @else
                        Cupo limitado ({{ $limit - $counts }} restantes)
                    @endif
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

        </script>
    @endslot

</x-form-layout>
