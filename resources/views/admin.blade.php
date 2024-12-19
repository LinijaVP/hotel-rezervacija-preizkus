@extends('layouts.app')

@section('content')
    <style>
        .edit-button{
            background-color: #444543;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top:10px;
        }
        
        .card-body{
            font-size: 16px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($rooms as $room)
                <div class="card" style={{"margin-bottom:10px"}}>
                    <div class="card-header"><h4><b>{{$room->name}}</b></h4></div>
                    <div class="card-body">
                        <b>Cena na noč: </b>{{$room->price_per_night}}<br>
                        <b>Kratek opis: </b>{{$room->short_description}}<br>
                        <b>Dolg opis: </b>{{$room->long_description}} <br>
                        <button class="edit-button" onclick="window.location='{{ route('rooms.edit', $room->id) }}'">Edit</button>
                    </div>
                </div>
                @endforeach            
            </div>
        </div>
    </div>
@endsection

