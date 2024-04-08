@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Karyawan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard Admin</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Daftar Karyawan
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @include('messages.alerts')
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="col-md-12 text-right mb-3">
                            <a href="" data-toggle="modal" data-target=".TambahData" class="btn btn-info" title="Tambah Karyawan">
                            <i class="fa fa-plus"></i> Tambah</a>
                        </div>
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Asal Kampus</th>
                                    <th>Divisi</th>
                                    <th>Periode Magang</th>
                                    <th class="none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->age }}</td>
                                    <td>{{ $employee->campus_origin }}</td>
                                    <td>{{ $employee->division }}</td>
                                    <td>{{ $employee->intern_period->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.employees.profile', $employee->id) }}" class="btn btn-flat btn-info">Lihat Profil</a>
                                        <a href="" class="btn btn-warning" data-toggle="modal" data-target=".editEmployee{{ $employee->id }}" title="Edit Employee">Edit Data</a>
                                        <button 
                                        class="btn btn-flat btn-danger"
                                        data-toggle="modal" 
                                        data-target="#deleteModalCenter{{ $index + 1 }}"
                                        >Hapus Karyawan</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            @for ($i = 1; $i < $employees->count()+1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Yakin ingin dihapus?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">
                                                    
                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">Tidak</button>
                                                    
                                                    <form 
                                                    action="{{ route('admin.employees.delete', $employees->get($i-1)->id) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn flat btn-danger ml-1">Ya</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>Aksi ini tidak bisa dilakukan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor 
                    </div>
                </div>
                <!-- general form elements -->
                
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<div class="modal fade TambahData" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="name" >Nama</label>
                    <span><i class="fa fa-question-circle" tabindex="0" data-toggle="popover" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Nama Lengkap"></i></span>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukan name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="age" >Umur</label>
                    <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" placeholder="Masukan Umur">
                    @error('age')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="email" >Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukan Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="intern_period" >Periode Magang</label>
                    <input type="text" name="intern_period" id="intern_period" class="form-control @error('intern_period') is-invalid @enderror" value="{{ old('intern_period') }}" placeholder="Masukan akhir magang">
                    @error('intern_period')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="division" >Divisi Magang</label>
                    <input type="text" name="division" class="form-control @error('division') is-invalid @enderror" value="{{ old('campus_origin') }}" placeholder="Masukan Divisi">
                    @error('division')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="campus_origin" >Asal Kampus</label>
                    <input type="text" name="campus_origin" class="form-control @error('campus_origin') is-invalid @enderror" value="{{ old('campus_origin') }}" placeholder="Masukan Asal Kampus">
                    @error('campus_origin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="password" >Password Baru</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="Masukan baru">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="required-label faded-label" for="password_confirmation" >Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" placeholder="Masukan Asal Kampus">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($employees as $employee)
<div class="modal fade editEmployee{{ $employee->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <!-- Isi modal body -->
            <div class="modal-body">
                <!-- Form edit/update -->
                <form action="{{ route('admin.employees.update', ['id' => $employee->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menggunakan method PUT untuk update -->

                    <!-- Input field untuk Nama -->
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="name">Nama</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $employee->name }}" placeholder="Masukkan Nama">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input field untuk Umur -->
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="age">Umur</label>
                        <input type="number" name="age" class="form-control @error('age') is-invalid @enderror" value="{{ $employee->age }}" placeholder="Masukkan Umur">
                        @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input field untuk Email -->
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $employee->user->email }}" placeholder="Masukkan Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input field untuk Periode Magang -->
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="intern_period">Periode Magang</label>
                        <input type="text" name="intern_period" id="intern_period" class="form-control @error('intern_period') is-invalid @enderror" value="{{ $employee->intern_period }}" placeholder="Masukkan Periode Magang">
                        @error('intern_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input field untuk Divisi -->
                    <div class="form-group mb-3">
                        <label class="required-label faded-label" for="division">Divisi Magang</label>
                        <input type="text" name="division" class="form-control @error('division') is-invalid @enderror" value="{{ $employee->division }}" placeholder="Masukkan Divisi">
                        @error('division')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Input field untuk Password (opsional) -->
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    </div>

            </div>
            <!-- Footer modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
        });
    });
</script>
<script>
    $().ready(function() {
        if('{{ old('dob') }}') {
            const dob = moment('{{ old('dob') }}', 'DD-MM-YYYY');
            const intern_period = moment('{{ old('intern_period') }}', 'DD-MM-YYYY');
            console.log('{{ old('dob') }}')
            $('#dob').daterangepicker({
                "startDate": dob,
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
            $('#intern_period').daterangepicker({
                "startDate": intern_period,
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
        } else {
            $('#dob').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
            $('#intern_period').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
        }
        
    });
</script>
<script>
    // Inisialisasi popover
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    </script>
@endsection
