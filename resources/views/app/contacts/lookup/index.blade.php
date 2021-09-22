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
    @if(!$nameError)
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
    @else
        <tr>
            <td colspan="6">
                <div class="alert alert-warning m-0">
                    Named search must be Last Name,<span class="text-danger">&lt;comma&gt;</span> First Name, partial names are ok, but comma must be included.
                    <ul>
                        <li>Example, for Jane Doe, the following will work...</li>
                        <ul>
                            <li>doe, jane or doe,jane</li>
                            <li>do, j or do,j</li>
                            <li>d, j or d,j</li>
                            <li>d,</li>
                        </ul>
                    </ul>
                </div>
            </td>
        </tr>
    @endif
    </tbody>
</table>
