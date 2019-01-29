@extends('layouts.admin')

@section('content')

    <div class="container">
        <!--controle op sessie data -->
        @if(session('forminput'))
        <div class="alert alert-success" role="alert">
            {{ session('forminput') }}
        </div>
        @endif

        <a class="btn btn-primary" href="{{route('admin.create') }}">create</a>
        <hr>

        <!-- Haalt alle trainingen op met zijn attributen -->
        @foreach($trainings as $training)
        <div class="row">
            <h2 class="col-2">{{ $training->datum }}</h2>
            <p class="col-2">Groep:
            @foreach($training->groeps as $groep)
               {{ $groep->naam }}
                @endforeach
            </p>

            <p class="col-2">Begin/Einduur: {{ $training->beginEindUur }}</p>
            <p class="col-2">Besch.: {{ $training->beschrijving }}</p>
            @if($training->trainer)
            <p class="col-2">Trainers:{{ $training->trainer->naam }}</p>
            @endif

            <a class="btn btn-info btn-xs col-1" href="{{route('admin.edit', ['id' => $training['id']]) }}">edit</a>
            <a class="btn btn-danger btn-xs col-1" href="{{route('admin.delete', ['id' => $training['id']]) }}">delete</a>
            <hr>
        </div>

            @endforeach
    </div>

@endsection