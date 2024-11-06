<nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary" >
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{route('dashboard')}}">Posts System</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="btn btn-danger" href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{'Log Out'}}
                </a>
            </form>
        </div>
    </nav>