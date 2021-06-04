@extends('template.admin.main')

@section('title', 'Edit Package')

@section('content')

<!-- Main -->
<main class="app-content">

    <!-- Breadcrumb -->
    @include('template.admin._breadcrumb', ['breadcrumb' => [
        'title' => 'Edit Package',
        'items' => [
            ['text' => 'Package', 'url' => route('admin.package.index')],
            ['text' => 'Edit Package', 'url' => '#'],
        ]
    ]])
    <!-- /Breadcrumb -->

    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <!-- Tile -->
            <div class="tile">
                <!-- Tile Body -->
                <div class="tile-body">
                    <form id="form" method="post" action="{{ route('admin.package.update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $package->id_package }}">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama Package <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="package_name" class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" value="{{ $package->package_name }}">
                                @if($errors->has('package_name'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('package_name')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Versi <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="package_version" class="form-control {{ $errors->has('package_version') ? 'is-invalid' : '' }}" value="{{ $package->package_version }}">
                                @if($errors->has('package_version'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('package_version')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"></label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-theme-1"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
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