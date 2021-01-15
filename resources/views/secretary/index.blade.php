@extends('layouts.templates.index',[
'list_name'=>'La secretaire','name_create_route'=>'secretary.create','entities'=>$secretaries]
)

@section('IndexSessionChangesDisplay')
    @if(Session::has('store_secretary'))
    @include('layouts.includes.form.alert.alert_success',['msg'=>Session::get('store_secretary')])
    @endif
    @if(Session::has('destroy_secretary'))
    @include('layouts.includes.form.alert.alert_warning',['msg'=>Session::get('destroy_secretary')])
    @endif
    @if(Session::has('update_secretary'))
    @include('layouts.includes.form.alert.alert_primary',['msg'=>Session::get('update_secretary')])
    @endif
@endsection

@section('TableColumnsName_th')
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Username</th>
    <th>Email</th>
    <th></th>
@endsection

@section('TableBodyList_tr')
    @foreach($secretaries as $secretary)
        <tr>
            <td>{{ $secretary->id }}</td>
            <td>
                <p class="text-dark">{{ $secretary->first_name }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $secretary->last_name }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $secretary->username }}</p>
            </td>
            <td>
                <p class="text-dark">{{ $secretary->email }}</p>
            </td>
            <td class="text-right">
                <div class="dropdown show d-inline-block widget-dropdown">
                    <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                        <li class="dropdown-item">
                            <a
                                href="{{ route('secretary.edit', ['secretary' =>$secretary->id]) }}">
                                <i class="mdi mdi-square-edit-outline mr-1"></i>
                                Modifier
                            </a>
                        </li>
                        <li class="dropdown-item">
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('{{ 'destroy-form-'.$secretary->id }}').submit();">
                                    <i class="mdi mdi-delete mr-1"></i>
                                    Supprimer
                                </a>
                                <form id="{{ 'destroy-form-'.$secretary->id }}"
                                    action="{{ route('secretary.destroy',['secretary'=>$secretary->id]) }}"
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
