@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"></i> {{ __('Task Selector') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-header bg-default">
                                    <i class="fas fa-list-alt"></i>
                                    Web Forms
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Manage new forms from the company websites</p>
                                    <p class="card-text">
                                        <a href="/web_forms">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            Go Forms
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-default">
                                    <i class="fas fa-phone"></i>
                                    Web Calls
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Manage calls from the company websites</p>
                                    <p class="card-text">
                                        <a href="/web_calls">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            Go Calls
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-deck mt-4">

                            <div class="card">
                                <div class="card-header bg-default">
                                    <i class="far fa-id-card"></i>
                                    Contacts
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Manage converted Web Forms and Calls.</p>
                                    <p class="card-text">
                                        <a href="/contacts">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            Go Contacts
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-default">
                                    <i class="fas fa-chart-line"></i>
                                    Reporting
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Lead reporting tools.</p>
                                    <p class="card-text">
                                        <a href="/reports">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            Go Reports
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            jQuery('.container').removeClass('d-none');
        });
    </script>
@endsection
