@extends('layouts.admin')

@section('title', 'Halaman Data Reimburse')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Reimburse</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('keuangan.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Data Reimburse
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">

                <div class="card-header">Tabel Reimburse</div>
                <div class="card-body">


                    <!--Basic Modal -->

                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Tipe</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Total Reimburse</th>
                                    <th>Status</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reimbuse as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tipe }}</td>
                                        <td>{{ date('d F Y H:i', strtotime($item->tanggal_pengajuan)) }}</td>
                                        <td>Rp{{ number_format($item->total_reimbuse) }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ route('keuangan.reimbuse.show', $item->id) }}" target="_blank"
                                                class="btn btn-info badge">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>


    @push('down-style')
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/fontawesome.css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/datatables.css" />
    @endpush
    @push('down-script')
        <script src="{{ asset('assets') }}/js/extensions/datatables.js"></script>
        @if (count($errors) > 0)
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#modal-create').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $(document).on('click', '#tolak', function() {
                    var id = $(this).data('id');
                    $('#form-tolak').attr('action', '/keuangan/reimbuse/tolak/' + id);
                });

                $(document).on('click', '#payment-voucher', function() {
                    var id = $(this).data('id');
                    $('#form-voucher').attr('action', '/keuangan/reimbuse/payment-voucher/' + id);
                });

                $("#add-item").click(function(e) {
                    e.preventDefault();
                    var html = `
                    <div class="row">
                        <div class="col-md-3">
                        <input type="text" class="form-control mt-2" name="nomor_akun[]"
                            placeholder="Nomor Akun" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control mt-2" name="nama[]"
                            placeholder="Nama" required>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control mt-2" name="harga[]"
                            placeholder="Harga" required>
                    </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger badge mt-3 delete-row">(-)</button>
                        </div>
                    </div>
                `;

                    $("#row-item").append(html);
                });

                $(document).on('click', '.delete-row', function() {
                    $(this).parent().parent().remove();
                });

            });
        </script>


    @endpush

@endsection
