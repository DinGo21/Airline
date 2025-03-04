@extends("layouts.app2")

@section("content")
    <section class="bannerBookings mb-4">
        <div class="container d-flex flex-column justify-content-center" style="height: 12rem;">
            <h2 class="bookingsTitle text-center text-white">{{$user->name}}'s Bookings</h2>
        </div>
    </section>
    <div class="container w-75">
        @foreach ($user->flights as $flight)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{asset('img/show.jpg')}}" class="img-fluid rounded" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{$flight->arrival}}</h5>
                            <div class="row">
                                <div class="col">
                                    <h4 class="fs-5 text-decoration-underline">Departure:</h4>
                                    <p>{{$flight->departure}}</p>
                                </div>
                                <div class="col">
                                    <h4 class="fs-5 text-decoration-underline">Date:</h4>
                                    <p>{{$flight->date}}</p>
                                </div>
                                <div class="col">
                                    <h4 class="fs-5 text-decoration-underline">Plane:</h4>
                                    <p>{{$flight->airplane->name}}</p>
                                </div>
                            </div>
                            <a href="{{route('show', $flight->id)}}" class="btn btn-primary">Details</a>
                            @if ($flight->status)
                                <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cancel
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
                                                <a href="{{route('userBookings', ['action' => 'debook', 'id' => $flight->id])}}" class="btn btn-primary">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
