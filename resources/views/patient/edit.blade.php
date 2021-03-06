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
                <label>Maladies Chroniques</label>
                <textarea class="ckeditor form-control @error('chronic_diseases') is-invalid @enderror" name="chronic_diseases" placeholder="Maladies Chroniques">{{  $patient->chronic_diseases }}</textarea>
            </div>
            @error('chronic_diseases')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Allergies</label>
                <textarea class="ckeditor form-control @error('allergies') is-invalid @enderror" name="allergies" placeholder="Allergies">{{  $patient->allergies }}</textarea>
            </div>
            @error('allergies')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Antécédents</label>
                <textarea class="ckeditor form-control @error('antecedents') is-invalid @enderror" name="antecedents" placeholder="Antécédents">{{  $patient->antecedents }}</textarea>
            </div>
            @error('antecedents')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Commentaires</label>
                <textarea class="ckeditor form-control @error('comments') is-invalid @enderror" name="comments" placeholder="Commentaires">{{  $patient->comments }}</textarea>
            </div>
            @error('comments')
                <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
            @enderror
        </div>
    @endif
@endsection
