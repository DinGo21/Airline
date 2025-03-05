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
	<div class="d-flex justify-content-center flex-wrap my-2">
        @foreach ($flights as $flight)
            <div class="card m-2" style="width: 18rem;">
                <img src="{{asset('img/show.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="fs-3 card-title mb-4">{{$flight->arrival}}</h5>
                    <p class="card-text fs-5">{{$flight->date}}</p>
                    <a href="{{route('show', $flight->id)}}" class="btn btn-primary">See Details</a>
                </div>
            </div>
        @endforeach
	</div>
@endsection
