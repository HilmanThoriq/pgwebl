@extends('layout.template')


@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);

        }
    </style>
@endsection


@section('content')
    <div id="map"></div>

    <!-- Modal Create Point -->
    <div class="modal fade" id="CreatePointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name here..." required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_point" class="form-label fw-semibold">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Photo</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('image-point-preview').src = window.URL.createObjectURL(this.files[0])">
                            <div class="text-center my-3">
                                <img src="" alt="" id="image-point-preview" class="img-thumbnail text-center" width="400">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polyline -->
    <div class="modal fade" id="CreatePolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name here..." required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label fw-semibold">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Photo</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('image-polyline-preview').src = window.URL.createObjectURL(this.files[0])">
                            <div class="text-center my-3">
                                <img src="" alt="" id="image-polyline-preview" class="img-thumbnail text-center" width="400">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Polygon -->
    <div class="modal fade" id="CreatePolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Fill point name here..." required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label fw-semibold">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Photo</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('image-polygon-preview').src = window.URL.createObjectURL(this.files[0])">
                            <div class="text-center my-3">
                                <img src="" alt="" id="image-polygon-preview" class="img-thumbnail text-center" width="400">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>


    <script>
        var map = L.map('map').setView([-7.766582427240689, 110.37497699483326], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            console.log(objectGeometry);

            if (type === 'polyline') {
                console.log("Create " + type);

                $('#geom_polyline').val(objectGeometry);

                // Modal Bootstrap
                $('#CreatePolylineModal').modal('show');

            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);

                $('#geom_polygon').val(objectGeometry);

                // Modal Bootstrap
                $('#CreatePolygonModal').modal('show');

            } else if (type === 'marker') {
                console.log("Create " + type);

                $('#geom_point').val(objectGeometry);

                // Modal Bootstrap
                $('#CreatePointModal').modal('show');

            } else {
                console.log('__undefined__');
            }

            drawnItems.addLayer(layer);
        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routeedit = "{{ route('points.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var routedelete = "{{ route('points.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Dibuat Oleh: " + feature.properties.user_created + "<br>" +
                    "Geometry: " + feature.geometry.coordinates + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images +
                    "' width='200'alt=''>" + "<br>" +
                    "<div class='row text-center mt-4'>" +
                        // Button Edit Data
                        "<div class='col-6 px-1'>" +
                            "<a href='" + routeedit + "' class='btn btn-warning btn-sm text-white d-block w-100'><i class='fa-solid fa-pen-to-square'></i></a>" +
                        "</div>" +
                        // Button Delete Data
                        "<div class='col-6 px-1'>" +
                            "<form method='POST' action='" + routedelete + "'>" + '@csrf' + '@method("DELETE")' +
                                "<button type='submit' class='btn btn-danger btn-sm d-block w-100' onclick='return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                            "</form>" +
                        "</div>" +
                    "</div>";

                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // GeoJSON Polylines
        var polyline = L.geoJson(null, {
            /* Style polyline */
            style: function(feature) {
                return {
                    color: "#3388ff",
                    weight: 3,
                    opacity: 1,
                };
            },
            onEachFeature: function(feature, layer) {

                var routeedit = "{{ route('polylines.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var routedelete = "{{ route('polylines.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var popupContent = "Kelas Jalan: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Koordinat: " + feature.geometry.coordinates + "<br>" +
                    "Dibuat Oleh: " + feature.properties.user_created + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "Panjang: " + feature.properties.length_km.toFixed(5) + " km" + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images + "'width='200' alt=''>" + "<br>" +
                    "<div class='row text-center mt-4'>" +
                        // Button Edit Data
                        "<div class='col-6 px-1'>" +
                            "<a href='" + routeedit + "' class='btn btn-warning btn-sm text-white d-block w-100'><i class='fa-solid fa-pen-to-square'></i></a>" +
                        "</div>" +
                        // Button Delete Data
                        "<div class='col-6 px-1'>" +
                            "<form method='POST' action='" + routedelete + "'>" + '@csrf' + '@method("DELETE")' +
                                "<button type='submit' class='btn btn-danger btn-sm d-block w-100' onclick='return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                            "</form>" +
                        "</div>" +
                    "</div>";
                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polyline.bindTooltip(feature.properties.name, {
                            sticky: true,
                        });
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        // GeoJSON Polygons
        var polygon = L.geoJson(null, {
            /* Style polygon */
            style: function(feature) {
                return {
                    color: "#3388ff",
                    fillColor: "#3388ff",
                    weight: 2,
                    opacity: 1,
                    fillOpacity: 0.2,
                };
            },
            onEachFeature: function(feature, layer) {

                var routeedit = "{{ route('polygons.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var routedelete = "{{ route('polygons.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var popupContent = "Nama : " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Koordinat: " + feature.geometry.coordinates + "<br>" +
                    "Dibuat Oleh: " + feature.properties.user_created + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "Luas : " + feature.properties.area_hectare.toFixed(3) + " Ha" + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.images + "'width='200' alt=''>" + "<br>" +
                    "<div class='row text-center mt-4'>" +
                        // Button Edit Data
                        "<div class='col-6 px-1'>" +
                            "<a href='" + routeedit + "' class='btn btn-warning btn-sm text-white d-block w-100'><i class='fa-solid fa-pen-to-square'></i></a>" +
                        "</div>" +
                        // Button Delete Data
                        "<div class='col-6 px-1'>" +
                            "<form method='POST' action='" + routedelete + "'>" + '@csrf' + '@method("DELETE")' +
                                "<button type='submit' class='btn btn-danger btn-sm d-block w-100' onclick='return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                            "</form>" +
                        "</div>" +
                    "</div>";

                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name, {
                            sticky: true,
                        });
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });
    </script>
@endsection
