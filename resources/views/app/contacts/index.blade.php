@extends('layouts.app')
@section('content')
    <div class="container d-none">
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
                        <div class="row mb-2">
                            <div class="col">
                                <div class="btn-group mr-2" role="group" aria-label="group 1">
                                    <button type="button" class="btn btn-secondary">Search by</button>
                                </div>
                                <div class="btn-group btn-group-sm crit-btn" role="group" aria-label="group 2">
                                    <button type="button" class="btn btn-success" data-type="name">Name</button>
                                    <button type="button" class="btn btn-success" data-type="chart">Chart</button>
                                    <button type="button" class="btn btn-success" data-type="phone">Phone</button>
                                </div>
                                <div class="btn-group btn-group-sm mr-2" role="group" aria-label="group 1">
                                    <a href="/contacts/list" target="_self" class="btn btn-primary list">View List</a>
                                </div>
                            </div>
                        </div>
                        <form>
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col">
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-4 col-lg-3 criteria chart d-none">
                                            <input type="text" name="chart" class="form-control">
                                            <small class="text-muted">Enter Chart Number then TAB</small>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3 criteria name d-none">
                                            <input type="text" name="name" class="form-control">
                                            <small class="text-muted">Enter Last,First Name then TAB</small>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-3 criteria phone d-none">
                                            <input type="text" name="phone" class="form-control">
                                            <small class="text-muted">Enter 10 Digit Phone</small>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-2">
                                            <input type="text" name="date_of_birth" class="form-control date">
                                            <small class="text-muted">Date of Birth</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col result">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function doContactCriteria(contact_criteria) {
            jQuery('.crit-btn button[data-type="' + contact_criteria + '"]').addClass('active');
            jQuery('.criteria').removeClass('active').addClass('d-none').find('input').val('');
            jQuery('.criteria.' + contact_criteria).addClass('active').removeClass('d-none');
        }

        function doContactLookup(field) {
            var data = jQuery('.container form').serialize();
            data = data + '&type=' + field;
            jQuery.ajax('/contacts/lookup', {
                method: 'post',
                data: data,
                success: function (response) {
                    jQuery('.container .result').html(response);
                }
            })
        }

        jQuery(function () {
            jQuery('.navbar-brand').html('<i class="fas fa-long-arrow-alt-left"></i> <i class="fas fa-rocket"></i>');
            var contact_criteria = Cookies.get('contact_criteria');
            if (contact_criteria === undefined) {
                contact_criteria = 'chart';
                Cookies.set('contact_criteria', contact_criteria)
            }
            jQuery('.crit-btn button').on('click', function (e) {
                jQuery('.container .result').html('')
                jQuery('.crit-btn button').removeClass('active');
                var contact_criteria = jQuery(this).data('type');
                Cookies.set('contact_criteria', contact_criteria);
                doContactCriteria(contact_criteria);
            });
            doContactCriteria(contact_criteria);
            jQuery('.date').mask("00/00/0000", {
                placeholder: "__/__/____",
                clearIfNotMatch: true,
                onComplete: function (cep, event, currentField) {
                    var field;
                    jQuery('.criteria input').each(function () {
                        if (jQuery(this).val() != "") {
                            field = jQuery(this).attr('name');
                        }
                    });
                    doContactLookup(field);
                }
            });
            jQuery('.criteria.chart').find('input').on('blur', function () {
                if (jQuery(this).val().length) {
                    doContactLookup(jQuery(this).attr('name'));
                }
            });
            jQuery('.criteria.name').find('input').on('blur', function () {
                if (jQuery(this).val().length) {
                    doContactLookup(jQuery(this).attr('name'));
                }
            });
            jQuery('.criteria.phone').find('input').mask('(000) 000-0000', {
                placeholder: "(___) ___-____",
                clearIfNotMatch: true,
                onComplete: function (cep, event, currentField) {
                    doContactLookup(currentField.attr('name'));
                }
            });
            jQuery('.container').removeClass('d-none');
        });
    </script>
    {{--    <pre>--}}
    {{--        {{print_r($entries)}}--}}
    {{--    </pre>--}}
@endsection
