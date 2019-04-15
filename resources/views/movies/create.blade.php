@extends('layouts.app')

@section('content')
    <h2>Přidat film</h2>

    {!! Form::open(['action' => 'MoviesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Název')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Název filmu'])}}
        </div>

        <div class="form-group">
            {{Form::label('director', 'Režisér')}}
            {{Form::text('director', '', ['class' => 'form-control', 'placeholder' => 'Režisér nebo režisérové filmu'])}}
        </div>

        <div class="form-group">
            {{Form::label('writer', 'Scénář')}}
            {{Form::text('writer', '', ['class' => 'form-control', 'placeholder' => 'Scénárista či scénáristi filmu'])}}
        </div>

        <div class="form-group">
            {{Form::label('released_at', 'Datum vydání')}}
            {{Form::date('released_at', '', ['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('description', 'Popisek')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Popisek filmu'])}}
        </div>

        <div class="form-group">
                {{Form::label('cover_image', 'Náhledový obrázek')}}
                {{Form::file('cover_image')}}
        </div>

        <div class="form-group">
                {{Form::label('category_id', 'Kategorie')}}
                {{Form::select('category_id', $categories, null, ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Přidat film', ['class' => 'btn btn-primary'], null, ['class' => 'form-control'])}}
    {!! Form::close() !!}
@endsection