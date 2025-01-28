@extends ("layouts.app2")

@section ("content")
    <div class="container">
        <h2>Details</h2>
        <div>
            <img src="{{$flight->image}}" alt="{{$flight->arrival}}">
            <p>{{$flight->date}}</p>
            <p>{{$flight->departure}}</p>
            <p>{{$flight->arrival}}</p>
            <p>{{$flight->date}}</p>
            <p>{{$flight->airplane->name}}</p>
            <p>{{$flight->airplane->places}}</p>
            @guest
                <p>You must be signed to book this flight.</p>
            @else
                <p>Book</p>
            @endguest
        </div>
    </div>
@endsection
