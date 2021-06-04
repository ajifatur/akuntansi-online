<!-- Magnify Popup -->
<script type="text/javascript" src="{{ asset('templates/vali-admin/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('templates/vali-admin/vendor/magnific-popup/meg.init.js') }}"></script>

<script type="text/javascript">
    // Sortable
    $(".sortable").sortable({
        placeholder: "ui-state-highlight",
        start: function(event, ui){
            $(".ui-state-highlight").css("height", $(ui.item).outerHeight());
        },
        update: function(event, ui){
            sorting();
        }
    });
    $(".sortable").disableSelection();

    // Update urutan
    function sorting(){
        var ids = [];
        $(".sortable .sortable-item").each(function(key,elem){
            ids.push($(elem).data("id"));
        });
        $.ajax({
            type: "post",
            url: "{{ $url }}",
            data: {_token: "{{ csrf_token() }}", ids: ids},
            success: function(response){
                alert(response);
            }
        });
    }
    
    // Button Magnify Popup
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
        }
    });
</script>