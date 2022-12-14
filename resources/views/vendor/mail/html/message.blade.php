@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
<div style="display: flex; justify-content: center; align-items: center;">
    powered by
    <img src="{{ asset('images/logo_miit.png') }}" alt="logo"
        style="height: 120px; width: 120px;"/>
</div>
@endcomponent
@endslot
@endcomponent
