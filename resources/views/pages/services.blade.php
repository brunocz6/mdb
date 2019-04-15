@extends('layouts.app')

@section('content')

<html lang="{{config('app.locale')}}">

        <h1>{{$title}}</h1>
        <p>je fakt zábavný zas umět hovno a sám doma v posteli brečet u programování</p>

        @if(count($services))
            <ul>
                @foreach ($services as $service)
                    <li>
                        {{$service}}
                    </li>
                @endforeach
            </ul>
        @endif
        
@endsection