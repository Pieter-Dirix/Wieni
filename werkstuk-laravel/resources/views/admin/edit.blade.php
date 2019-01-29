@extends('layouts.admin')

@section('content')

    <div class="container">

        <form action="{{ route('trainingedit') }}" method="post">
            <div class="form-group">
                <label for="datum">datum</label>
                <input type="date" class="form-control" id="datum" name="datum" value="{{ $training->datum }}">
            </div>

            <div class="form-group">
                <label for="beschrijving">beschrijving</label>
                <input type="text" class="form-control" id="beschrijving" name="beschrijving" value="{{ $training->beschrijving }}">
            </div>

            <div class="form-group">
                <label for="beginEindUur">Begin- en einduur</label>
                <input type="text" class="form-control" id="beginEindUur" name="beginEindUur" value="{{ $training->beginEindUur }}">
            </div>
            <!-- Laadt alle mogelijke groepn in als optie -->
            @foreach($groeps as $groep)
                <div class="checkbox">
                    <label for="">
                        <input type="checkbox"
                                name="groeps[]"
                                value="{{$groep->id}}"
                               {{$training->groeps->contains($groep->id) ? 'checked' : ''}}
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
                                {{$training->trainer_id == $trainer->id ? 'checked' : ''}}
                        > {{ $trainer->naam }}
                    </label>
                </div>
            @endforeach
            @csrf
            <input type="hidden" name="id" value="{{ $training->id }}">
            <button type="submit" class="btn btn-primary">Aanpassen</button>
        </form>
    </div>

@endsection