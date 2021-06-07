@extends('template.admin.main')

@section('title', 'Neraca Standard')

@section('content')

<!-- Main -->
<main class="app-content">

	<!-- Filter -->
	<form id="form-filter">
		<input type="hidden" name="grup" value="{{ $user->groupid }}">
		<div class="col-lg-3 col-md-6 mx-auto">
			<div class="form-group row">
	            <p class="m-0">Kantor</p>
				<select name="kantor" class="form-control form-control-sm">
					<option value="0" disabled>KONSOLIDASI</option>
					@foreach($kantor as $data)
					<option value="{{ $data->idkantor }}" {{ $data->idkantor == $user->idkantor ? 'selected' : '' }}>{{ $data->namakantor }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group row">
	            <p class="m-0">Per Tanggal</p>            
	            <div class="input-group">
		            <div class="input-group-prepend">
		            <span class="input-group-text bg-warning"><i class="fa fa-calendar"></i></span>
		            </div>
		            <input type="text" name="tanggal" class="form-control form-control-sm" value="{{ date('d/m/Y', strtotime($tanggal)) }}">
	            </div>
			</div>
			<div class="form-group row">
				<button class="btn btn-sm btn-info" type="submit">Tampilkan</button>
			</div>
		</div>
	</form>

    <!-- Table Data -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
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
            </div>
        </div>
    </div>
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
	// Get neraca on load
    $(window).on("load", function(){
		get_neraca("{{ $user->groupid }}", "{{ $user->idkantor }}", "{{ date('d/m/Y', strtotime($tanggal)) }}");
	});

	// Filter
	$(document).on("submit", "#form-filter", function(e){
		e.preventDefault();
		var grup = $("#form-filter").find("input[name=grup]").val();
		var kantor = $("#form-filter").find("select[name=kantor]").val();
		var tanggal = $("#form-filter").find("input[name=tanggal]").val();
		get_neraca(grup, kantor, tanggal);
	});

	// Function get neraca
	function get_neraca(grup, kantor, tanggal){
		$.ajax({
			type: "get",
			url: "{{ route('admin.balancesheet.standard.data') }}",
			data: {grup: grup, kantor: kantor, tanggal: tanggal},
			success: function(response){
				$(".table tbody").html(response);
			},
			error: function(response){
				console.log(response);
			}
		});
	}
</script>

@endsection

@section('css-extra')

<style type="text/css">
	.table-stretch {font-size: .75rem;}
	.table-stretch tr th {text-align: center; padding: .25rem .5rem;}
	.table-stretch tr td {padding: 0rem .5rem;}
</style>

@endsection