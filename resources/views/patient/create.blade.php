@extends('layouts.templates.create',[
'part_name'=>'Ajouter Patient','action_name'=>'Créer Patient','store_route_name'=>'patient.store']
)

@section('CreateFormElements')
    <div class="col-sm-6">
        <div class="form-group">
            <input name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Nom">
        </div>
        @error('last_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <input name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="Prénom">
        </div>
        @error('first_name')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="social_security_number" type="text" class="form-control @error('social_security_number') is-invalid @enderror" value="{{ old('social_security_number') }}" placeholder="N° de sécurité sociale">
        </div>
        @error('social_security_number')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" placeholder="Date de naissance">
        </div>
        @error('birth_date')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="+213-X XX XX XX XX">
        </div>
        @error('phone_number')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Adresse">
        </div>
        @error('address')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email">
        </div>
        @error('email')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <textarea name="chronic_diseases" rows="3" class="form-control @error('chronic_diseases') is-invalid @enderror" value="{{ old('chronic_diseases') }}" placeholder="Maladies Chroniques"></textarea>
            {{-- <input name="chronic_diseases" type="text" class="form-control @error('chronic_diseases') is-invalid @enderror" value="{{ old('chronic_diseases') }}" placeholder="Maladies Chroniques"> --}}
        </div>
        @error('chronic_diseases')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <textarea name="allergies" rows="3" class="form-control @error('allergies') is-invalid @enderror" value="{{ old('allergies') }}" placeholder="Allergies"></textarea>
            {{-- <input name="allergies" type="text" class="form-control @error('allergies') is-invalid @enderror" value="{{ old('allergies') }}" placeholder="Allergies"> --}}
        </div>
        @error('allergies')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
        <textarea name="antecedents" rows="3" class="form-control @error('antecedents') is-invalid @enderror" value="{{ old('antecedents') }}" placeholder="Antécédents"></textarea>
            {{-- <input name="antecedents" type="text" class="form-control @error('antecedents') is-invalid @enderror" value="{{ old('antecedents') }}" placeholder="Antécédents"> --}}
        </div>
        @error('antecedents')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="form-group">
        <textarea name="comments" rows="3" class="form-control @error('comments') is-invalid @enderror" value="{{ old('comments') }}" placeholder="Commentaires"></textarea>
            {{-- <input name="comments" type="text" class="form-control @error('comments') is-invalid @enderror" value="{{ old('comments') }}" placeholder="Commentaires"> --}}
        </div>
        @error('comments')
            <div class="alert alert-danger alert-highlighted">{{ $message }}</div>
        @enderror
    </div>
@endsection
