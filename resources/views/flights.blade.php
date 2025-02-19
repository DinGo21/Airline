@extends("layouts.app")

@section("content")
<div class="container">
	<h2 class="text-center mb-3">Flights</h2>
	<div class="mb-2">
		<a href="{{route('flightsCreate')}}" class="btn btn-success">Add</a>
	</div>
	<table class="table table-hover">
		<thead class="table-light">
			<tr>
                <th scope="col">ID</th>
				<th scope="col">Date</th>
				<th scope="col">Departure</th>
				<th scope="col">Arrival</th>
				<th scope="col">Airplane</th>
				<th scope="col">Places</th>
				<th scope="col">Status</th>
				<th scope="col">Options</th>
			</tr>
		</thead>
		<tbody class="table-group-divider">
			@foreach ($flights as $flight)
				<tr>
					<th scope="row">{{$flight->id}}</th>
					<td>{{$flight->date}}</td>
					<td>{{$flight->departure}}</td>
					<td>{{$flight->arrival}}</td>
					<td>{{$flight->airplane->name}}</td>
					<td>{{$flight->available_places}}</td>
					<td>
						@if ($flight->status)
							{{__('Available')}}
						@else
							{{__('Not Available')}}
						@endif
					</td>
					<td>
						<a id=show-popup href="#" onclick="event.preventDefault();">
							<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
								stroke="#59585c"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
								class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" 
								fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
								<path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />
								<path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
							</svg>
						</a>
						<div id="popup" class="d-flex d-none position-fixed top-0 start-0 z-10 bg-dark" 
                            	style="width: 100vw; height: 100vh;">
                            <div class="card p-3 container-sm my-3">
								<h3>Flight {{$flight->id}} User Bookings</h3>
								<table class="table">
									<thead class="table-dark">
										<tr>
											<th scope="col">ID</th>
											<th scope="col">Name</th>
											<th scope="col">Email</th>
										</tr> 
									</thead>
									<tbody class="table-group-divider">
										@foreach ($flight->users as $user)
											<tr>
												<th scope="row">{{$user->id}}</th>
												<td>{{$user->name}}</td>
												<td>{{$user->email}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<a href="{{route('flightsEdit', $flight->id)}}">
							<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
								stroke="#59585c"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
								class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" 
								fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
								<path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
								<path d="M16 5l3 3" />
							</svg>
						</a>
						<a href="{{route('index')}}">
							<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
								stroke="#ff2b2b"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
								class="icon icon-tabler icons-tabler-outline icon-tabler-eraser"><path stroke="none" 
								d="M0 0h24v24H0z" fill="none"/><path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 
								1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" /><path d="M18 13.3l-6.3 -6.3" />
							</svg>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
