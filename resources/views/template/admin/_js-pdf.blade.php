<div class="result-pdf d-none"></div>

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

<!-- PDF JS -->
<script type="text/javascript" src="{{ asset('assets/plugins/pdf.js/pdf.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/pdf.js/pdf.min.worker.js') }}"></script>

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

    /* Upload File */
    $(document).on("click", ".btn-file-pdf", function(e){
        e.preventDefault();
        $("#file-pdf").trigger("click");
    });

    $(document).on("change", "#file-pdf", function(){
        // Ukuran maksimal upload file
        var max = 16;

        // Validasi
        if(this.files && this.files[0]) {
            // Jika ukuran melebihi batas maksimum
            if(this.files[0].size > (max * 1024 * 1024)){
                alert("Maksimal file "+max+" MB!");
                $(".progress").addClass("d-none");
                $("#file-pdf").val(null);
            }
            // Jika ekstensi tidak diizinkan
            else if(!validate_extension(this.files[0].name, "pdf")){
                alert("Ekstensi file tidak diizinkan!");
                $(".progress").addClass("d-none");
                $("#file-pdf").val(null);
            }
            // Validasi sukses
            else{
				show_PDF(URL.createObjectURL($("#file-pdf").get(0).files[0]));
                $("input[name=nama_file]").val(this.files[0].name);
                $(".progress-pdf").removeClass("d-none");
                $(".progress-pdf .progress").removeClass("d-none");
                $(".progress-pdf .progress-bar").text('0%').css({
                    'width' : '0%',
                    'color' : '#333',
                    'margin-left' : '5px',
                    'margin-right' : '5px',
                }).attr('aria-valuenow', 0).removeClass("bg-success");
            }
        }
    });

	var currPage = 1; //Pages are 1-based not 0-based
	var numPages = 0;
	var thePDF = null;

	function show_PDF(pdf_url) {
		//This is where you start
		PDFJS.getDocument({url : pdf_url}).then(function(pdf) {
			//Set PDFJS global object (so we can easily access in our page functions
			thePDF = pdf;

			//How many pages it has
			numPages = pdf.numPages;

			//Start with first page
			pdf.getPage(1).then(handle_pages);
		});
	}

	function handle_pages(page){
		// This gives us the page's dimensions at full scale
		var viewport = page.getViewport(1.5);

		// We'll create a canvas for each page to draw it on
		var canvas = document.createElement("canvas");
		canvas.style.display = "none";
		var context = canvas.getContext('2d');
		canvas.height = viewport.height;
		canvas.width = viewport.width;

		// Draw it on the canvas
		page.render({canvasContext: context, viewport: viewport});

		// Add it to the web page
		$(".result-pdf").append(canvas);
        $(".progress-pdf .total-page").text(currPage);
		// $("canvas").addClass("mb-2 mx-auto").css("width", "100%");

		progress_handler(currPage, numPages);

		// Move to next page
		currPage++;
		if(thePDF !== null && currPage <= numPages) thePDF.getPage(currPage).then(handle_pages);
	}

	function progress_handler(loaded, total){
		// hitung prosentase
		var percent = (loaded / total) * 100;

		// menampilkan prosentase ke komponen progress bar
		$(".progress-pdf .progress-bar").text(Math.round(percent) + '%').css({
			'width' : Math.round(percent) + '%',
			'color' : '#fff',
			'margin-left' : '0px',
			'margin-right' : '0px',
		}).attr('aria-valuenow', Math.round(percent));

		// jika sudah mencapai 100% akan mengganti warna background menjadi hijau
		if(Math.round(percent) == 100){
			$("input[name=pdf]").val(1);
			$(".progress-pdf .progress-bar").addClass("bg-success");
            $(".btn-file-pdf").attr("disabled","disabled");
            $("button[type=submit]").removeAttr("disabled");
			$("#file-pdf").val(null);
		}
	}

	// Submit Form
    $(document).on("click", "#form button[type=submit]", function(e){
        e.preventDefault();
		if($("input[name=nama_file]").val() == null || $("input[name=nama_file]").val() == ''){
			alert("Nama file harus diisi!");
		}
		else{
            show_loader("Mengupload file PDF");
            var array = [];
            var d = new Date();
            var n = d.getTime();
            var i = 1;
            var total = $(".progress-pdf .total-page").text();
            // total = total.parseInt();
            canvases = $(".result-pdf canvas");
            canvases.each(function(key,elem){
                var code = $(elem).get(0).toDataURL();
                $.ajax({
                    type: 'post',
                    url: "{{ route('admin.file.uploadpdf', ['kategori' => $kategori]) }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: code,
                        key: key,
                        name: n,
                    },
                    success: function(){
                        if(i == canvases.length){
                            $("input[name=file_konten]").val(n);
                            $("#form").submit();
                        }
                        var percentage = Math.round((i / total) * 100);
                        $("#modal-loader .progress-bar").text(percentage + "%").css("width", percentage + "%");
                        i++;
                    }
                });
            });
        }
	});
</script>