@extends('layouts.app')

@section('content')
    <h2>Upravit film {{$movie->name}}</h2>

    {!! Form::open(['action' => ['MoviesController@destroy', $movie->id], 'method' => 'POST', 'class' => 'float-right']) !!}
        {!! Form::hidden('_method', 'DELETE') !!}
        {!! Form::submit('Smazat', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <br/>

    {!! Form::open(['action' => ['MoviesController@update', $movie->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', $movie->name, ['class' => 'form-control', 'placeholder' => 'Název filmu'])}}
        </div>

        <div class="form-group">
            {{Form::label('director', 'Režisér')}}
            {{Form::text('director', $movie->director, ['class' => 'form-control', 'placeholder' => 'Režisér nebo režisérové filmu'])}}
        </div>

        <div class="form-group">
            {{Form::label('writer', 'Scénář')}}
            {{Form::text('writer', $movie->writer, ['class' => 'form-control', 'placeholder' => 'Scénárista či scénáristi filmu'])}}
        </div>

        <div class="form-group">
            {{Form::label('released_at', 'Datum vydání')}}
            {{Form::date('released_at', $movie->released_at, ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
                {{Form::label('description', 'Popisek')}}
                {{Form::textarea('description', $movie->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Popisek filmu'])}}
        </div>

        <div class="form-group">
                {{Form::label('category_id', 'Kategorie')}}
                {{Form::select('category_id', $categories, $movie->movie_category, ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
                {{Form::label('cover_image', 'Náhledový obrázek')}}
                {{Form::file('cover_image')}}
        </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Uložit změny', ['class' => 'btn btn-primary'], null, ['class' => 'form-control'])}}
    {!! Form::close() !!}
@endsection