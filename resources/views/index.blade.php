@extends ("layouts.app2")

@section ("content")
    <section class="banner">
        <div class="bannerContent">
            <input type="text" id="input" class="searchBar" placeholder="Search Something...">
        </div>
    </section>
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
                            @if ($flight->status)
                                <p class="available">Available</p>
                            @else
                                <p class="notAvailable">Not Available</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endsection
