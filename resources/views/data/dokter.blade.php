@extends('layouts.master')
@section('breadcrumb')
    <h2>Dokter</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home.index') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            Data
        </li>
        <li class="breadcrumb-item active">
            <strong>Dokter</strong>
        </li>
    </ol>
@endsection
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" >
<style>
    .borderless td, .borderless th {
        border: none;
        width: 33%;
        padding-left: 6px;
        padding-right: 6px;
    }
    .borderless {
  	    width: 100%;
    }
</style>
@endsection

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="text-right mr-3">
                            <button class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#CreateDokterModal">
                                <strong>Tambah Dokter</strong>
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="110">No Dokter</th>
                                    <th width="170">Nama</th>
                                    <th width="110">Jenis Kelamin</th>
                                    <th width="200" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Dokter Modal -->
<div class="modal fade" id="CreateDokterModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Dokter</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <form id="submitData">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-body">
                <table class="borderless">
                <tr>
                    <td>        
                        <div class="form-group">
                            <label>No Dokter :</label>
                            <input type="text" class="form-control" name="no_dok" id="no_dok">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>Nama Dokter :</label>
                            <input type="text" class="form-control" name="nama_dok" id="nama_dok">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label>Jenis Kelamin :</label>
                            <select class="form-control mb-1" name="jns_dok" id="jns_dok">
                                <option value="Laki-Laki" >Laki-Laki</option>
                                <option value="Perempuan" >Perempuan</option>
                            </select>
                        </div>
                    </td>
                </tr>
                </table>

                </form>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong> Dokter was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitCreateDokterForm">Tambah</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Dokter Modal -->
<div class="modal" id="EditDokterModal">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Dokter</h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div id="EditDokterModalBody">
                    
                </div>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong> Dokter was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditDokterForm">Ubah</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Dokter Modal -->
<div class="modal fade" id="DeleteDokterModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Dokter</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Apakah kamu yakin ingin menghapus Dokter ini?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteDokterForm">Ya</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script> -->
<script src="{{ asset('/js/date.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        // init datatable.
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('get-dokter') }}',
            columns: [
                {data: 'no_dok', name: 'no_dok'},
                {data: 'nama_dok', name: 'nama_dok'},
                {data: 'jns_dok', name: 'jns_dok'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

        // Create Dokter Ajax request.
        $('#SubmitCreateDokterForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('dokter.store') }}",
                method: 'post',
                data: {
                    no_dok: $('#no_dok').val(),
                    nama_dok: $('#nama_dok').val(),
                    jns_dok: $('#jns_dok').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#CreateDokterModal').modal('hide');
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        // Get single Dokter in EditModel
        $('.modelClose').on('click', function(){
            $('#EditDokterModal').hide();
        });
        var id;
        $('body').on('click', '#getEditDokterData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "dokter/"+id+"/edit",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditDokterModalBody').html(result.html);
                    $('#EditDokterModal').show();
                }
            });
        });

        // Update Dokter Ajax request.
        $('#SubmitEditDokterForm').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "dokter/"+id,
                method: 'PUT',
                data: {
                    no_dok: $('#editNo_dok').val(),
                    nama_dok: $('#editNama_dok').val(),
                    jns_dok: $('#editJns_dok').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        location.reload();
                        setInterval(function(){ 
                            $('.alert-success').hide();
                            $('#EditDokterModal').hide();
                        }, 2000);
                    }
                }
            });
        });

        // Delete Dokter Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteDokterForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "dokter/"+id,
                method: 'DELETE',
                success: function(result) {
                    $('.datatable').DataTable().ajax.reload();
                    setInterval(function(){ 
                        // $('.datatable').DataTable().ajax.reload();
                        $('#DeleteDokterModal').hide();
                        location.reload();
                    }, 1000);
                }
            });
        });
    });
</script>
@endsection