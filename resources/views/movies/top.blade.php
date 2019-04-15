@extends('layouts.app')

@section('content')
   <h2>Filmy seřazené podle hodnocení</h2>

   <div class="list-group">
        @for ($i = 0; $i < count($movies); $i++)
            {{link_to_route('movies.show', ($i + 1) . '. - ' . $movies[$i]->name . ' - Hodnocení: ' . $movies[$i]->averageRating(), $parameters = array('id' => $movies[$i]->id), $attributes = array('class' => 'list-group-item d-flex justify-content-between align-items-center'))}}
        @endfor
    </div>
@endsection