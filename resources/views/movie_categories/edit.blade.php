@extends('layouts.app')

@section('content')
    <h2>Upravit kategorii {{$category->name}}</h2>

    {!! Form::open(['action' => ['MovieCategoriesController@destroy', $category->id], 'method' => 'POST', 'class' => 'float-right']) !!}
        {!! Form::hidden('_method', 'DELETE') !!}
        {!! Form::submit('Smazat', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <br/>

    {!! Form::open(['action' => ['MovieCategoriesController@update', $category->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Název kategorie'])}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Uložit změny', ['class' => 'btn btn-primary'], null, ['class' => 'form-control'])}}
    {!! Form::close() !!}
@endsection