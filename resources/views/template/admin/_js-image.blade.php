<!-- Croppie -->
<script type="text/javascript" src="{{ asset('assets/plugins/croppie/croppie.min.js') }}"></script>

<script type="text/javascript">
    /* Croppie */
    var demo = $('#demo').croppie({
        viewport: {width: {{ $croppieWidth }}, height: {{ $croppieHeight }}},
        boundary: {width: {{ $croppieWidth }}, height: {{ $croppieHeight }}}
    });
    var imageURL;
	
    // Change Input File
    $(document).on("change", "#modal-image .dropzone", function(){
        @if(isset($noCroppie))
          readURLnoCroppie(this);
          $("#modal-image").modal("hide");
        @else
          readURL(this);
          $("#modal-image").modal("hide");
          $("#modal-croppie").modal("show");
        @endif
    });
	
	  // Show Modal Croppie
    $('#modal-croppie').on('shown.bs.modal', function(){
      demo.croppie('bind', {
          url: imageURL
      }).then(function(){
          console.log('jQuery bind complete');
      });
    });
	
	  // Hide Modal Croppie
    $('#modal-croppie').on('hidden.bs.modal', function(){
      $("#modal-image .dropzone").val(null);
    });

    // Crop Image
    $(document).on("click", ".btn-crop", function(e){
      demo.croppie("result", {
          type: "base64",
          format: "png",
          size: {width: {{ $croppieWidth }}, height: {{ $croppieHeight }}}
      }).then(function(response){
        var canvas = document.getElementById("croppie-canvas");
        var ctx = canvas.getContext("2d");
        var image = new Image();
        image.onload = function(){
          ctx.drawImage(image, 0, 0);
          if($(".btn-crop").hasClass("btn-direct-change")){
            $("#form-direct-change input[name=gambar_direct]").val(canvas.toDataURL("image/png"));
            $("#form-direct-change").attr("action", "{{ Auth::user()->is_admin == 1 ? route('admin.user.updatephoto') : route('member.user.updatephoto') }}");
            $("#form-direct-change").submit();
          }
          else{
            $("#img-file").attr("src",canvas.toDataURL("image/png")).removeClass("d-none");
            $("input[name=gambar]").val(canvas.toDataURL("image/png"));
            $("input[name=gambar_url]").val(null);
          }
        };
        image.src = response;
      });
      $("#modal-image .dropzone").val(null);
      $("#modal-croppie").modal("hide");
    });

    function readURL(input){
      if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
              imageURL = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
      }
    }

    function readURLnoCroppie(input){
      if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $("#img-file").attr("src",e.target.result).removeClass("d-none");
            $("input[name=gambar]").val(e.target.result);
            $("input[name=gambar_url]").val(null);
          }
          reader.readAsDataURL(input.files[0]);
      }
    }

    // Load Galeri Gambar
    $(document).on("click", "#pills-galeri-tab", function(){
        $.ajax({
            type: "get",
            url: "{{ Auth::user()->is_admin == 1 ? route('admin.'.$imageType.'.images', ['id' => isset($id) ? $id : '']) : route('member.'.$imageType.'.images', ['id' => isset($id) ? $id : '']) }}",
            success: function(response){
                var result = JSON.parse(response);
                var html = '';
                html += '<div class="row">';
                if(result.length > 0){
                    for(var i = 0; i < result.length; i++){
                        html += '<div class="col-lg-3 col-md-3 col-sm-6 mb-3">';
                        html += '<img class="img-fluid img-thumbnail btn-choose-image" src="{{ asset('assets/images') }}/{{ $imageType }}/'+result[i]+'" title="Pilih Gambar">';
                        html += '<p class="small text-center mb-1">'+result[i]+'</p>';
                        html += '</div>';
                    }
                }
                else{
                    html += '<div class="col-12">';
                    html += '<div class="alert alert-danger text-center">Belum ada gambar tersedia.</div>';
                    html += '</div>';
                }
                html += '</div>';
                $("#pills-galeri").html(html);
            }
        });
    });

    // Button Pilih Gambar
    $(document).on("click", ".btn-choose-image", function(e){
        e.preventDefault();
        var url = $(this).attr("src");
        if($(".btn-crop").hasClass("btn-direct-change")){
          $("#form-direct-change input[name=gambar_direct_url]").val(url);
          $("#form-direct-change").attr("action", "{{ Auth::user()->is_admin == 1 ? route('admin.user.updatephoto') : route('member.user.updatephoto') }}");
          $("#form-direct-change").submit();
        }
        else{
          $("input[name=gambar]").val(null);
          $("input[name=gambar_url]").val(url);
          $("#img-file").attr("src",url).removeClass("d-none");
          $("#modal-image .dropzone").val(null);
          $("#modal-image").modal("hide");
        }
    });
</script>