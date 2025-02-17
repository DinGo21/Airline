@extends ("layouts.app2")

@section ("content")
    <section class="banner bannerIndex">
        <div class="bannerContent">
            <input type="text" id="input" class="searchBar" placeholder="Search Something...">
        </div>
    </section>
	<div class="container indexTable">
		<table id="table" class="table">
            <thead>
                <tr>
                    <th class="label" scope="col">date</th>
                    <th class="label" scope="col">departure</th>
                    <th class="label" scope="col">arrival</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr id="{{$flight->id}}" class="row getRows">
                        <td class="cell">
                            <p>{{$flight->date}}</p>
                        </td>
                        <td class="cell">
                            <p>{{$flight->departure}}</p>
                        </td>
                        <td class="cell">
                            <p>{{$flight->arrival}}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endsection
