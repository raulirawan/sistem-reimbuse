@extends('layouts.admin')

@section('title', 'Halaman Data Reimburse')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Data Reimburse</h3>

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('karyawan.dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Detail Data Reimburse
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header ">
                    <div class="float-left card-title">Data Reimburse</div>
                    <a href="{{ url()->previous() }}" class="btn badge btn-primary"
                        style="align-items: center; float: right" role="button">Kembali</a>
                </div>
                <div class="card-body">


                    <!--Basic Modal -->

                    <table class="table table-bordered">

                        <tbody>
                            <tr>
                                <th style="width: 400px">Tanggal Pengajuan</th>
                                <td>{{ date('d F Y H:i', strtotime($reimbuse->tanggal_pengajuan)) }}</td>
                            </tr>
                            <tr>
                                <th style="width: 400px">Nama Karyawan</th>
                                <td>{{ $reimbuse->karyawan->name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 400px">Total Reimbuse</th>
                                <td>Rp{{ number_format($reimbuse->total_reimbuse) }}</td>
                            </tr>
                            <tr>
                                <th style="width: 400px">Bukti Nota</th>
                                <td>
                                    <a href="{{ route('lihat.bukti.nota', [$reimbuse->id, 'lihat']) }}" target="_blank"
                                        class="btn badge btn-info">Read Only</a>
                                    <a href="{{ route('lihat.bukti.nota', [$reimbuse->id, 'download']) }}" target="_blank"
                                        class="btn badge btn-info">Download</a>
                                </td>
                            </tr>

                            <tr>
                                <th style="width: 400px">Tipe Reimbuse</th>
                                <td>{{ $reimbuse->tipe }}</td>

                            </tr>
                            <tr>
                                <th style="width: 400px">Status</th>
                                <td>{{ $reimbuse->status }}</td>

                            </tr>
                            <tr>
                                <th style="width: 400px">Catatan</th>
                                <td>{{ $reimbuse->catatan_karyawan ?? '-' }}</td>

                            </tr>
                            <tr>
                                <th style="width: 400px">Catatan Approve</th>
                                <td>{{ $reimbuse->catatan_karyawan_approve ?? '-' }}</td>

                            </tr>
                            <tr>

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card">

                <div class="card-header">Progress Keuangan</div>
                <div class="card-body">


                    <!--Basic Modal -->

                    <table class="table table-bordered">

                        <tbody>
                            <tr>
                                <th style="width: 400px">Status Approve</th>
                                <td>
                                    @if ($reimbuse->status_keuangan == 1)
                                        <span class="badge bg-success">Approve</span>
                                    @elseif($reimbuse->status_keuangan == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Reject</span>
                                    @endif
                                </td>

                            </tr>

                            <tr>
                                <th style="width: 400px">Catatan</th>
                                <td>{{ $reimbuse->catatan_keuangan ?? '-' }}</td>
                            </tr>

                            @if ($reimbuse->status_keuangan == 1)
                                <tr>
                                    <th style="width: 400px">Payment Voucher</th>
                                    <td>
                                        <a href="{{ route('generatePdf', [$reimbuse->id, 'lihat']) }}" target="_blank"
                                            class="btn badge btn-info">Read Only</a>
                                        <a href="{{ route('generatePdf', [$reimbuse->id, 'download']) }}" target="_blank"
                                            class="btn badge btn-info">Download</a>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Approve Transfer</th>
                                <td>{{ $reimbuse->bukti_transfer ?? '-' }}</td>
                            </tr>
                            @if ($reimbuse->status_keuangan == 1)
                                <tr>
                                    <th>Date Approve</th>
                                    <td>{{ $reimbuse->approve_date_keuangan ?? date('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>


            <div class="card">

                <div class="card-header">Progress Sekretaris</div>
                <div class="card-body">
                    <!--Basic Modal -->
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 400px">Status Approve</th>
                                <td>
                                    @if ($reimbuse->status_sekretaris == 1)
                                        <span class="badge bg-success">Approve</span>
                                    @elseif($reimbuse->status_sekretaris == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Reject</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 400px">Catatan</th>
                                <td>{{ $reimbuse->catatan_sekretaris ?? '-' }}</td>
                            </tr>
                            {{-- @if ($reimbuse->bukti_transfer)
                                <tr>
                                    <th style="width: 400px">Bukti Transfer</th>
                                    <td>
                                        <a href="{{ asset($reimbuse->bukti_transfer) }}" target="_blank"
                                            class="btn badge btn-info">Lihat Bukti
                                            Transfer</a>
                                    </td>
                                </tr>
                            @endif --}}
                            @if ($reimbuse->status_sekretaris == 1)
                                <tr>
                                    <th>Date Approve</th>
                                    <td>{{ $reimbuse->approve_date_sekretaris ?? date('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>

                </div>
            </div>

            <div class="card">

                <div class="card-header">Progress Partner</div>
                <div class="card-body">
                    <!--Basic Modal -->
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 400px">Status Approve</th>
                                <td>
                                    @if ($reimbuse->status_partner == 1)
                                        <span class="badge bg-success">Approve</span>
                                    @elseif($reimbuse->status_partner == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Reject</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 400px">Catatan</th>
                                <td>{{ $reimbuse->catatan_partner ?? '-' }}</td>
                            </tr>
                            @if ($reimbuse->status_partner == 1)
                                <tr>
                                    <th>Date Approve</th>
                                    <td>{{ $reimbuse->approve_date_partner ?? date('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

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
                $(document).on('click', '#edit', function() {
                    var id = $(this).data('id');
                    var nama_reimbuse = $(this).data('nama_reimbuse');
                    $('#nama_reimbuse').val(nama_reimbuse);
                    $('#form-edit').attr('action', '/admin/reimbuse/update/' + id);
                });
            });
        </script>
    @endpush

@endsection
