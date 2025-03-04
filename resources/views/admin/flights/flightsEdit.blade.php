@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Edit Flight') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('flightsEdit', $flight->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="{{$flight->date}}" value="{{ old('date') }}" required autocomplete="date" autofocus>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="departure" class="col-md-4 col-form-label text-md-end">{{ __('Departure') }}</label>

                            <div class="col-md-6">
                                <input id="departure" type="text" class="form-control @error('departure') is-invalid @enderror" name="departure" placeholder="{{$flight->departure}}" value="{{ old('departure') }}" required autocomplete="departure" autofocus>

                                @error('departure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="arrival" class="col-md-4 col-form-label text-md-end">{{ __('Arrival') }}</label>

                            <div class="col-md-6">
                                <input id="arrival" type="text" class="form-control @error('arrival') is-invalid @enderror" name="arrival" placeholder="{{$flight->arrival}}" value="{{ old('arrival') }}" required autocomplete="arrival" autofocus>

                                @error('arrival')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image URL') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="text" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="{{$flight->image}}" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="airplane" class="col-md-4 col-form-label text-md-end">{{ __('Airplane') }}</label>

                            <div class="col-md-6">
                                <select name="airplane" id="airplane" class="form-select" required>
                                    <option selected>Choose a plane</option>
                                    @foreach ($airplanes as $airplane)
                                        <option value="{{$airplane->id}}">{{$airplane->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select name="status" id="status" class="form-select" required>
                                    <option value="1">{{__('Available')}}</option>
                                    <option value="0">{{__('Not Available')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="text-center">
                                <a href="{{route('flights')}}" class="btn btn-primary mx-1">{{__('Cancel')}}</a>
                                <button type="submit" class="btn btn-primary mx-1">
                                    {{ __('Add') }}
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
