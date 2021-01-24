@extends('layouts.templates.index',[
'list_name'=>'Liste des patients','name_create_route'=>'patient.create','entities'=>$patients]
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_patient'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_patient')])
    @endif
    @if(Session::has('destroy_patient'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_patient')])
    @endif
    @if(Session::has('update_patient'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_patient')])
    @endif
@endsection

@section('TableColumnsName_th')
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>SSN</th>
    <th>Date de naissance</th>
    <th>Nuero de télephone</th>
    <th>Addresse</th>
    <th>Email</th>
    <th></th>
@endsection

@section('TableBodyList_tr')
    @foreach($patients as $patient)
        <tr>
            <td>{{ $patient->id }}</td>
            <td>
                <p class="text-dark">{{ $patient->last_name }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $patient->first_name }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $patient->social_security_number }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $patient->birth_date }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $patient->phone_number }}</p>
            </td>
            <td>
                <p class="text-dark">{{ Str::limit($patient->address,15) }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $patient->email }}</p>
            </td>
            <td class="text-right">
                <div class="dropdown show d-inline-block widget-dropdown">
                    <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                        <li class="dropdown-item">
                            <a
                                href="{{ route('patient.show', ['patient' =>$patient->id]) }}">
                                <i class="mdi mdi-account-details mr-1"></i>
                                Voir
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a
                                href="{{ route('patient.edit', ['patient' =>$patient->id]) }}">
                                <i class="mdi mdi-square-edit-outline mr-1"></i>
                                Modifier
                            </a>
                        </li>
                        <li class="dropdown-item">
                                <a href="#"
                                    {{-- entityid and .a-delete-entity are used for popup alert --}}
                                    data-entityid="{{ $patient->id }}" class="a-delete-entity">
                                    <i class="mdi mdi-delete mr-1"></i>
                                    Supprimer
                                </a>
                                <form id="{{ 'destroy-form-'.$patient->id }}"
                                    action="{{ route('patient.destroy',['patient'=>$patient->id]) }}"
                                    method="POST" class="d-none">
                                    @method('DELETE')
                                    @csrf
                                </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
@endsection
