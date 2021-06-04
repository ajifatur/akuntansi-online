<!-- Modal Image -->
<div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pilih Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-upload-tab" data-toggle="pill" href="#pills-upload" role="tab" aria-controls="pills-upload" aria-selected="true">Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-galeri-tab" data-toggle="pill" href="#pills-galeri" role="tab" aria-controls="pills-galeri" aria-selected="false">Galeri</a>
                    </li>
                </ul>
                <div class="tab-content py-2" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-upload" role="tabpanel" aria-labelledby="pills-upload-tab">
                        @if(!isset($noCroppie))
                        <p class="text-center mb-2">Ukuran {{ $croppieWidth }}x{{ $croppieHeight }} pixel.</p>
                        @endif
                        <form id="form-upload" method="post" action="#" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex dropzone-wrapper align-items-center justify-content-center">
                                        <div class="dropzone-desc">
                                            <i class="fa fa-2x fa-download"></i>
                                            <p>Pilih file gambar atau drag ke sini.</p>
                                        </div>
                                        <input type="file" name="file" class="dropzone" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="progress d-none">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-galeri" role="tabpanel" aria-labelledby="pills-galeri-tab"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Image -->

<!-- Modal Croppie -->
<div class="modal fade" id="modal-croppie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Potong Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              @if(!isset($noCroppie))
              <p class="text-center mb-0">Ukuran {{ $croppieWidth }}x{{ $croppieHeight }} pixel.</p>
              @endif
              <div class="table-responsive">
                <div id="demo" class="mt-3"></div>
              </div>
              <canvas class="d-none" id="croppie-canvas" width="{{ $croppieWidth }}" height="{{ $croppieHeight }}"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-crop {{ isset($id_direct) ? 'btn-direct-change' : '' }}"><i class="fa fa-save mr-2"></i>Potong</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Croppie -->

<!-- Form Direct Change -->
<form id="form-direct-change" class="d-none" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ isset($id_direct) ? $id_direct : '' }}">
    <input type="hidden" name="gambar_direct">
    <input type="hidden" name="gambar_direct_url">
</form>
<!-- End Form Direct Change -->