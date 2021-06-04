@extends('template.admin.main')

@section('title', 'Jurnal Umum')

@section('content')

<!-- Main -->
<main class="app-content">
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <!-- Tile -->
            <div class="tile">
                <!-- Tile Title -->
                <div class="tile-title-w-btn">
                    <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-theme-1"><i class="fa fa-plus mr-2"></i> Tambah Data</a>
                    </div>
                </div>
                <!-- /Tile Title -->
                <!-- Tile Body -->
                <div class="tile-body">
                    @if(Session::get('message') != null)
                    <div class="alert alert-dismissible alert-success">
                        <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="20"><input type="checkbox"></th>
                                    <th width="60">No. Ref.</th>
                                    <th width="100">Tanggal Jurnal</th>
                                    <th width="70">Jumlah</th>
                                    <th>Keterangan</th>
                                    <th width="50">Status</th>
                                    <th width="50">Locked</th>
                                    <th width="60">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kas as $data)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $data->jvnumber }}</td>
                                    <td>
                                        <span class="d-none">{{ $data->inputtime }}</span>
                                        {{ date('d/m/Y', strtotime($data->inputtime)) }}
                                    </td>
                                    <td align="right">{{ number_format($data->jvamount,0,',',',') }}</td>
                                    <td>{{ $data->transdescription }}</td>
                                    <td><a href="#" class="btn btn-sm btn-{{ $data->status == 1 ? 'success' : 'danger' }}">{{ $data->status == 1 ? 'POSTED' : 'UNPOSTED' }}</a></td>
                                    <td><a href="#" class="btn btn-sm btn-{{ $data->locked == 1 ? 'success' : 'danger' }}">{{ $data->locked == 1 ? 'LOCKED' : 'UNLOCKED' }}</a></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-sm btn-info btn-detail" data-id="{{ $data->jvid }}" data-toggle="tooltip" title="Detail"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $data->jvid }}" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form id="form-delete" class="d-none" method="post" action="#">
                            {{ csrf_field() }}
                            <input type="hidden" name="id">
                        </form>
                    </div>
                </div>
                <!-- /Tile Body -->
            </div>
            <!-- /Tile -->
        </div>
        <!-- /Column -->
    </div>
    <!-- /Row -->
</main>
<!-- /Main -->

<!-- Modal Detail -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Kas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">
				<div class="table-responsive">
                	<table class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th width="70">Kode</th>
								<th>Nama Akun</th>
								<th width="70">Debit</th>
								<th width="70">Kredit</th>
								<th>Keterangan</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
        </div>
    </div>
</div>
<!-- Modal Detail -->

@endsection

@section('js-extra')

@include('template.admin._js-table')

<script type="text/javascript">
    // DataTable
    generate_datatable("#dataTable");
	
	// Button Detail
	$(document).on("click", ".btn-detail", function(e){
		e.preventDefault();
		var id = $(this).data("id");
		$("#modal-detail").modal("show");
	});
</script>

@endsection

@section('css-extra')

<style type="text/css">
	/* #dataTable tr {cursor: pointer;} */
</style>

@endsection