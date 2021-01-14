@extends('layouts.templates.index',[
'list_name'=>'Liste des médecins','name_create_route'=>'doctor.create','entities'=>$doctors]
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_doctor'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_doctor')])
    @endif
    @if(Session::has('destroy_doctor'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_doctor')])
    @endif
    @if(Session::has('update_doctor'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_doctor')])
    @endif
@endsection

@section('TableColumnsName_th')
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Username</th>
    <th>Email</th>
    <th>Specialité</th>
    <th>Role</th>
    <th></th>
@endsection

@section('TableBodyList_tr')
    @foreach($doctors as $doctor)
        <tr>
            <td>{{ $doctor->id }}</td>
            <td>
                <p class="text-dark">{{ $doctor->last_name }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $doctor->first_name }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $doctor->username }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $doctor->email }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $doctor->specialty }}</p>
            </td>
            <td>
                @if($doctor->is_admin)
                    <span class="badge badge-success">Admin</span>
                @else
                    <span class="badge badge-secondary">Docteur</span>
                @endif
            </td>
            <td class="text-right">
                <div class="dropdown show d-inline-block widget-dropdown">
                    <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                        <li class="dropdown-item">
                            <a
                                href="{{ route('doctor.edit', ['doctor' =>$doctor->id]) }}">
                                <i class="mdi mdi-square-edit-outline mr-1"></i>
                                Modifier
                            </a>
                        </li>
                        <li class="dropdown-item">
                            @if( Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->id!=$doctor->id)
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('{{ 'destroy-form-'.$doctor->id }}').submit();">
                                    <i class="mdi mdi-delete mr-1"></i>
                                    Supprimer
                                </a>
                                <form id="{{ 'destroy-form-'.$doctor->id }}"
                                    action="{{ route('doctor.destroy',['doctor'=>$doctor->id]) }}"
                                    method="POST" class="d-none">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
@endsection
