@extends('layouts.maindo')

@Section('links')
    <link rel="manifest" href="{{ asset('mix-manifest.json') }}" />
@endsection

@Section('titre')
    Dashboard
@endsection

@Section('content')
    <input type="hidden" id="subscriptionsUrl" value="{{ route('subscriptions',[] , false) }}">
    <input type="hidden" id="authToken" value="{{ session('auth_token')['value'] }}">
    <input type="hidden" id="apiHostUrl" value="{{ env('E_USER_API') }}">
    @if(session("error"))
    <div class="alert alert-danger" role="alert">
        {{ session("error") }}
    </div>
    @endif
    @if(session("success"))
        <div class="alert alert-success" role="alert">
            {{ session("success") }}
        </div>
    @endif

    <div id="dashboard"></div>
@endsection

@section('script')
    <script src="{{ asset('js/components/manifest.js') }}"></script>
    <script src="{{ asset('js/components/vendor.js') }}"></script>
    <script src="{{ asset('js/components/dashboard.js') }}"></script>
@endsection
