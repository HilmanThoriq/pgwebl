<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-earth-asia"></i>  {{ $title }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('map') }}"><i class="fa-solid fa-house"></i> Beranda </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('map') }}"><i class="fa-solid fa-map"></i> Peta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('table') }}"><i class="fa-solid fa-table"></i> Tabel</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-database"></i>  Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('api.points') }}" target="blank">Points</a></li>
                        <li><a class="dropdown-item" href="{{ route('api.polylines') }}" target="blank">Polylines</a></li>
                        <li><a class="dropdown-item" href="{{ route('api.polygons') }}" target="blank">Polygons</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
