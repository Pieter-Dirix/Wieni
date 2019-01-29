@extends('layouts.admin')

@section('content')

    <div class="container">

        @include('partials.error')

        <form action="{{ route('trainingcreate') }}" method="post">
            <div class="form-group">
                <label for="datum">datum</label>
                <input type="date" class="form-control" id="datum" name="datum">
            </div>

            <div class="form-group">
                <label for="beschrijving">beschrijving</label>
                <input type="text" class="form-control" id="beschrijving" name="beschrijving">
            </div>

            <div class="form-group">
                <label for="beginEindUur">Begin- en einduur</label>
                <input type="text" class="form-control" id="beginEindUur" name="beginEindUur">
            </div>
            <!-- Laadt alle mogelijke groepn in als optie -->
            @foreach($groeps as $groep)
                <div class="checkbox">
                    <label for="">
                        <input type="checkbox"
                               name="groeps[]"
                               value="{{$groep->id}}"
                        > {{ $groep->naam }}
                    </label>
                </div>
            @endforeach
        <!-- Laadt alle mogelijke trainers in als optie -->
            @foreach($trainers as $trainer)
                <div class="radio">
                    <label for="">
                        <input type="radio"
                               name="trainers[]"
                               value="{{$trainer->id}}"
                        > {{ $trainer->naam }}
                    </label>
                </div>
            @endforeach
            @csrf
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>

@endsection