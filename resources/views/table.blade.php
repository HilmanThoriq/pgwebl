@extends('layout.template')

@section('content')
    <div class="container my-5">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link active" id="points-tab" data-bs-toggle="tab" data-bs-target="#points" type="button"
                    role="tab" aria-controls="points" aria-selected="true">
                    <i class="bi bi-geo-alt-fill me-2"></i> Points
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="polylines-tab" data-bs-toggle="tab" data-bs-target="#polylines" type="button"
                    role="tab" aria-controls="polylines" aria-selected="false">
                    <i class="bi bi-bezier2 me-2"></i> Polylines
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="polygons-tab" data-bs-toggle="tab" data-bs-target="#polygons" type="button"
                    role="tab" aria-controls="polygons" aria-selected="false">
                    <i class="bi bi-pentagon me-2"></i> Polygons
                </button>
            </li>
        </ul>

        <div class="tab-content" id="dataTabsContent">
            <div class="tab-pane fade show active" id="points" role="tabpanel" aria-labelledby="points-tab">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-geo-alt-fill me-2"></i> Points Data</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle mb-0">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($points as $point)
                                        <tr>
                                            <td>{{ $point->id }}</td>
                                            <td>{{ $point->name }}</td>
                                            <td>{{ $point->description }}</td>
                                            <td>
                                                @if ($point->images)
                                                    <img src="{{ asset('storage/images/' . $point->images) }}"
                                                        alt="{{ $point->name }}" class="img-thumbnail rounded"
                                                        width="120" title="{{ $point->name }}">
                                                @else
                                                    <span class="badge bg-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $point->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $point->updated_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">No point data available
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="polylines" role="tabpanel" aria-labelledby="polylines-tab">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-bezier2 me-2"></i> Polylines Data</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle mb-0">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($polylines as $polyline)
                                        <tr>
                                            <td>{{ $polyline->id }}</td>
                                            <td>{{ $polyline->name }}</td>
                                            <td>{{ $polyline->description }}</td>
                                            <td>
                                                @if ($polyline->images)
                                                    <img src="{{ asset('storage/images/' . $polyline->images) }}"
                                                        alt="{{ $polyline->name }}" class="img-thumbnail rounded"
                                                        width="100" title="{{ $polyline->name }}">
                                                @else
                                                    <span class="badge bg-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $polyline->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $polyline->updated_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">No polyline data
                                                available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="polygons" role="tabpanel" aria-labelledby="polygons-tab">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-pentagon me-2"></i> Polygons Data</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover align-middle mb-0">
                                <thead class="bg-light text-muted">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($polygons as $polygon)
                                        <tr>
                                            <td>{{ $polygon->id }}</td>
                                            <td>{{ $polygon->name }}</td>
                                            <td>{{ $polygon->description }}</td>
                                            <td>
                                                @if ($polygon->images)
                                                    <img src="{{ asset('storage/images/' . $polygon->images) }}"
                                                        alt="{{ $polygon->name }}" class="img-thumbnail rounded"
                                                        width="100" title="{{ $polygon->name }}">
                                                @else
                                                    <span class="badge bg-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $polygon->created_at->format('d M Y, H:i') }}</td>
                                            <td>{{ $polygon->updated_at->format('d M Y, H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">No polygon data available
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
