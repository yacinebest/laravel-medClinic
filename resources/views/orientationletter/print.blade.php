@extends('layouts.templates.print',['clinic'=>$clinic,'doctor'=>$orientationLetter->doctor,'patient'=>$orientationLetter->patient,'type'=> 'Lettres d\'Orientation' ])

@section('printContent')

<label for="">Date :</label>
<label for="">{{ $orientationLetter->date }}</label>
<br>
<br>

<p>{!! $orientationLetter->content !!}</p>


@endsection
