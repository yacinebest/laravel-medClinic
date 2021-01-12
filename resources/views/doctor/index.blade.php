@extends('layouts.master')
@section('mainContent')
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>Liste des médecins</h2>
                        <a role="button" class="btn btn-lg btn-info" href="{{ route('doctor.create') }}">
                            <i class="mdi mdi-account-plus mr-1">
                            </i>
                            Ajouter
                        </a>
                        {{-- <div class="date-range-report ">
                            <span></span>
                        </div> --}}
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Specialité</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                <li class="dropdown-item">
                                                    <a href="{{ route('doctor.edit', ['doctor' =>$doctor->id]) }}">Modifier</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('destroy-form').submit();">Supprimer</a>
                                                    <form id="destroy-form" action="{{ route('doctor.destroy',['doctor'=>$doctor->id]) }}" method="POST" class="d-none">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $doctors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
