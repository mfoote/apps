<div class="clearfix"></div>
<div class="row mt-2">
    <div class="col">
        @if(!$data['error'])
            <table class="table table-hover table-sm table-striped mb-0">
                <thead>
                <th>Chart</th>
                <th>Name</th>
                <th>Gender</th>
                <th colspan="2">Birthdate</th>
                </thead>
                <tbody>
                @if(array_key_exists('patients', $data['data']) && count($data['data']['patients']))
                    @foreach($data['data']['patients'] as $patient)
                        <tr>
                            <td>{{$patient['chart_number']}}</td>
                            <td>{{$patient['name']}}</td>
                            <td>{{$patient['gender']}}</td>
                            <td>
                                @if(strlen($patient['dob']))
                                    {{date('m/d/y', strtotime($patient['dob']))}}
                                @else
                                    NA
                                @endif
                            </td>
                            <td align="right">
                                <form action="/contacts/link/emr/{{$id}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="chart_number" value="{{$patient['chart_number']}}">
                                    <input type="hidden" name="emr_id" value="{{$patient['id']}}">
                                    <input type="hidden" name="emr_name" value="CareCloud">
                                    <button class="btn btn-sm btn-info"><i class="fas fa-link"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-info mb-0">No patients found</div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        @else
        @endif
    </div>
</div>
