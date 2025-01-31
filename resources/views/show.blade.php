@extends ("layouts.app2")

@section ("content")
    <section class="banner bannerShow">
        <div class="bannerContent">
            <h2 class="bannerTitle">Details</h2>
        </div>
    </section>
    <div class="container">
        <div class="flight">
            <div class="flightContent">
                <img class="flightImage" src="{{$flight->image}}" alt="{{$flight->arrival}}">
            </div>
            <div class="flightContent">
                <h3 class="flightArrival">{{$flight->arrival}}</h3>
                <div class="flightDetails">
                    <div class="flightDetail">
                        <h4 class="flightElement">Date:</h4>
                        <p class="flightDescription flightDate">{{$flight->date}}</p>
                    </div>
                    <div class="flightDetail">
                        <h4 class="flightElement">Departure:</h4>
                        <p class="flightDescription flightDeparture">{{$flight->departure}}</p>
                    </div>
                </div>
                <div class="flightDetails">
                    <div class="flightDetail">
                        <h4 class="flightElement">Plane:</h4>
                        <p class="flightDescription flightName">{{$flight->airplane->name}}</p>
                    </div>
                    <div class="flightDetail">
                        <h4 class="flightElement">Available Places:</h4>
                        <p class="flightDescription flightplaces">{{$flight->airplane->places}}</p>
                    </div>
                </div>
                <div class="flightDetails">
                    @guest
                        <p class="flightWarning notSigned">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="#fff311"  
                                class="icon icon-tabler icons-tabler-filled icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" 
                                fill="none"/><path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 
                                4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 
                                -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 
                                1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 
                                -.883z" />
                            </svg>
                            You must be signed to book this flight.
                        </p>
                    @else
                        @if (!$flight->status || (!$isBooked && $flight->airplane->places === 0))
                            <p class="flightWarning notAvailable">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                stroke="#ff2b2b"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle"><path stroke="none" d="M0 0h24v24H0z" 
                                fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 
                                1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" />
                                </svg>
                                This Flight is not available.
                            </p>
                        @elseif ($isBooked)
                            <a class="flightButton book" href="?action=debook">Cancel Booking</a>
                        @else
                            <a class="flightButton debook" href="?action=book">Book Flight</a>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
