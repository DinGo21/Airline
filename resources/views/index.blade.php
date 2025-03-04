@extends ("layouts.app2")

@section ("content")
    <section class="bannerIndex mb-4">
        <div class="container d-flex flex-column justify-content-center" style="height: 20rem;">
            <div class="d-flex justify-content-center">
                <h2 class="rounded bg-warning fs-1 fw-bold text-white p-2">Search What You Want</h2>
            </div>
            <input class="form-control p-2" type="text" id="input" placeholder="Search" aria-label="Search">
        </div>
    </section>
    <h3 class="fs-2 text-center">Book Now!</h3>
	<div class="d-flex justify-content-center flex-wrap my-2">
        @foreach ($flights as $flight)
            @if ($flight->id < 5)
                <div class="card m-2" style="width: 18rem;">
                    <img src="{{asset('img/show.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="fs-3 card-title mb-4">{{$flight->arrival}}</h5>
                        <p class="card-text fs-5">{{$flight->date}}</p>
                        <a href="{{route('show', $flight->id)}}" class="btn btn-primary">See Details</a>
                    </div>
                </div>
            @endif
        @endforeach
	</div>
@endsection
