<!-- Modal Quill Source Code -->
<div class="modal fade" id="modal-quill-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-full modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-full">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit HTML</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<pre>
            		<code class="html">
		                <textarea class="form-control" rows="20"></textarea>
		            </code>
		        </pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-set-quill">OK</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Quill Source Code -->

<!-- Quill JS -->
<script type="text/javascript" src="{{ asset('assets/plugins/quill/quill.min.js') }}"></script>

<script type="text/javascript">
	// Generate Quill
	function generate_quill(selector, readonly = false){
		var toolbarOptions = [
			[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
			['bold', 'italic', 'underline', 'strike'],
			[{ 'script': 'sub'}, { 'script': 'super' }],
			['link', 'image', 'video'],
			[{ 'list': 'ordered'}, { 'list': 'bullet' }],
			[{ 'align': [] }],
			[{ 'indent': '-1'}, { 'indent': '+1' }],
			[{ 'direction': 'rtl' }],
			[{ 'color': [] }, { 'background': [] }],
        	['button-html'],
			['clean']     
		];

		// Quill Editor
		var quill = new Quill(selector, {
			modules: {
				toolbar: toolbarOptions
			},
			placeholder: 'Tulis sesuatu...',
			theme: 'snow',
			imageResize: {
				displayStyles: {
					backgroundColor: 'black',
					border: 'none',
					color: 'white'
				},
				modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
			},
			readOnly: readonly
		});

		return quill;
	}

	// Button Toggle HTML
	$(document).on("click", ".ql-button-html", function(e){
		e.preventDefault();
		var html = $(".ql-editor").html();
		$("#modal-quill-code textarea").text(html);
		$("#modal-quill-code").modal("show");
	});

	// Button Set Quill Content
	$(document).on("click", ".btn-set-quill", function(e){
		e.preventDefault();
		var html = $("#modal-quill-code textarea").val();
		$(".ql-editor").html(html);
		$("#modal-quill-code").modal("hide");
	});	
</script>