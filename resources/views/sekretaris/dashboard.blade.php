@extends('layouts.admin')

@section('title', 'Halaman Dashboard Sekretaris')

@section('content')
    <div class="page-heading">
        <h3>Data Statistik</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">

                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Reimburse Pending</h6>
                                        <h6 class="font-extrabold mb-0">{{ App\Reimbuse::where('status', 'MENUNGGU SEKRETARIS')->where('status_sekretaris', '!=', 1)->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Reimburse Perlu Di Transfer</h6>
                                        <h6 class="font-extrabold mb-0">{{ App\Reimbuse::where(['status_keuangan' => 1, 'status_sekretaris' => 1, 'status_partner' => 1])->whereNull('bukti_transfer')->where('tipe', 'UANG PRIBADI')->count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection
