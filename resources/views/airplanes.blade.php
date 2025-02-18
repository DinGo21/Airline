@extends("layouts.app")

@section("content")
<div class="container">
	<h2 class="text-center mb-3">Airplanes</h2>
	<div class="mb-2">
		<button type="button" class="btn btn-success">add</button>
	</div>
	<table class="table table-hover">
		<thead class="table-light">
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Max Places</th>
				<th scope="col">Options</th>
			</tr>
		</thead>
		<tbody class="table-group-divider">
			@foreach ($airplanes as $airplane)
				<tr>
					<th scope="row">{{__($airplane->id)}}</th>
					<td>{{__($airplane->name)}}</td>
					<td>{{__($airplane->max_places)}}</td>
					<td>
						<a href="{{route('index')}}">
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
