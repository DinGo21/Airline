@extends("layouts.app2")

@section("content")
    <h2>{{$user->name}}'s Bookings</h2>
    <div class="container">
        <table id="table" class="bookings">
            <thead>
                <tr>
                    <th class="bookingsLabel" scope="col">date</th>
                    <th class="bookingsLabel" scope="col">departure</th>
                    <th class="bookingsLabel" scope="col">arrival</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->flights as $flight)
                    <tr id="{{$flight->id}}" class="bookingsRow">
                        <td class="bookingsCell">
                            <p>{{$flight->date}}</p>
                        </td>
                        <td class="bookingsCell">
                            <p>{{$flight->departure}}</p>
                        </td>
                        <td class="bookingsCell">
                            <p>{{$flight->arrival}}</p>
                        </td>
                        <td class="bookingsCell">
                            <a href="#">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                    stroke="#ff2b2b"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-x"><path stroke="none"
                                    d="M0 0h24v24H0z" fill="none"/><path d="M13 21h-7a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 
                                    2v6.5" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M22 22l-5 -5" />
                                    <path d="M17 22l5 -5" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
