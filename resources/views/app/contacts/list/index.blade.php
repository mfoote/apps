@extends('layouts.app')
@section('content')
    <div class="container d-none">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Contact List') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <ul class="pagination">
                                        @foreach($letters as $letter)
                                            <li class="page-item">
                                                <a class="page-link text-capitalize letters letter-{{strtolower($letter->letter)}}"
                                                   href="#" data-letter="{{strtolower($letter->letter)}}">
                                                    {{$letter->letter}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function doLink() {
            jQuery.ajax('/contacts/list/' + jQuery('.page-item.active a').data('letter'), {
                method: 'get',
                success: function (response) {
                    jQuery('.result').html(response)
                }
            });
        }

        jQuery(function () {
            var letter = Cookies.get('contact_list_letter');
            if (letter === undefined) {
                letter = 'letter-a';
                Cookies.set('contact_list_letter', 'letter-a');
            }
            jQuery('a.' + letter).closest('li').addClass('active');
            doLink();
            jQuery('.page-item a').on('click', function (e) {
                e.preventDefault();
                Cookies.set('contact_list_letter', 'letter-' + jQuery(this).data('letter'));
                jQuery('li').removeClass('active');
                jQuery(this).closest('li').addClass('active');
                doLink()
            })
            jQuery('.navbar-brand').attr('href', '/contacts').html('<i class="fas fa-long-arrow-alt-left"></i> Contacts');
            jQuery('.container').removeClass('d-none');
        });
    </script>
@endsection
