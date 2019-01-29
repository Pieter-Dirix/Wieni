@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="jumbotron">

            <h2> {{ $groep->naam }} </h2>
            <p>{{ $groep->beschrijving }}}</p>

            <h3>Trainingen</h3>
            @foreach($groep->trainings as $training)
                <div class="row">
                    <div class="col-10">
                        {{ $training->datum }}
                    </div>
                    <div class="col2">
                            <a href="{{ route('training', ['id' => $training->id]) }}" class="btn">detail</a>
                    </div>
                </div>
            @endforeach
            <hr>
        </div>



    </div>

@endsection