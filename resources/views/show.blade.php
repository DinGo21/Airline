@extends ("layouts.app2")

@section ("content")
    <section class="bannerShow mb-4">
        <div class="container d-flex flex-column justify-content-center" style="height: 15rem;">
            <h2 class="text-center text-white p-2 fs-1">Details</h2>
        </div>
    </section>
    <div class="container-sm d-flex justify-content-center">
        <div class="card mb-3 w-75" style>
            <img src="{{asset('img/show2.jpg')}}" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
                <h3 class="card-title fs-2 text-center mb-3">{{$flight->arrival}}</h5>
                <div class="row text-center">
                    <div class="col">
                        <h4 class="fs-5 text-decoration-underline">Departure:</h4>
                        <p>{{$flight->departure}}</p>
                    </div>
                    <div class="col">
                        <h4 class="fs-5 text-decoration-underline">Date:</h4>
                        <p>{{$flight->date}}</p>
                    </div>
                    <div class="col">
                        <h4 class="fs-5 text-decoration-underline">Available Places:</h4>
                        <p>{{$flight->available_places}}</p>
                    </div>
                    <div class="col">
                        <h4 class="fs-5 text-decoration-underline">Plane:</h4>
                        <p>{{$flight->airplane->name}}</p>
                    </div>
                </div>
                @guest
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle flex-shrink-0 me-2" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                    </svg>
                    <div>
                        You must be signed to book this flight.
                    </div>
                </div>
                @else
                    @if (!Auth::user()->admin)
                        @if (!$flight->status || ($flight->available_places === 0 && !$isBooked))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle flex-shrink-0 me-2" viewBox="0 0 16 16">
                                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                </svg>
                                <div>
                                    This flight is not available.
                                </div>
                            </div>
                        @elseif ($isBooked)
                            <div class="d-flex justify-content-center">
                                <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cancel Booking
                                </a>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5" id="exampleModalLabel">Cancel Booking</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <a href="?action=debook" class="btn btn-primary">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary" href="?action=book">Book Flight</a>
                            </div>
                        @endif
                    @endif
                @endguest
            </div>
        </div>
    </div>
@endsection
