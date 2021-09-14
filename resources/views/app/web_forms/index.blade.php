@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Web Forms') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert {{$errors->first('class')}} alert-dismissible fade show" role="alert">
                                <strong>{{$errors->first('type')}}!</strong> {{$errors->first('msg')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <table class="table table-striped table-hover">
                            <thead>
                            <th>Site</th>
                            <th>Received</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th colspan="2">Email</th>
                            </thead>
                            <tbody>
                            @foreach($entries as $entry)
                                <tr class="set-bg">
                                    <td class="">
                                        @if($entry['site'] === 'spinecenteratlanta.com')
                                            <img src="/image/logo-only-gold.png" width="25" alt="SCA Logo">
                                            {{$entry['status']}}
                                        @elseif($entry['site'] === 'rejuvenateatlanta.com')
                                            <img src="/image/logo-only-rejuvenate.png" alt="RejAtl Logo">
                                        @endif
                                    </td>
                                    <td>
                                        {{date('m/d/y g:iA', strtotime($entry['created_at']))}}
                                        <br>
                                        <small class="text-muted">{{$entry['form_name']}}</small>
                                    </td>
                                    <td>
                                        {{$entry['last_name']}}, {{$entry['first_name']}}
                                    </td>
                                    <td>
                                        @if(array_key_exists('phone_number', $entry))
                                            {{$entry['phone_number']}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(array_key_exists('email_address', $entry))
                                            {{$entry['email_address']}}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-none comment-wrapper">
                                            <div class="row">
                                                <div class="col">
                                                    @if(array_key_exists('comments', $entry))
                                                        {!! nl2br($entry['comments']) !!}
                                                    @else
                                                        <div class="alert alert-info">No Comments Available</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <form method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$entry['id']}}">
                                            <input type="hidden" name="entry" value="{{json_encode($entry)}}">
                                        </form>
                                        @if(array_key_exists('comments', $entry))
                                            <button class="btn btn-sm btn-info comment">
                                                <i class="far fa-comment"></i>
                                            </button>
                                        @endif
                                        <button class="btn btn-sm btn-success convert">
                                            <i class="far fa-id-card"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger ml-2 trash">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentsModalTitle">Comments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {
            jQuery('.navbar-brand').html('<i class="fas fa-long-arrow-alt-left"></i> <i class="fas fa-rocket"></i>')
            jQuery('.trash').on('click', function () {
                if (confirm('are you sure?')) {
                    jQuery(this).closest('td').find('form').attr('action', '/web_forms/trash').submit()
                }
            });
            jQuery('.comment').on('click', function () {
                jQuery('.set-bg').removeClass('bg-warning');
                jQuery(this).closest('.set-bg').addClass('bg-warning');
                var html = jQuery(this).closest('td').find('div.comment-wrapper').html();
                jQuery('#commentsModal .modal-body').html(html);
                jQuery('#commentsModal').modal('show');
            });
            jQuery('.convert').on('click', function () {
                jQuery(this).closest('td').find('form').attr('action', '/web_forms/convert').submit();
            });
            jQuery('#commentsModal').modal({
                keyboard: false,
                show: false
            }).on('hidden.bs.modal', function () {
                jQuery('#commentsModal .modal-body').html('');
            });
        });
    </script>
    {{--    <pre>--}}
    {{--        {{print_r($entries)}}--}}
    {{--    </pre>--}}
@endsection
