@extends('layouts.master')
@section('gcurrent')

   active
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>Groepen</h2>
                @foreach($groeps as $groep)
                    <div class="jumbotron">
                        <p><b>{{ $groep->naam }}</b></p>
                        <p>{{ $groep->beschrijving }}</p>
                        <a href="{{route('groep', ['id' => $groep['id']]) }}">Detail</a>
                    </div>
                @endforeach

                <hr>
            </div>

            <div class="col-6">
                <h2>Trainers</h2>
                @foreach($trainers as $trainer)
                    <div class="jumbotron">
                        <p><b>{{ $trainer->naam }}</b></p>
                        <p>{{ $trainer->ervaring }}</p>
                        <a href="{{route('trainer', ['id' => $trainer['id']]) }}">Detail</a>
                    </div>
                @endforeach

                <hr>
            </div>
        </div>
    </div>


@endsection