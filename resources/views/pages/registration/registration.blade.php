<x-form-layout>
    <div class="flex flex-col mb-10 items-center">
        <img class="w-40 h-40" src="{{ asset('images/logo_expo.png') }}" alt="logo_expo_inmobiliaria">
        <p class="text-center">
            <span>
                Por favor agradecemos tu registro a Expo Mundo Inmobiliario 2022.
            </span>
            <br>
            <span>
                El objetivo del registro es poderte mandar más información de los participantes del evento y mandarte promociones exclusivas a los visitantes
            </span>
        </p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mt-5 mb-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('form_store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre(s)</label>
            <input type="text" id="name" name="name" required value="{{ old('name') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="first_surname" class="block mb-2 text-sm font-medium text-gray-900">Apellido Paterno</label>
            <input type="text" id="first_surname" name="first_surname" required value="{{ old('first_surname') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="second_surname" class="block mb-2 text-sm font-medium text-gray-900">Apellido Materno</label>
            <input type="text" id="second_surname" name="second_surname" required value="{{ old('second_surname') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="telephone" class="block mb-2 text-sm font-medium text-gray-900">Telefono</label>
            <input type="number" id="telephone" name="telephone" required value="{{ old('telephone') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo electrónico</label>
            <input type="email" id="email" name="email" required value="{{ old('email') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900">Fecha de nacimiento</label>
            <input type="date" id="birthdate" name="birthdate" required value="{{ old('birthdate') ?? ''}}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="credit1" class="block mb-2 text-sm font-medium text-gray-900">¿Que tipo de credito tiene?</label>
            <select id="credit1" name="credit1" value="{{ old('credit1') }}" onchange="personalCredit()"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option class="hidden">Selecciona una opción</option>
                <option value="Infonavit">Infonavit</option>
                <option value="Fovissste">Fovissste</option>
                <option value="Isssfam">Isssfam</option>
                <option value="Bancario">Bancario</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="mb-6 hidden" id="other_credit">
            <label for="other_credit1" class="block mb-2 text-sm font-medium text-gray-900">Especifique</label>
            <input type="text" id="other_credit1" name="other_credit1" value="{{ old('other_credit1') }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <div class="mb-6">
            <label for="civil_status" class="block mb-2 text-sm font-medium text-gray-900">Estado civil</label>
            <select id="civil_status" name="civil_status" value="{{ old('civil_status') }}" onchange="isMarried()"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" class="hidden">Selecciona una opción</option>
                <option value="soltero">Soltero / Soltera</option>
                <option value="casado">Casado / Casada</option>
                <option value="divorciado">Divorciado / Divorciada</option>
                <option value="viudo">Viudo / Viuda</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="have_children" class="block mb-2 text-sm font-medium text-gray-900">¿Tiene hijos / hijas?</label>
            <input type="number" id="have_children" name="have_children" aria-describedby="helper-childs-explanation1" value="{{ old('have_children') ?? 0 }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <p id="helper-childs-explanation1" class="mt-2 text-sm text-gray-500">
                En caso de no tener, coloque 0
            </p>
        </div>
        <div class="mb-6 hidden" id="spouse_status_form">
            <label for="spouse_status" class="block mb-2 text-sm font-medium text-gray-900">¿Tu conyuge trabaja?</label>
            <select id="spouse_status" name="spouse_status" value="{{ old('spouse_status') }}" onchange="isSpouseWork()"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="no" class="hidden">Selecciona una opción</option>
                <option value="si">Si</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="mb-6 hidden" id="spouse_credit_form">
            <label for="spouse_credit" class="block mb-2 text-sm font-medium text-gray-900">¿Que tipo de credito tiene tu conyuge?</label>
            <select id="spouse_credit" name="spouse_credit" value="{{ old('spouse_credit') }}" onchange="otherSpouseCredit()"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" class="hidden">Selecciona una opción</option>
                <option value="Infonavit">Infonavit</option>
                <option value="Fovissste">Fovissste</option>
                <option value="Isssfam">Isssfam</option>
                <option value="Bancario">Bancario</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="mb-6 hidden" id="spouse_other_credit_form">
            <label for="credit2" class="block mb-2 text-sm font-medium text-gray-900">Especifique</label>
            <input type="text" id="credit2" name="credit2" value="{{ old('credit2') }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <button type="submit"
            class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Registrarme
        </button>
    </form>

    @slot('script')
        <script>
            const credit1 = document.getElementById('credit1')
            const otherCreditForm = document.getElementById('other_credit')
            const civilStatus = document.getElementById('civil_status')
            const spouseStatusForm = document.getElementById('spouse_status_form')
            const spouseStatus = document.getElementById('spouse_status')
            const spouseCreditForm = document.getElementById('spouse_credit_form')
            const spouseCredit = document.getElementById('spouse_credit')
            const spouseOtherCreditForm = document.getElementById('spouse_other_credit_form')

            function personalCredit() {
                if (credit1.value === 'otro')
                    otherCreditForm.classList.remove('hidden')
                else
                    otherCreditForm.classList.add('hidden')
            }

            function isMarried() {
                if (civilStatus.value === 'casado')
                    spouseStatusForm.classList.remove('hidden')
                else
                    spouseStatusForm.classList.add('hidden')
            }

            function isSpouseWork () {
                if (spouseStatus.value === 'si')
                    spouseCreditForm.classList.remove('hidden')
                else
                    spouseCreditForm.classList.add('hidden')
            }

            function otherSpouseCredit() {
                if (spouseCredit.value === 'otro')
                    spouseOtherCreditForm.classList.remove('hidden')
                else
                    spouseOtherCreditForm.classList.add('hidden')
            }

        </script>
    @endslot

</x-form-layout>
