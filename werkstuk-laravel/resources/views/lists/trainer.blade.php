@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="jumbotron">

            <h2> {{ $trainer->naam }} </h2>
            <p>{{ $trainer->ervaring }}}</p>

            <h3>Trainingen</h3>
            @foreach($trainer->trainings as $training)
                <div class="row">
                    <div class="col-5">
                        {{ $training->datum }}
                    </div>

                    <div class="col-5">
                        @foreach($training->groeps as $groep)
                            {{ $groep->naam }}
                        @endforeach
                    </div>
                    <div class="col-2">
                        <a href="{{ route('training', ['id' => $training->id]) }}" class="btn">detail</a>
                    </div>
                </div>
            @endforeach
            <hr>
        </div>



    </div>

@endsection