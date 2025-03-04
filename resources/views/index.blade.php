@extends ("layouts.app2")

@section ("content")
    <section class="bannerIndex mb-4">
        <div class="container d-flex flex-column justify-content-center" style="height: 20rem;">
            <input class="form-control p-2" type="text" id="input" placeholder="Search" aria-label="Search">
        </div>
    </section>
    <h3 class="fs-2 text-center">Book Now!</h3>
	<div class="d-flex justify-content-center flex-wrap my-2">
        @for ($i = 0; $i < 4; $i++)
            <div class="card m-2" style="width: 18rem;">
                <img src="{{asset('img/show.jpg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="fs-3 card-title mb-4">{{$flights[$i]->arrival}}</h5>
                    <p class="card-text text-decoration-underline fs-5">{{$flights[$i]->date}}</p>
                    <a href="{{route('show', $flights[$i]->id)}}" class="btn btn-primary">See Details</a>
                </div>
            </div>
        @endfor
	</div>
    <h3 class="fs-2 text-center">Explore</h3>
    <div id="carouselExampleCaptions" class="carousel slide container mb-3">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('img/carousel1.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/carousel2.jpg')}}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('img/carousel3.jpg')}}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
