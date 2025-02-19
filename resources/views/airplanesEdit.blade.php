@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Edit Plane') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('planesEdit', $airplane->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{$airplane->name}}" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="max_places" class="col-md-4 col-form-label text-md-end">{{ __('Max Places') }}</label>

                            <div class="col-md-6">
                                <input id="max_places" type="number" min="0" class="form-control @error('max_places') is-invalid @enderror" name="max_places" placeholder="{{$airplane->max_places}}" value="{{ old('max_places') }}" required autocomplete="max_places" autofocus>

                                @error('max_places')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="text-center">
                                <a href="{{route('planes')}}" class="btn btn-primary mx-1">{{__('Cancel')}}</a>
                                <button type="submit" class="btn btn-primary mx-1">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
