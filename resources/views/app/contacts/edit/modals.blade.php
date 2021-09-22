<div class="modal fade" id="EditContactModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditContactModalTitle">Edit Demographics</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form action="/contacts/update/{{$contact->id}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name"
                                       class="form-control form-control-sm"
                                       value="{{$contact->first_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="middle_initial">Middle Initial</label>
                                <input type="text" id="middle_initial" name="middle_initial"
                                       class="form-control form-control-sm" style="width:30px"
                                       maxlength="1" value="{{$contact->middle_initial}}">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name"
                                       class="form-control form-control-sm"
                                       value="{{$contact->last_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="alias">Preferred Name</label>
                                <input type="text" id="alias" name="alias"
                                       class="form-control form-control-sm"
                                       value="{{$contact->alias}}">
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="text" id="date_of_birth" name="date_of_birth"
                                       class="form-control form-control-sm date"
                                       style="width:100px" value="{{$contact->date_of_birth}}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success submit-form">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AddStatusModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddStatusModalTitle">Add Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form action="/contacts/store/status" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="contact_id" value="{{$contact->id}}">
                            <input type="hidden" name="from_status_id"
                                   value="{{(null !== $contact->current_status)? $contact->current_status->status_id : null}}">
                            <input type="hidden" name="notes[contact_id]" value="{{$contact->id}}">
                            <div class="form-group">
                                <label for="status_id">Status</label>
                                <select name="status_id" id="status_id" class="form-control form-control-sm" required>
                                    <option value="">Select Status</option>
                                    @foreach($statuses as $key => $status)
                                        <option value="{{$key}}">{{$status}}</option>
                                    @endforeach
                                </select>
                                <div class="alert alert-danger is-not-valid m-2 d-none">Please select a status</div>
                                <hr>
                                <h5 class="mt-2">Add a Note?</h5>
                                <label for="follow_up_on">Follow Up On
                                    <span class="text-muted" style="font-size: 80%">(optional)</span>
                                </label>
                                <input type="text" id="follow_up_on" name="notes[follow_up_on]"
                                       class="form-control form-control-sm date"
                                       style="width: 100px" value="">
                                <label for="note">Note</label>
                                <textarea name="notes[note]" class="form-control mt-2" cols="10" rows="5"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success add-status">Add Status</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="AddNoteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddNoteModalTitle">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <form action="/contacts/store/note" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="contact_id" value="{{$contact->id}}">
                            <div class="form-group">
                                <label for="category" class="mt-2 mb-0">Category</label>
                                <select name="category" id="category" class="form-control form-control-sm" required>
                                    <option value="Note">Note</option>
                                </select>
                                <label for="follow_up_on" class="mt-2 mb-0">Follow Up On
                                    <span class="text-muted" style="font-size: 80%">(optional)</span>
                                </label>
                                <input type="text" id="follow_up_on" name="follow_up_on"
                                       class="form-control form-control-sm date"
                                       style="width: 100px" value="">
                                <label for="note" class="mt-2 mb-0">Note</label>
                                <textarea name="note" class="form-control mt-2" cols="10" rows="5" maxlength="500"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success submit-form">Add Note</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ConfigPhoneModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddNoteModalTitle">Manage Phone Numbers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <form action="/contacts/store/note" method="post">
                                {{csrf_field()}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success submit-form">Add Note</button>
                </div>
            </div>
        </div>
</div>
