<header>
	<a class="logo" href="{{ url('/') }}">
        <h1>{{config('app.name', 'Airline')}}</h1>
    </a>
	<ul class="headerList">
		@guest
			@if (Route::has('login'))
				<li>
					<a href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
			@endif
			@if (Route::has('register'))
				<li>
					<a href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
			@endif
		@else
			<li>
				<a href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }}
				</a>
				<div>
					<a href="{{ route('logout') }}"
						onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf
					</form>
				</div>
			</li>
		@endguest
	</ul>
</header>
