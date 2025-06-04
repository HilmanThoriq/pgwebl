@extends('layout.template')

@section('content')
    <div class="container my-5">
        <div class="col-12 mx-auto">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0 fw-semibold">
                        <i class="fas fa-globe-americas me-2"></i>
                        Praktikum Pemrograman Geospasial Web Lanjut
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center mb-3 pb-3 border-bottom">
                        <div class="col-auto">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="col">
                            <small class="text-muted text-uppercase fw-semibold d-block">Nama</small>
                            <h6 class="mb-0 text-dark fw-medium">Hilman Thoriq</h6>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3 pb-3 border-bottom">
                        <div class="col-auto">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                        <div class="col">
                            <small class="text-muted text-uppercase fw-semibold d-block">NIM</small>
                            <h6 class="mb-0 text-dark fw-medium">23/522897/SV/23809</h6>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px;">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col">
                            <small class="text-muted text-uppercase fw-semibold d-block">Kelas</small>
                            <h6 class="mb-0 text-dark fw-medium">PGWL - A</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
