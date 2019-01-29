@extends('layouts.master')
@section('vcurrent')

    active
@endsection
@section('content')
    <div class="container">
        @if(count($trainings) > 0)
        @foreach($trainings as $training)

            <div class="jumbotron">

                @foreach($training->groeps as $groep)
                    <h2>{{ $groep->naam }}</h2>
                @endforeach
                <p>{{ $training['groep'] }}</p>
                <p>{{ $training['datum'] }}</p>
                <p>{{ $training['beginEindUur'] }}</p>
                <P>Trainers: {{ $training->trainer->naam}}</P>
                <a href="{{route('training', ['id' => $training['id']]) }}">Detail</a>
                <hr>
            </div>
        @endforeach
        @else
        <h2>Geen voorbije trainingen</h2>
        @endif

    </div>

@endsection