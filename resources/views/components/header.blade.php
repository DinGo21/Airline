<header class="header">
	<a class="headerLogo" href="{{ url('/') }}">
        <h1>
			<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
			stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
			class="icon icon-tabler icons-tabler-outline icon-tabler-plane-departure"><path stroke="none" 
			d="M0 0h24v24H0z" fill="none"/><path d="M14.639 10.258l4.83 -1.294a2 2 0 1 1 1.035 3.863l-14.489 
			3.883l-4.45 -5.02l2.897 -.776l2.45 1.414l2.897 -.776l-3.743 -6.244l2.898 -.777l5.675 5.727z" />
			<path d="M3 21h18" />
			</svg>
			{{config('app.name', 'Airline')}}
		</h1>
    </a>
	<ul class="headerList">
		@guest
			@if (Route::has('login'))
				<li class="headerListElement">
					<a class="headerLink login" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
			@endif
			@if (Route::has('register'))
				<li class="headerListElement">
					<a class="headerLink" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
			@endif
		@else
			<li class="headerListElement dropdown">
				<a class="headerLink dropdownButton" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					<svg  xmlns="http://www.w3.org/2000/svg"  width="34"  height="34"  viewBox="0 0 24 24"  fill="none"  
						stroke="#ffffff"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
						class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle"><path stroke="none" d="M0 0h24v24H0z" 
						fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 
						1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
					</svg>
				</a>
				<div class="dropdownMenu">
					<a class="headerLink dropdownLink" href="{{ route('index') }}">
						{{ __("Bookings")}}
					</a>
					<a class="headerLink dropdownLink" href="{{ route('logout') }}"
						onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
						{{ __("Logout")}}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf
					</form>
				</div>
			</li>
		@endguest
	</ul>
</header>
