@extends('template.admin.main')

@section('title', 'Neraca Standard')

@section('content')

<!-- Main -->
<main class="app-content">

	<!-- Filter -->
	<form id="form-filter">
	    <div class="row align-items-end mb-3">
	        <div class="col-lg-3"></div>
	        <div class="col-lg-3">
	            <p class="m-0">Kantor</p>
				<select class="form-control form-control-sm">
					<option value="0" disabled>Konsolidasi</option>
					@foreach($kantor as $data)
					<option value="{{ $data->idkantor }}" {{ $data->idkantor == $user->idkantor ? 'selected' : '' }}>{{ $data->namakantor }}</option>
					@endforeach
				</select>
	        </div>
	        <div class="col-lg-3">
	            <p class="m-0">Per Tanggal</p>            
	            <div class="input-group">
		            <div class="input-group-prepend">
		            <span class="input-group-text bg-warning"><i class="fa fa-calendar"></i></span>
		            </div>
		            <input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm" value="{{ date('d/m/Y', strtotime($tanggal)) }}" readonly>
	            </div>
	        </div>
	        <div class="col-lg-3 text-right mt-2 mt-lg-0"><button class="btn btn-info" type="submit">Terapkan</button></div>
	    </div>
	</form>

    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <!-- Tile -->
            <div class="tile">
                <!-- Tile Body -->
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-stretch">
                            <thead class="bg-warning">
                                <tr>
                                    <th>Deskripsi</th>
                                    <th width="150">Balance</th>
                                    <th width="150">Total Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td colspan="3" align="center">Loading...</td>
                            	</tr>
                            </tbody>
                        </table>
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

@endsection

@section('js-extra')

<script src="{{ asset('templates/vali-admin/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Datepicker
        $("input[name=tanggal]").datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true
        });
    });
</script>
<script type="text/javascript">
	$(function(){
		var tanggal = "{{ date('d/m/Y', strtotime($tanggal)) }}";
		var kantor = "{{ $user->idkantor }}";
		var grup = "{{ $user->groupid }}";
		$.ajax({
			type: "get",
			url: "{{ route('admin.balancesheet.standard.data') }}",
			data: {tanggal: tanggal, kantor: kantor, grup: grup},
			success: function(response){
				$(".table tbody").html(response);
			},
			error: function(response){
				console.log(response);
			}
		})
	})
</script>

@endsection

@section('css-extra')

<style type="text/css">
	.table-stretch {font-size: .75rem;}
	.table-stretch tr th {text-align: center; padding: .25rem .5rem;}
	.table-stretch tr td {padding: 0rem .5rem;}
</style>

@endsection