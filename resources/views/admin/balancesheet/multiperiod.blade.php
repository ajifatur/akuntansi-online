@extends('template.admin.main')

@section('title', 'Neraca Multi Periode')

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
	            <p class="m-0">Dari</p>
				<select name="bulan1" class="form-control form-control-sm">
					@foreach(array_indo_month() as $key=>$data)
					<option value="{{ $key+1 }}" {{ $key+1 == $bulan1 ? 'selected' : '' }}>{{ $data }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group row">
	            <p class="m-0">Sampai</p>
				<select name="bulan2" class="form-control form-control-sm">
					@foreach(array_indo_month() as $key=>$data)
					<option value="{{ $key+1 }}" {{ $key+1 == $bulan2 ? 'selected' : '' }}>{{ $data }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group row">
	            <p class="m-0">Tahun</p>
				<select name="tahun" class="form-control form-control-sm">
					@for($y=date('Y'); $y>=2016; $y--)
					<option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
					@endfor
				</select>
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
                        <table class="table table-hover table-bordered table-stretch"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- /Main -->

@endsection

@section('js-extra')

<script type="text/javascript">
	// Get neraca on load
    $(window).on("load", function(){
        get_neraca("{{ $user->groupid }}", "{{ $user->idkantor }}", "{{ $bulan1 }}", "{{ $bulan2 }}", "{{ $tahun }}");
    });

	// Filter
	$(document).on("submit", "#form-filter", function(e){
		e.preventDefault();
		var grup = $("#form-filter").find("input[name=grup]").val();
		var kantor = $("#form-filter").find("select[name=kantor]").val();
		var bulan1 = $("#form-filter").find("select[name=bulan1]").val();
		var bulan2 = $("#form-filter").find("select[name=bulan2]").val();
		var tahun = $("#form-filter").find("select[name=tahun]").val();
		get_neraca(grup, kantor, bulan1, bulan2, tahun);
	});

	// Function get neraca
	function get_neraca(grup, kantor, bulan1, bulan2, tahun){
		$.ajax({
			type: "get",
			url: "{{ route('admin.balancesheet.multiperiod.data') }}",
			data: {grup: grup, kantor: kantor, bulan1: bulan1, bulan2: bulan2, tahun: tahun},
			success: function(response){
				$(".table").html(response);
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