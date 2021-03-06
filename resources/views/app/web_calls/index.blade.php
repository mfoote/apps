@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Web Calls') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            jQuery('.navbar-brand').html('<i class="fas fa-long-arrow-alt-left"></i> <i class="fas fa-dot-circle"></i>');
        });
    </script>
    {{--    <pre>--}}
    {{--        {{print_r($entries)}}--}}
    {{--    </pre>--}}
@endsection
