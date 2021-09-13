@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Contact Search') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <input type="text" class="form-control" placeholder="Criteria">
                                    <small class="text-muted">Chart or Last,First Name</small>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <input type="text" class="form-control">
                                    <small class="text-muted">Date of Birth</small>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <table class="table table-striped table-hover mt-3 mb-0">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Chart</th>
                                        <th>Name</th>
                                        <th>Date of Birth</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody class="results">
                                    <tr>
                                        <td colspan="6">
                                            <div class="alert alert-info m-0">
                                                Enter Search Criteria
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            jQuery('.navbar-brand').html('<i class="fas fa-long-arrow-alt-left"></i> <i class="fas fa-rocket"></i>')
        });
    </script>
    {{--    <pre>--}}
    {{--        {{print_r($entries)}}--}}
    {{--    </pre>--}}
@endsection
