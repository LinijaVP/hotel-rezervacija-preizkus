@extends('layouts.app')

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .edit-button {
            background-color: #444543;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top:10px;
            padding: 12px 12px;

        }

        .error {
            color: red;
            display: inline;
            margin-left: 10px;
        }
        
        .is-invalid {
            border: 2px solid red;
            border-radius: 2px;
        }
        select {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }

        input[type=text], input[type=date] {
            width: 100%;
            padding: 10px 10px;
            margin-bottom:10px;
            margin-top:2px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .card-body{
            font-size: 17px;
            font-weight: bold;
            background-color: #ffffff;
            background-image: radial-gradient(#e7e7e7 1px, #ffffff 1px);
            background-size: 26px 26px;
        }

    </style>
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style={{"margin-bottom:10px"}}>
                    <div class="card-header" style={{"margin-bottom:0px"}}>
                        <h3>Rezervirajte sobo: </h3>
                    </div>
                    <div class="card-body">
                        <script src="https://www.google.com/recaptcha/api.js"></script>
                        <form id="reserve-form" action="{{route('reserve.form')}}" method="POST" >
                            @csrf
                    
                            <label for="name">Ime in priimek: </label>
                            <input type="text" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror"/>
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                    
                            <label for="email">Email: </label>
                            <input type="text" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror"/>
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                    
                            <label for="telephone">Telefonska številka: </label>
                            <input type="text" name="telephone" value="{{ old('telephone') }}" class="@error('telephone') is-invalid @enderror"/>
                            @error('telephone')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                        
                            <label for="arrival_date">Dan prihoda: </label>
                            <input id="arrival_date" type="date" name="arrival_date" value="{{ old('arrival_date') }}" class="@error('arrival_date') is-invalid @enderror"/>
                            @error('arrival_date')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                    
                            <label for="departure_date">Dan odhoda: </label>
                            <input id="departure_date" type="date" name="departure_date" value="{{ old('departure_date') }}" class="@error('departure_date') is-invalid @enderror"/>
                            @error('departure_date')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                    
                            <label for="room_id">Izberi sobo:</label>
                            <select id="rooms" name="room_id" value="{{ old('room_id') }}" class="@error('room_id') is-invalid @enderror">
                                @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }} - {{$room->price_per_night}}€ na noč</option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                    
                            <label for="extras">Opombe: </label>
                            <input type="text" name="extras" value="{{ old('extras') }}" class="@error('extras') is-invalid @enderror"/>
                            @error('extras')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <br> 
                            
                            <button class="g-recaptcha edit-button" 
                                data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}" 
                                data-callback='onSubmit' 
                                data-action='submit'    
                                type="submit">Pošlji</button>   
                        </form>
                        Skupna cena: <span id="total-price">0</span>€<br/>
                    
                        @if($errors->has("g-recaptcha-response"))
                            <span class=error>The reCAPTCHA is not valid.</span>
                        @endif

                        <script>
                            function updatePrice() {
                                var arrivalDate = $('#arrival_date').val();
                                var departureDate = $('#departure_date').val();
                                var roomId = $('#rooms').val();
                    
                                $.ajax({
                                    url: '{{ url('/reserve-price') }}', 
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        arrival_date: arrivalDate,
                                        departure_date: departureDate,
                                        room_id: roomId
                                    },
                                    success: function(response) {
                                        $('#total-price').text(response.price);
                                    },
                                    error: function(xhr, status, error) {
                                        $('#total-price').text('Error');
                                        console.error(xhr.responseText);
                                    }
                                });
                            }
                    
                            //Event listener
                            $('#arrival_date, #departure_date, #rooms').on('change', function() {
                                updatePrice();
                            });
                    
                            //Price is still there after redirect
                            $(document).ready(function() {
                                updatePrice();
                            });
                    
                            function onSubmit(token) {
                                document.getElementById("reserve-form").submit();
                            }
                    
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection