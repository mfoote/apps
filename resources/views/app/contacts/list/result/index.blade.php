<table class="table table-striped table-hover mt-3 mb-0">
    <thead>
    <tr>
        <th>Chart</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Address</th>
        <th>Phone</th>
        <th colspan="2">Email</th>
    </tr>
    </thead>
    <tbody>
    @if($contacts->count())
        @foreach($contacts as $contact)
            <tr>
                <td>
                    {{$contact->id}} -
                    @if(null !== $contact->chart_number)
                        <span class="text-success">{{$contact->chart_number}}</span>
                    @else
                        <span class="text-danger">Unlinked</span>
                    @endif
                </td>
                <td>
                    {{$contact->last_name}}, {{$contact->first_name}}
                </td>
                <td>{{$contact->date_of_birth}}</td>
                <td>
                    @if(null !== $contact->primary_address)

                    @endif
                </td>
                <td>
                    @if(null !== $contact->primary_phone_number)
                        {{$contact->primary_phone_number->phone_number}}
                    @endif
                </td>
                <td>
                    @if(null !== $contact->primary_email_address)
                        {{$contact->primary_email_address->email_address}}
                    @endif
                </td>
                <td align="right">
                    <a href="/contacts/edit/{{$contact->id}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-door-open"></i>
                    </a>
                    @if(null === $contact->chart_number)
                        <form action="/contacts/trash/{{$contact->id}}" method="post" class="d-none">
                            {{csrf_field()}}
                        </form>
                        <a href="#" class="btn btn-sm btn-danger trash ml-2">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">
                <div class="alert alert-warning m-0">
                    No Contacts found for letter.
                </div>
            </td>
        </tr>
    @endif
    </tbody>
</table>
<script type="text/javascript">
    jQuery(function () {
        jQuery('.trash').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                jQuery(this).parent().find('form').submit();
            }
        })
    });
</script>
