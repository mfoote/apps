@extends('layouts.app')
@section('content')
    <style>
        span .copy, i.configure, i.manage {
            color: #38c172 !important;
            font-size: 75%;
            cursor: pointer;
        }
    </style>
    <div class="container-fluid">
        {{--        <pre>--}}
        {{--            {{print_r($contact->toArray())}}--}}
        {{--        </pre>--}}
        <div class="row justify-content-center" style="height: 90% !important;">
            <div class="col-lg-12 set-100">
                <div class="card set-100">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <span style="font-size: 70%">
                            <span class="text-success">CID# {{$contact->id}}</span>
                            </span>
                            - {{$contact->last_name}}, {{$contact->first_name}} -
                            <span style="font-size: 70%">
                            <span class="text-primary">EMR#</span>
                            @if(null !== $contact->chart_number)
                                    <span class="text-primary">{{$contact->chart_number}}</span>
                                @else
                                    <span class="text-danger">Not Linked</span>
                                <span><i class="fas fa-link manage" title="Link to EMR"></i></span>
                                @endif
                            </span>
                        </h4>
                    </div>
                    <div class="card-body overflow-auto">
                        <div class="row h-100">
                            <div class="col-sm-12 col-lg-2 mb-2">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="/launch" class="text-secondary">Launch Pad</a>
                                    </li>
                                    <li class="list-group-item active">
                                        <a href="/contacts/edit/{{$contact->id}}" class="text-light refresh-contact">
                                            Reload Contact
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/web_forms" class="text-secondary">Web Forms</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/contacts" class="text-secondary">Contact Search</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/contacts/list" class="text-secondary">Contact List</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/reports" class="text-secondary">Reports</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-12 col-lg-4 mb-2">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="text-bold d-inline-block">
                                                    <h5 class="mb-0">Demographic</h5>
                                                </div>
                                                <div class="float-right">
                                                    <a href="#" class="text-secondary" data-toggle="modal"
                                                       data-target="#EditContactModal">
                                                        <i class="fas fa-pencil-alt ttip" title="Edit Demographics"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td class="pl-3">
                                                            {{$contact->last_name}},
                                                            {{$contact->first_name}}
                                                            @if(strlen($contact->middle_initial))
                                                                {{$contact->middle_initial}}.
                                                            @endif
                                                            @if(strlen($contact->alias))
                                                                <i class="text-muted">"{{$contact->alias}}"</i>
                                                            @endif
                                                        </td>
                                                    <tr>
                                                    <tr>
                                                        <th>Date of Birth</th>
                                                        <td class="pl-3">
                                                            @if(null !== $contact->date_of_birth)
                                                                {{date('m/d/Y', strtotime($contact->date_of_birth))}}
                                                                <span class="text-muted" style="font-size: 70%">
                                                                    ({{$contact->primary_email_address->email_address_type}})
                                                                </span>
                                                            @else
                                                                <span class="text-danger">Not Entered</span>
                                                            @endif
                                                            {{$contact->date_of_birth}}
                                                        </td>
                                                    <tr>
                                                        <th>
                                                            Primary Phone
                                                            <i class="fas fa-cog manage" title="Manage Phone Numbers"></i>
                                                        </th>
                                                        <td class="pl-3">
                                                            @if(null !== $contact->primary_phone_number)
                                                                <span>
                                                                    <span>
                                                                        {{$contact->primary_phone_number->phone_number}}
                                                                    </span>
                                                                    <i class="far fa-copy copy" title="Copy to clipboard"></i>
                                                                </span>
                                                                <span class="text-muted" style="font-size: 70%">({{$contact->primary_phone_number->phone_number_type}})</span>
                                                            @else
                                                                <span class="text-danger">Not Entered</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Primary Email
                                                            <i class="fas fa-cog manage" title="Manage Email Addresses"></i>
                                                        </th>
                                                        <td class="pl-3">
                                                            @if(null !== $contact->primary_email_address)
                                                                <span>
                                                                    <span>
                                                                        {{$contact->primary_email_address->email_address}}
                                                                    </span>
                                                                    <i class="far fa-copy copy" title="Copy to clipboard"></i>
                                                                </span>
                                                                <span class="text-muted" style="font-size: 70%">({{$contact->primary_email_address->email_address_type}})</span>
                                                            @else
                                                                <span class="text-danger">Not Entered</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="2">
                                                            Address
                                                            <i class="fas fa-cog manage" title="Manage Addresses"></i>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            @if(null !== $contact->primary_address)
                                                                {{$contact->primary_address->address}}
                                                                <span class="text-muted" style="font-size: 70%">
                                                                    ({{$contact->primary_email_address->email_address_type}})
                                                                </span>
                                                            @else
                                                                <span class="text-danger">Not Entered</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="text-bold d-inline-block">
                                                    <h5 class="mb-0">Status</h5>
                                                </div>
                                                <div class="float-right">
                                                    <a href="#" class="text-success" data-toggle="modal"
                                                       data-target="#AddStatusModal">
                                                        <i class="fas fa-exchange-alt ttip" title="Changes Status"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body overflow-auto" style="max-height: 200px !important;">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <th>Current</th>
                                                        <td class="pl-3">
                                                            @if(null !== $contact->current_status)
                                                                {{$contact->current_status->status->value}}
                                                            @else
                                                                {{$contact->status}}
                                                            @endif
                                                        </td>
                                                    <tr>
                                                    </tbody>
                                                </table>
                                                <table class="table table-sm table-striped table-borderless mb-2">
                                                    <thead>
                                                    <tr>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>By</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($contact->statuses->count())
                                                        @foreach($contact->statuses as $status)
                                                            <tr>
                                                                <td>
                                                                    @if(null !== $status->from_status)
                                                                        {{$status->from_status->value}}
                                                                    @else
                                                                        None
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{$status->status->value}}
                                                                </td>
                                                                <td>
                                                                    {{$status->user->last_name}}
                                                                    , {{$status->user->first_name}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3">{{$contact->status}}</td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 h-100">
                                <div class="row h-100">
                                    <div class="col-12 h-50">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <div class="text-bold d-inline-block"><h5 class="mb-0">Notes</h5></div>
                                                <div class="float-right">
                                                    <a href="#" class="text-success" data-toggle="modal"
                                                       data-target="#AddNoteModal">
                                                        <i class="fas fa-plus ttip" title="Add a Note"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body overflow-auto">
                                                @if($contact->notes->count())
                                                    @php
                                                        $count = 0
                                                    @endphp
                                                    @foreach($contact->notes as $note)
                                                        @if($count > 0)
                                                            <hr class="m-1">
                                                        @endif
                                                        <table class="w-100">
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <strong>{{$note->category}}</strong>
                                                                    -
                                                                    <small
                                                                        class="text-muted">{{date('m/d/y g:iA', strtotime($note->created_at))}}</small>
                                                                </td>
                                                                <td align="right" class="text-primary">
                                                                    {{$note->user->last_name}},
                                                                    {{$note->user->first_name}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <div class="alert alert-info mb-1">
                                                                        {!! nl2br($note->note) !!}
                                                                    </div>
                                                                    @if(null !== $note->follow_up_on && !$note->follow_up_done)
                                                                        <a href="/contacts/note/close/fu/{{$note->id}}"
                                                                           class="float-right btn btn-sm btn-warning">
                                                                            Close?
                                                                        </a>
                                                                        <span class="float-right text-danger mr-2">
                                                                            Follow up on {{date('m/d/y', strtotime($note->follow_up_on))}}
                                                                        </span>
                                                                    @elseif(null !== $note->follow_up_on && $note->follow_up_done)
                                                                        <small class="text-muted float-right">
                                                                            Follow up marked done {{date('m/d g:i A')}}
                                                                            by {{$note->update_user->first_name}}
                                                                            , {{$note->update_user->last_name}}
                                                                        </small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        @php
                                                            $count++
                                                        @endphp
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-info m-0">
                                                        Note notes available for this account,
                                                        <a href="#" class="new-note">create one</a>?
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 h-50 mt-2">
                                        <div class="card h-100">
                                            <div class="card-header">
                                                <span class="text-bold"><h5 class="mb-0">Initial Comment</h5></span>
                                            </div>
                                            <div class="card-body overflow-auto">
                                                @if(strlen(trim($contact->initial_comment)))
                                                    {{nl2br(trim($contact->initial_comment))}}
                                                @else
                                                    <div class="alert alert-info m-0">
                                                        No contact comments.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('app.contacts.edit.modals')
    </div>
    <script>
        function loadPageFull() {
            window.location = '/contacts/edit/{{$contact->id}}'
        }

        jQuery(function () {
            jQuery('html, body, #app, .container-fluid, .set-100, main').addClass('h-100');
            jQuery('.navbar .container').removeClass('container').addClass('container-fluid');
            jQuery('.container, .container-fluid').removeClass('d-none');
            jQuery('.date').mask("00/00/0000", {
                placeholder: "__/__/____",
                clearIfNotMatch: true
            });

            jQuery('#EditContactModal').modal({
                keyboard: false,
                show: false
            }).on('hidden.bs.modal', function () {
                jQuery('.container, .container-fluid').addClass('d-none');
                loadPageFull();
            });
            jQuery('#AddStatusModal').modal({
                keyboard: false,
                show: false
            }).on('hidden.bs.modal', function () {
                jQuery('.container, .container-fluid').addClass('d-none');
                loadPageFull()
            });
            jQuery('#AddNoteModal').modal({
                keyboard: false,
                show: false
            }).on('hidden.bs.modal', function () {
                jQuery('.container, .container-fluid').addClass('d-none');
                loadPageFull()
            });
            jQuery('.add-status').on('click', function (e) {
                e.preventDefault();
                if (jQuery(this).closest('.modal-content').find('form select[name="status_id"]').val() == "") {
                    jQuery(this).closest('.modal-content').find('.is-not-valid').removeClass('d-none');
                } else {
                    jQuery(this).closest('.modal-content').find('form').submit();
                }
            });
            jQuery('.submit-form').on('click', function (e) {
                e.preventDefault();
                jQuery(this).closest('.modal-content').find('form').submit();
            });
            jQuery('span .copy, i.configure, .ttip, i.manage').tooltip()
        });
    </script>
@endsection
