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
                                    <th style="width: 28%">Aksi</th>
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
                                            <a href="{{ asset($item->bukti_nota) }}" target="_blank"
                                                class="btn btn-info badge">Bukti</a>
                                            <button href="" class="btn btn-success badge" id="payment-voucher"
                                                data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                data-bs-target="#modal-voucher">Payment Voucher</button>
                                            <button href="" class="btn btn-danger badge" id="tolak"
                                                data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                data-bs-target="#modal-tolak">Tolak</button>
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

    <div class="modal fade text-left" id="modal-voucher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="#" id="form-voucher" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Payment Voucher</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Nomor</label>
                                    <input type="text" class="form-control" value="{{ old('no') }}" name="no"
                                        placeholder="Masukan Nomor" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Cheque</label>
                                    <input type="text" class="form-control" value="{{ old('cheque') }}" name="cheque"
                                        placeholder="Masukan Cheque" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Payment To</label>
                                    <input type="text" class="form-control" value="{{ old('payment_to') }}"
                                        name="payment_to" placeholder="Masukan Payment To" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Account No</label>
                                    <input type="text" class="form-control" value="{{ old('account_no') }}"
                                        name="account_no" placeholder="Masukan Account No" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Says</label>
                                    <input type="text" class="form-control" value="{{ old('says') }}" name="says"
                                        placeholder="Masukan Says" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Catatan</label>
                                    <textarea name="catatan_keuangan" id="catatan_keuangan" class="form-control" placeholder="Masukan Catatan"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Item</label>
                                    <button class="btn btn-sm btn-success badge" id="add-item">(+)</button>
                                    <span id="row-item">
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
                                                {{-- <button class="btn btn-danger badge mt-3">(-)</button> --}}
                                            </div>
                                        </div>
                                    </span>
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

    <div class="modal fade text-left" id="modal-tolak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="#" id="form-tolak" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Form Tolak Data Reimburse</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput">Catatan</label>
                                    <textarea name="catatan_keuangan" id="catatan_keuangan" class="form-control" placeholder="Masukan Catatan"></textarea>
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
