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

    <!-- Modal Edit Polyline -->
    <div class="modal fade" id="EditPolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            draw: false,
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: false
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function(e) {
            var layers = e.layers;

            layers.eachLayer(function(layer) {
                var drawnJSONObject = layer.toGeoJSON();
                console.log(drawnJSONObject);

                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                console.log(objectGeometry);

                // layer properties
                var properties = drawnJSONObject.properties;
                console.log(properties);

                drawnItems.addLayer(layer);

                // Show data to modal
                $('#name').val(properties.name);
                $('#description').val(properties.description);
                $('#geom_polyline').val(objectGeometry);
                $('#image-point-preview').attr('src', +"{{ asset('storage/images') }}/" + properties.image);
                $('#image-point-preview').attr('alt', properties.image);
                $('#image-point-preview').attr('width', 400);
                $('#image-point-preview').attr('height', 300);

                // Show modal edit point
                $('#EditPolylineModal').modal('show');
            });
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

                // Add layer point to drawnItems
                drawnItems.addLayer(layer);

                // layer properties
                var properties = feature.properties;

                var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

                layer.on({
                    click: function(e) {

                        // Show data to modal
                        $('#name').val(properties.name);
                        $('#description').val(properties.description);
                        $('#geom_polyline').val(objectGeometry);
                        $('#image-point-preview').attr('src', +"{{ asset('storage/images') }}/" +
                            properties.image);
                        $('#image-point-preview').attr('alt', properties.image);
                        $('#image-point-preview').attr('width', 400);
                        $('#image-point-preview').attr('height', 300);

                        // Show modal edit polyline
                        $('#EditPolylineModal').modal('show');
                    }
                });
            },
        });
        $.getJSON("{{ route('api.polyline', $id) }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
            map.fitBounds(polyline.getBounds(), {
                padding: [100, 100]
            });
        });


    </script>
@endsection
