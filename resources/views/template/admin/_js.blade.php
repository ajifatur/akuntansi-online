<!-- Main JavaScript -->
<script src="{{ asset('templates/vali-admin/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('templates/vali-admin/js/popper.min.js') }}"></script>
<script src="{{ asset('templates/vali-admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('templates/vali-admin/js/main.js') }}"></script>

<!-- The javascript plugin to display page loading on top -->
<script src="{{ asset('templates/vali-admin/js/plugins/pace.min.js') }}"></script>

<script type="text/javascript">
    $(function(){
        // Breadcrumb
        breadcrumb();
        // Sidebar Scroll
        sidebar_scroll();
        // Manage Screen
        manage_screen();
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();
    });
	
	$(window).on("resize", function(){
        // Sidebar Scroll
        sidebar_scroll();
		// Manage Screen
		manage_screen();
	});

    // Button Show Modal Image
    $(document).on("click", ".btn-image", function(e){
        e.preventDefault();
        $("#modal-image").modal("show");
    });
    
    // Button Browse File
    $(document).on("click", ".btn-browse-file", function(e){
        e.preventDefault();
        $(this).parents(".form-group").find("input[type=file]").trigger("click");
    });

    // Button Delete
    $(document).on("click", ".btn-delete", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete input[name=id]").val(id);
            $("#form-delete").submit();
        }
    });

    // Button Delete Folder
    $(document).on("click", ".btn-delete-folder", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete-folder input[name=id]").val(id);
            $("#form-delete-folder").submit();
        }
    });

    // Button Delete File
    $(document).on("click", ".btn-delete-file", function(e){
        e.preventDefault();
        var id = $(this).data("id");
        var ask = confirm("Anda yakin ingin menghapus data ini?");
        if(ask){
            $("#form-delete-file input[name=id]").val(id);
            $("#form-delete-file").submit();
        }
    });

    // Button Forbidden
    $(document).on("click", ".btn-forbidden", function(e){
        e.preventDefault();
        alert("Anda tidak mempunyai akses untuk membuka halaman ini!");
    });

    // Button Disabled
    $(document).on("click", ".btn-disabled", function(e){
        e.preventDefault();
        alert("Tombol ini tidak ada fungsinya!");
    });

    // Button Toggle Password
    $(document).on("click", ".btn-toggle-password", function(e){
        e.preventDefault();
        if(!$(this).hasClass("show")){
            $(this).parents(".form-group").find("input[type=password]").attr("type","text");
            $(this).find(".fa").removeClass("fa-eye").addClass("fa-eye-slash");
            $(this).addClass("show");
        }
        else{
            $(this).parents(".form-group").find("input[type=text]").attr("type","password");
            $(this).find(".fa").removeClass("fa-eye-slash").addClass("fa-eye");
            $(this).removeClass("show");
        }
    });

    // Mouse over treeview
    $(document).on("mouseover", ".treeview", function(){
        if($("body").hasClass("sidenav-closed")){
            $(this).find(".app-menu__item").css({"border-top-right-radius":"0","border-bottom-right-radius":"0"});
        }
    });

    // Mouse leave treeview
    $(document).on("mouseleave", ".treeview", function(){
        if($("body").hasClass("sidenav-closed")){
            $(this).find(".app-menu__item").css({"border-top-right-radius":".5em","border-bottom-right-radius":".5em"});
        }
    });
    
    // Input number only
    $(document).on("keypress", ".number-only", function(e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode >= 48 && charCode <= 57) { 
            // 0-9 only
            return true;
        }
        else{
            return false;
        }
    });

    // Input Thousand Format
    $(document).on("keyup", ".thousand-format", function(){
        var value = $(this).val();
        $(this).val(thousand_format(value, ""));
    });

    // Events when modal is hiding
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find("input[type=file]").val(null);
        $(this).find("img").removeAttr("src").addClass("d-none");
    });

    // Thousand format
    function thousand_format(angka, prefix = ''){
        var isPositive = angka >= 0 ? true : false;
        var number_string = angka.toString().replace(/\D/g,'');
        number_string = (number_string.length > 1) ? number_string.replace(/^(0+)/g, '') : number_string;
        var split = number_string.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
     
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return isPositive ? prefix + "" + rupiah : prefix + "-" + rupiah;
    }

    // Get file extension
    function get_file_extension(filename){
        var split = filename.split(".");
        var extension = split[split.length - 1];
        return extension;
    }

    // Validate extension
    function validate_extension(filename, filetype){
        var extensions = {
            'pdf': ['pdf'],
            'image': ['jpg', 'jpeg', 'png', 'bmp', 'svg'],
            'tools': ['jpg', 'jpeg', 'png', 'bmp', 'svg', 'gif', 'ico', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx', 'txt', 'json', 'sql', 'zip', 'rar', 'mp3', 'wav'],
            'signature': ['png']
        };

        var ext = get_file_extension(filename);
        var allowedExtensions = extensions[filetype];
        for(var i in allowedExtensions){
            if(ext == allowedExtensions[i]) return true;
        }
        return false;
    }

    // Function change file
    function change_file(input, filetype, maxsize){
        // Convert max file size to bytes
        var maxByte = maxsize * 1028 * 1028;

        // Validation
        if(input.files && input.files[0]){
            // If file is more than limit
            if(input.files[0].size > maxByte){
                alert("Ukuran file terlalu besar dan melebihi batas maksimum! Maksimal "+maxsize+" MB");
                $(input).val(null);
                $(input).parents("form").find("button[type=submit]").attr("disabled","disabled");
            }
            // If extension is not allowed
            else if(!validate_extension(input.files[0].name, filetype)){
                alert("Ekstensi file tidak diizinkan!");
                $(input).val(null);
                $(input).parents("form").find("button[type=submit]").attr("disabled","disabled");
            }
            // If success
            else{
                if(filetype == "image" || filetype == "signature") read_image_url(input);
                $(input).parents("form").find("button[type=submit]").removeAttr("disabled");
            }
        }
    }

    // Read image URL (Base 64)
    function read_image_url(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $(input).parents(".form-group").find("img").attr("src", e.target.result).removeClass("d-none");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Sidebar scroll
    function sidebar_scroll(){
        var activeItem = $(".app-menu .app-menu__item.active").length == 1 ? $(".app-menu .app-menu__item.active") : $(".app-menu .treeview-item.active").parents(".treeview");
        if(activeItem.length > 0){
            if(activeItem.offset().top + 58 > $(window).height())
                $(".app-sidebar").animate({scrollTop: activeItem.offset().top - 58}, 1000);
        }
    }
	
	// Manage screen
	function manage_screen(){
		screen.width <= 768 ? $("body").addClass("sidenav-closed") : $("body").removeClass("sidenav-closed");
	}

    // Breadcrumb
    function breadcrumb(){
        var html = $(".app-title .breadcrumb").html();
        $(".breadcrumb-nav").html(html);
    }
</script>
<!-- Go Top -->
<script type="text/javascript">
var btn = $('#top-button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});
</script>
<!-- Sticky Navbar -->
<script type="text/javascript">
$(function() {
    //caches a jQuery object containing the header element
    var header = $(".app-header");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            header.addClass("nav-sticky");
        } else {
            header.removeClass("nav-sticky")
        }
    });
});
</script>