@extends('layouts.templates.edit',[
'part_name'=>'Modifier Patient','update_route_name'=>'patient.update','entity_name'=>'patient','entity'=>$patient]
)

@section('UpdateFormElements')
    <div class="col-sm-6">
        <div class="form-group">
            <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ $patient->last_name }}" placeholder="Nom">
        </div>
        @error('last_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ $patient->first_name }}" placeholder="Prénom">
        </div>
        @error('first_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="social_security_number" type="text" class="form-control @error('social_security_number') is-invalid @enderror" value="{{ $patient->social_security_number }}" placeholder="N° de sécurité sociale">
        </div>
        @error('social_security_number')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ $patient->birth_date }}" placeholder="Date de naissance">
        </div>
        @error('birth_date')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $patient->phone_number }}" placeholder="+213-X XX XX XX XX">
        </div>
        @error('phone_number')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $patient->address }}" placeholder="Adresse">
        </div>
        @error('address')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $patient->email }}" placeholder="Email">
        </div>
        @error('email')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    @if(Auth::guard('doctor')->check())
        <div class="col-md-12">
            <div class="form-group">
                <textarea name="chronic_diseases" rows="3" class="form-control @error('chronic_diseases') is-invalid @enderror" value="{{ $patient->chronic_diseases }}" placeholder="Maladies Chroniques"></textarea>
            </div>
            @error('chronic_diseases')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <textarea name="allergies" rows="3" class="form-control @error('allergies') is-invalid @enderror" value="{{ $patient->allergies }}" placeholder="Allergies"></textarea>
            </div>
            @error('allergies')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
            <textarea name="antecedents" rows="3" class="form-control @error('antecedents') is-invalid @enderror" value="{{ $patient->antecedents }}" placeholder="Antécédents"></textarea>
            </div>
            @error('antecedents')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
            <textarea name="comments" rows="3" class="form-control @error('comments') is-invalid @enderror" value="{{ $patient->comments }}" placeholder="Commentaires"></textarea>
            </div>
            @error('comments')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
    @endif
@endsection
