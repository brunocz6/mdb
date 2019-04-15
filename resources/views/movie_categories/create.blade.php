@extends('layouts.app')

@section('content')
    <h2>Přidat kategorii</h2>

    {!! Form::open(['action' => 'MovieCategoriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Název kategorie'])}}
        </div>

        {{Form::submit('Přidat kategorii', ['class' => 'btn btn-primary'], null, ['class' => 'form-control'])}}
    {!! Form::close() !!}
@endsection