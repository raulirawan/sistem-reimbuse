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
                                    <th>Tanggal Pengajuan</th>
                                    <th>Total Reimburse</th>
                                    <th>Status</th>
                                    <th style="width: 25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reimbuse as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d F Y H:i', strtotime($item->tanggal_pengajuan)) }}</td>
                                        <td>Rp{{ number_format($item->total_reimbuse) }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            {{-- <form action="{{ route('karyawan.reimbuse.approve', $item->id) }}"
                                                method="post">
                                                @csrf
                                                <button class="btn btn-success badge" id="approve"
                                                    onclick="return confirm('Yakin Approve ?')">Approve</button>
                                            </form> --}}
                                            <button class="btn btn-success badge" id="approve"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#modal-approve">Approve</button>
                                            <a href="{{ route('karyawan.reimbuse.show', $item->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
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

    <div class="modal fade text-left" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="#" id="form-approve" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Approve Karyawan</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Bukti Transfer</label>
                                    <input type="file" name="bukti_transfer" class="form-control" required>
                                    @if ($errors->has('bukti_transfer'))
                                        <span class="text-danger">{{ $errors->first('bukti_transfer') }}</span>
                                    @endif
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control" placeholder="Masukan Catatan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
                    $('#modal-approve').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $(document).on('click', '#approve', function() {
                    var id = $(this).data('id');
                    $('#form-approve').attr('action', '/karyawan/reimbuse/approve/' + id);
                });
            });
        </script>
    @endpush

@endsection
