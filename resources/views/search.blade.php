@extends ("layouts.app2")

@section ("content")
    <section class="bannerIndex mb-4">
        <div class="container d-flex flex-column justify-content-center" style="height: 20rem;">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('search') }}">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="departure" class="form-label">Departure:</label>
                                <input type="text" class="form-control" name="departure" value="" placeholder="Place for departure" autofocus>
                            </div>
                            <div class="col mb-3">
                                <label for="arrival" class="form-label">Arrival:</label>
                                <input type="text" class="form-control" name="arrival" value="" placeholder="Place for arrival" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="date" class="form-label">Date:</label>
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" autofocus>
                            </div>
                            <div class="col align-self-center">
                                <button type="submit" class="btn btn-warning w-100">
                                    {{ __('Search') }}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <h3 class="fs-2 text-center">Found Results:</h3>
	<div class="container">
        @foreach ($flights as $flight)
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
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($flights->isEmpty())
            <div class="alert alert-warning my-5 d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle flex-shrink-0 me-1" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                Sorry, we were unable to find any results.
            </div>
            <div class="d-flex justify-content-center mb-5">
                <a href="{{ route('index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Go back
                </a>
            </div>
        @endif
	</div>
@endsection
