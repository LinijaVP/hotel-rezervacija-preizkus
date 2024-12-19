@extends('layouts.app')

@section('content')
    <style>

        .error {
            color: red;
            display: inline;
            margin-left: 10px;
        }
            
        .is-invalid {
            border: 2px solid red;
            border-radius: 2px;
        }

        .edit-button {
            background-color: #444543;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top:10px;
        }

        .long-input {
            width: 80%;
            overflow:scroll;
            margin-bottom:6px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style={{"margin-bottom:10px"}}>
                    <div class="card-header" style={{"margin-bottom:0px"}}>
                        <h3>Spremeni podatke sobe: <b>{{$room->name}}</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                    
                            <label for="name"><b>Ime: </b></label>
                            <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror" value="{{ old('name', $room->name) }}">
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br>

                            <label for="price_per_night"><b>Cena na noč: </b></label>
                            <input type="number" name="price_per_night" id="price_per_night" class="@error('price_per_night') is-invalid @enderror" value="{{ old('price_per_night', $room->price_per_night) }}">
                            @error('price_per_night')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br>

                            <label for="short_description"><b>Kratek opis: </b></label>
                            <input type="text" name="short_description" id="short_description" class="@error('short_description') is-invalid @enderror long-input" value="{{ old('short_description', $room->short_description) }}">
                            @error('short_description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br>
                    
                            <label for="long_description"><b>Dolg opis: </b></label>
                            <input type="text" name="long_description" id="long_description" class="@error('long_description') is-invalid @enderror long-input" value="{{ old('long_description', $room->long_description) }}">
                            @error('long_description')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br>
                    
                            <button class="edit-button" type="submit">Shrani spremembe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
