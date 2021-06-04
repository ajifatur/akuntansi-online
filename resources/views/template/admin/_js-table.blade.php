<!-- DataTable -->
<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/vali-admin/js/plugins/dataTables.bootstrap.min.js') }}"></script>

<!-- Magnify Popup -->
<script type="text/javascript" src="{{ asset('templates/vali-admin/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/vali-admin/vendor/magnific-popup/meg.init.js') }}"></script>

<script type="text/javascript">
    // Generate dataTable
    function generate_datatable(table){
        var config_lang = {
            "lengthMenu": "Menampilkan _MENU_ data",
            "zeroRecords": "Data tidak tersedia",
            "info": "Menampilkan _START_ sampai _END_ dari total _TOTAL_ data",
            "infoEmpty": "Data tidak ditemukan",
            "infoFiltered": "(Terfilter dari total _MAX_ data)",
            "search": "Cari:",
            "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "previous": "<",
            "next": ">",
            },
            "processing": "Memproses data..."
        };
        var datatable = $(table).DataTable({
            "language": config_lang,
            "fnDrawCallback": function(){
                $('.btn-magnify-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    fixedContentPos: true,
                    image: {
                        verticalFit: true
                    },
                    gallery: {
                        enabled: true
                    },
                    callbacks: {
                        elementParse: function(item) {
                            // Change type if video
                            item.type = $(item.el).hasClass("video-link") ? "iframe" : "image";
                        }
                    },
                });
            },
            columnDefs: [
                {orderable: false, targets: 0},
                {orderable: false, targets: -1},
            ],
            order: []
        });
        datatable.on('draw.dt', function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        return datatable;
    }
</script>