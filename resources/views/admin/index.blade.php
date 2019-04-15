@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin centrum</div>
                <div class="card-body">
                    <div class="list-group">
                        {{link_to_route('movies.create', 'Přidat film', $parameters = array(), $attributes = array('class' => 'list-group-item list-group-item-action'))}}
                        {{link_to_route('movieCategories.create', 'Přidat žánr', $parameters = array(), $attributes = array('class' => 'list-group-item list-group-item-action'))}}
                    </div>
                    <small>Upravit či smazat film nebo recenzi můžete přímo na stránce detailu filmu.</small>

                    <br/>
                    <br/>
                    <h5>Upravit žánr</h5>

                    <div class="list-group">
                        @foreach ($categories as $category)
                            {{link_to_route('movieCategories.edit', $category->name, $parameters = array('id' => $category->id), $attributes = array('class' => 'list-group-item list-group-item-action'))}}
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection