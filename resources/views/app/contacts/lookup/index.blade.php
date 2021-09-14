<table class="table table-striped table-hover mt-3 mb-0">
    <thead>
    <tr>
        <th>Chart</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @if($contacts->count())
        @foreach($contacts as $contact)
            <tr>
                <td>
                    @if(null !== $contact->chart_number)
                        {{$contact->chart_number}}
                    @else
                        Unlinked
                    @endif
                </td>
                <td>
                    {{$contact->last_name}}, {{$contact->first_name}}
                </td>
                <td>{{$contact->date_of_birth}}</td>
                <td>
                    @if($contact->primary_address->count())

                    @endif
                </td>
                <td>
                    @if($contact->primary_phone_number->count())
                        {{$contact->primary_phone_number[0]->phone_number}}
                    @endif
                </td>
                <td>
                    @if($contact->primary_email_address->count())
                        {{$contact->primary_email_address[0]->email_address}}
                    @endif
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="6">
                <div class="alert alert-warning m-0">
                    No Contacts found for entered criteria.
                </div>
            </td>
        </tr>
    @endif
    </tbody>
</table>
