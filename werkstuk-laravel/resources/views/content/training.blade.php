@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="jumbotron">

            <h2> Training </h2>
            <p>Groep:
            @foreach($training->groeps as $groep)
                    <a href="{{ route('groep', ['id' => $groep->id ]) }}"> {{ $groep->naam }} </a>
            @endforeach
            </p>
            <p>{{ $training->datum }}</p>
            <p>{{$training->beginEindUur}}</p>
            <p>{{$training->beschrijving}}</p>
           <p>Trainer:<a href="{{ route('trainer', ['id' => $training->trainer->id ]) }}"> {{$training->trainer->naam}}</a></p>
            <hr>
        </div>



    </div>

@endsection