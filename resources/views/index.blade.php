@extends ("layouts.app2")

@section ("content")
	<input type="text" id="input" class="searchBar" placeholder="">
	<div class="container">
		<table id="table" class="table">
            <thead>
                <tr>
                    <th class="label" scope="col">date</th>
                    <th class="label" scope="col">departure</th>
                    <th class="label" scope="col">arrival</th>
                    <th class="label" scope="col">status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr class="row">
                        <td class="cell">
							<p>{{$flight->date}}</p>
						</td>
                        <td class="cell">
                            <p>{{$flight->departure}}</p>
                        </td>
                        <td class="cell">
							<p>{{$flight->arrival}}</p>
                        </td>
                        <td class="cell">
                            <p>{{$flight->status}}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endsection
