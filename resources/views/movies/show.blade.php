@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="card" style="height: 100%;">
                <div class="row">
                    <div class="col-md-5">
                        <img src="../storage/cover_images/{{$movie->cover_image}}" class="card-img">
                    </div>
                    <div class="col-md-7 px-3" style="padding: 20px;">
                        <div class="card-block px-3">
                            <h4 class="card-title">{{$movie->name}} <span class="badge badge-pill badge-dark">{{$movie->category->name}}</span></h4>
                            <h6>
                                Režie:
                                <small class="text-muted">{{$movie->director}}</small>
                            </h6>
                            <h6>
                                Scénář:
                                <small class="text-muted">{{$movie->writer}}</small>
                            </h6>
                            @if (Auth::check() && Auth::user()->isAdmin)
                                {!! Form::open(['action' => ['MoviesController@edit', $movie->id], 'method' => 'GET', 'style' => 'float-right']) !!}
                                    {!! Form::submit('Upravit', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                            <br/>
                            <h5>
                                O filmu:
                            </h5>
                            <p class="card-text">{!!$movie->description!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                        <div class="row">
                                <div class="col-xs-12 col-md-12 text-center">
                                    @if ($movie->averageRating() > 0)
                                        <h1> {{$movie->averageRating()}} </h1>
                                        <div>
                                            @for ($i = 0; $i < round($movie->averageRating()); $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor

                                            @for ($i = 0; $i < 5 - round($movie->averageRating()); $i++)
                                                <i class="far fa-star"></i>
                                            @endfor
                                        </div>
                                        <div>
                                            <i class="fas fa-user"></i> {{count($movie->movieRatings) . (count($movie->movieRatings) > 4 ? ' recenzí' : ' recenze')}}
                                        </div>
                                    @else
                                        Dosud nebyly přidány žádné recenze.
                                    @endif
                                </div>
                            </div>
                </div>
            </div>
            <div class="card" style="margin-top: 5px;">
                <div class="card-body">
                    @if (Auth::check())
                        {!! Form::open(['action' => 'MovieRatingsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{Form::label('title', 'Nadpis')}}
                                {{Form::text('title', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Nadpis recenze'])}}
                            </div>

                            <div class="form-group">
                                {{Form::label('body', 'Text')}}
                                {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Text recenze', 'rows' => '8'])}}
                            </div>
                            

                            <div class="form-group rating">
                                    <label>
                                            {{ Form::radio('stars', '1' , true) }}
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            {{ Form::radio('stars', '2' , false) }}
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            {{ Form::radio('stars', '3' , false) }}
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>   
                                        </label>
                                        <label>
                                            {{ Form::radio('stars', '4' , false) }}
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            {{ Form::radio('stars', '5' , false) }}
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                            </div>


                            {{Form::hidden('movie_id', $movie->id, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Text recenze'])}}

                            {!! Form::submit('Přidat recenzi', ['class' => 'btn btn-secondary']) !!}
                        {!! Form::close() !!}
                    @else
                        <h6>Pro možnost přidání recenze se přihlašte.</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($movie->averageRating() > 0)
        <h2>Recenze uživatelů</h2>

        <div class="row">
            <div class="col-md-8">
                @foreach ($movie->movieRatings as $movieRating)
                    <div class="card" style="margin-bottom: 5px;">
                        <div class="card-body">

                            @if (Auth::check() && Auth::user()->isAdmin)
                                {!! Form::open(['action' => ['MovieRatingsController@destroy', $movieRating->id], 'method' => 'POST', 'class' => 'float-right']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Smazat', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif

                            <h5>
                                {{$movieRating->author()->name}}
                                <small class="text-muted">{{$movieRating->created_at}}</small> 
                                <span class="badge badge-pill badge-dark">Počet hvězd: {{$movieRating->stars}}</span>
                            </h5>
                            <br/>
                            <h5>{{$movieRating->title}}</h5>
                            <p>{{$movieRating->body}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection