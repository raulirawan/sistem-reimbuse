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
                                <a href="{{ route('karyawan.dashboard.index') }}">Dashboard</a>
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
                    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#modal-create">
                        Tambah Reimburse
                    </button>

                    <!--Basic Modal -->

                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Total Reimburse</th>
                                    <th>Status</th>
                                    <th style="width: 15%">Aksi</th>
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
                                            <a href="{{ route('karyawan.reimbuse.show', $item->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            {{-- <button href="" class="btn btn-info btn-sm" id="edit"
                                                data-id="{{ $item->id }}"
                                                data-nama_reimbuse="{{ $item->nama_reimbuse }}" data-bs-toggle="modal"
                                                data-bs-target="#modal-edit">Edit</button> --}}
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

    <div class="modal fade text-left" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="{{ route('karyawan.reimbuse.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Tambah Data Reimburse</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Nominal Reimburse</label>
                                    <input type="number" class="form-control" value="{{ old('total_reimbuse') }}"
                                        name="total_reimbuse" placeholder="Masukan Nominal Reimbuse" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Tipe Uang</label>
                                    <select name="tipe" class="form-control" required>
                                        <option value="">Pilih Tipe Uang</option>
                                        <option value="UANG PRIBADI"
                                            @if (old('tipe') == 'UANG PRIBADI') selected="selected" @endif>
                                            UANG PRIBADI</option>
                                        <option value="UANG KANTOR"
                                            @if (old('tipe') == 'UANG KANTOR') selected="selected" @endif>
                                            UANG KANTOR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Bukti Nota</label>
                                    <input type="file" name="bukti_nota[]" class="form-control" multiple>
                                    @if ($errors->has('bukti_nota.*'))
                                        <span class="text-danger">{{ $errors->first('bukti_nota.*') }}</span>
                                    @endif
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

    <div class="modal fade text-left" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="#" id="form-edit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Edit Data Reimburse</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Nama Reimburse</label>
                                    <input type="text" class="form-control" id="nama_reimbuse"
                                        value="{{ old('nama_reimbuse') }}" name="nama_reimbuse"
                                        placeholder="Masukan Nama Reimbuse" required>
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
