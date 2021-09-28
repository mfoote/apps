<div class="row">
    <div class="col">
        @if($contact)
            <form id="emr_lookup">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" autocomplete="off"
                           class="form-control form-control-sm"
                           value="{{$contact->first_name}}" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" autocomplete="off"
                           class="form-control form-control-sm"
                           value="{{$contact->last_name}}" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" id="dob" name="dob" autocomplete="off"
                           class="form-control form-control-sm dob"
                           style="width:100px" value="@if(strlen($contact->date_of_birth)){{$contact->date_of_birth->format('m/d/Y')}}@endif">
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-warning float-right look-up-submit">Search <i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="result">
            </div>
        @else
            <div class="alert alert-danger">
                An error occurred looking up the local contact, please close this dialog and try again.
            </div>
        @endif
    </div>
</div>
<script type="text/javascript">
    jQuery(function(){
        jQuery('.dob').mask("00/00/0000", {
            placeholder: "__/__/____",
            clearIfNotMatch: true
        });
jQuery('#LinkEmrModal .look-up-submit').on('click', function (e) {
    e.preventDefault();
    var data = jQuery(this).closest('form').serialize();
    jQuery.ajax('/emr/lookup/result/{{$contact->id}}', {
        method: 'post',
        data: data,
        success: function (response) {
            jQuery('#LinkEmrModal .modal-body .result').html(response);
        }
    });
});
    });
</script>
