@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">

            <h2>Seznam filmů</h2>

            @if (count($movies) > 0)
                @foreach($movies->chunk(3) as $chunk)
                    <div class="row">
                        @foreach($chunk as $movie)
                            <div class="col-md-4">
                                <div class="card mb-3 card-movie redirector" data-url="{{route('movies.show', array('id' => $movie['id']))}}">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="/mdb/public/storage/cover_images/{{$movie['cover_image']}}" class="card-img" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{link_to_route('movies.show', $movie['name'], $parameters = array('id' => $movie['id']), $attributes = array())}}</h5>
                                                <h6>Hodnocení: <span class="text-muted">{{$movie->averageRating()}}</span></h6>
                                                <h6>Režie: <span class="text-muted">{{$movie->director}}</span></h6>
                                                <h6>Scénář: <span class="text-muted">{{$movie->writer}}</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <p>Žádné filmy k zobrazení.</p>
            @endif
        </div>

        <div class="col-md-3">
            <h2>Kategorie filmů</h2>

            <ul class="list-group">
                @if (count($categories) > 0)
                    @foreach ($categories as $category)
                        {{link_to_route('movies.index', $category->name, $parameters = array('categoryId' => $category->id), $attributes = array('class' => 'list-group-item list-group-item-action'))}}
                    @endforeach
                @else
                    <p>Žádné kategorie filmů k zobrazení.</p>
                @endif
            </ul>
        </div>
    </div>

    <script type="text/javascript">

    </script>
@endsection