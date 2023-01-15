@extends('layouts.admin')

@section('title', 'Halaman Data Objek Wisata')

@section('content')
<div class="page-heading">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Data Objek Wisata</h3>

        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav
            aria-label="breadcrumb"
            class="breadcrumb-header float-start float-lg-end"
          >
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Data Objek Wisata
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
      <div class="card">

        <div class="card-header">Tabel Objek Wisata</div>
        <div class="card-body">
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
        data-bs-target="#modal-create">
        Tambah Objek Wisata
    </button>

    <!--Basic Modal -->

         <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                  <tr>
                    <th style="width: 5%">No</th>
                    <th>Nama Wisata</th>
                    <th>Jarak</th>
                    <th>Link Gmaps</th>
                    <th>Gambar</th>
                    <th style="width: 15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($data as $item)
                 <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_wisata }}</td>
                    <td>{{ $item->jarak }}</td>
                    <td>{{ $item->link_maps }}</td>
                    <td>
                        @if ($item->gambar != null)
                        <img src="{{ asset($item->gambar) }}" style="width: 100px">
                        @else
                        <img src="https://overlay.imageonline.co/image.jpg" style="width: 100px">
                        @endif
                    </td>
                    <td>
                      <button href="" class="btn btn-info btn-sm" id="edit"
                      data-id="{{ $item->id }}"
                      data-nama_wisata="{{ $item->nama_wisata }}"
                      data-jarak="{{ $item->jarak }}"
                      data-link_maps="{{ $item->link_maps }}"
                      data-gambar="{{ $item->gambar }}"
                      data-bs-toggle="modal"
                      data-bs-target="#modal-edit">Edit</button>
                      <a href="{{ route('admin.objek.wisata.delete', $item->id) }}"
                        onclick="return confirm('Yakin ?')"
                        class="btn btn-danger btn-sm">Hapus</a>
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

  <div class="modal fade text-left" id="modal-create" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
        <form action="{{ route('admin.objek.wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Form Tambah Data Objek Wisata</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="basicInput">Nama Wisata</label>
                              <input type="text" class="form-control" value="{{ old('nama_wisata') }}" name="nama_wisata" placeholder="Masukan Nama" required>
                          </div>

                          <div class="form-group">
                              <label for="helpInputTop">Jarak</label>
                              <input type="text" class="form-control" value="{{ old('jarak') }}" name="jarak" placeholder="Masukan Jarak" required>
                            </div>

                        <div class="form-group">
                            <label for="helpInputTop">Link Maps</label>
                            <input type="text" class="form-control" value="{{ old('link_maps') }}" name="link_maps" placeholder="Masukan Link Maps" required>
                        </div>
                        <div class="form-group">
                            <label for="helpInputTop">Gambar</label>
                            <input type="file" class="form-control"  name="gambar"  required>
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

<div class="modal fade text-left" id="modal-edit" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
      <form action="#" id="form-edit" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel1">Form Edit Data Objek Wisata</h5>
                  <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                      aria-label="Close">
                      <i data-feather="x"></i>
                  </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                          <div class="form-group">
                              <label for="basicInput">Nama Wisata</label>
                              <input type="text" class="form-control" id="nama_wisata" value="{{ old('nama_wisata') }}" name="nama_wisata" placeholder="Masukan Nama" required>
                          </div>

                          <div class="form-group">
                              <label for="helpInputTop">Jarak</label>
                              <input type="text" class="form-control" id="jarak" value="{{ old('jarak') }}" name="jarak" placeholder="Masukan Jarak" required>
                            </div>

                        <div class="form-group">
                            <label for="helpInputTop">Link Maps</label>
                            <input type="text" class="form-control" id="link_maps" value="{{ old('link_maps') }}" name="link_maps" placeholder="Masukan Link Maps" required>
                        </div>
                        <div class="form-group">
                            <label for="helpInputTop">Gambar</label>
                            <input type="file" class="form-control" name="gambar" placeholder="Masukan Link Maps">
                            <img src="" id="gambar" class="mt-2" style="width: 100px">
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
            $(document).ready(function () {
                $('#modal-create').modal('show');
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var nama_wisata = $(this).data('nama_wisata');
                var jarak = $(this).data('jarak');
                var link_maps = $(this).data('link_maps');
                var gambar = $(this).data('gambar');
                var url = '{{ url('/') }}';
                $('#nama_wisata').val(nama_wisata);
                $('#jarak').val(jarak);
                $('#link_maps').val(link_maps);
                if(gambar != '') {
                    $('#gambar').attr('src', url + '/' + gambar);

                }else {
                $('#gambar').attr('src','https://overlay.imageonline.co/image.jpg');
                }
                $('#form-edit').attr('action','/admin/objek/wisata/update/' + id);
            });
        });
    </script>
  @endpush

@endsection
