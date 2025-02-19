@extends("layouts.app")

@section("content")
<div class="container">
	<h2 class="text-center mb-3">Users</h2>
	<table class="table table-hover">
		<thead class="table-light">
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Admin</th>
				<th scope="col">Options</th>
			</tr>
		</thead>
		<tbody class="table-group-divider">
			@foreach ($users as $user)
				<tr>
					<th scope="row">{{$user->id}}</th>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
                        @if ($user->admin)
                            {{__('True')}}
                        @else
                            {{__('False')}}
                        @endif
                    </td>
					<td>
                        @if (!$user->admin)
                            <a id=show-popup href="#" onclick="event.preventDefault();">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="#59585c"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-book-2"><path stroke="none" d="M0 0h24v24H0z" 
                                    fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" />
                                    <path d="M19 16h-12a2 2 0 0 0 -2 2" />
                                    <path d="M9 8h6" />
                                </svg>
                            </a>
                            <div id="popup" class="d-flex d-none position-fixed top-0 start-0 z-10 bg-dark" 
                                    style="width: 100vw; height: 100vh;">
                                <div class="card p-3 container-sm my-3">
                                    <h3>{{$user->name}}'s Bookings</h3>
                                    <table class="table">
                                        <thead class="table-dark">
                                           <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Departure</th>
                                                <th scope="col">Arrival</th>
                                           </tr> 
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @foreach ($user->flights as $flight)
                                                <tr>
                                                    <th scope="row">{{$flight->id}}</th>
                                                    <td>{{$flight->date}}</td>
                                                    <td>{{$flight->departure}}</td>
                                                    <td>{{$flight->arrival}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
