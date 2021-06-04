<!-- Modal Loader -->
<div class="modal fade" id="modal-loader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5>Loading...</h5>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Loader -->

<script type="text/javascript">
	// Disable button submit when load page
	$(window).on("load", function(){
		$("button[type=submit]").attr("disabled","disabled");
	});

    // Function show loader
    function show_loader(loading_text){
        $("#modal-loader .modal-body h5").text(loading_text);
        $("#modal-loader").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    // Change file
    $(document).on("change", "#file-tools", function(){
        change_file(this, "tools", 64);
        var sizeInKB = Math.round(this.files[0].size / 1024);
        $("input[name=nama_file]").val(this.files[0].name);
        $("#file-name").text(this.files[0].name + " (" + thousand_format(sizeInKB) + " KB)");
    });

	// Submit Form
    $(document).on("click", "#form button[type=submit]", function(e){
        e.preventDefault();
		if($("input[name=nama_file]").val() == null || $("input[name=nama_file]").val() == ''){
			alert("Nama file harus diisi!");
		}
		else{
            show_loader("Mengupload file");
            upload_tools();
        }
	});

    // Upload tools
    function upload_tools(){
        // Append form data
        var file = document.getElementById("file-tools").files[0];
        var formdata = new FormData();
        formdata.append("datafile", file);
        formdata.append("_token", "{{ csrf_token() }}");
        
        // Upload
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progress_handler, false);
        ajax.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                $("input[name=file_konten]").val(this.responseText);
                $("#form").submit();
            }
        };
        ajax.open("POST", "{{ route('admin.file.uploadtools', ['kategori' => $kategori]) }}", true);
        ajax.send(formdata);
    }

    // Progress handler
    function progress_handler(event){
        // Count percentage
        var percent = (event.loaded / event.total) * 100;

        // Progress
        $("#modal-loader .progress-bar").text(Math.round(percent) + '%').css({
            'width' : Math.round(percent) + '%',
            'color' : '#fff',
            'margin-left' : '0px',
            'margin-right' : '0px',
        }).attr('aria-valuenow', Math.round(percent));
    }

</script>