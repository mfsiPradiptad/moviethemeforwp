jQuery(document).ready(function($) {
    $('.datepicker').datepicker({ dateFormat: "mm/dd/yy" });

    $('.fet_checkbox').on('click', function() {

        var hid = $(this).attr('id');
        hid += '_hidden';
        if ($(this).is(':checked')) {
            $('#'+hid).val(1);
        } else {
            $('#'+hid).val(0);
        }
    });

    $( '.featured-class' ).on( 'click', function(e) {
        var datas = $(this).closest('td').find( 'a' );
        var id = datas.data('id');
        var module = datas.data('module'); ;
        var posts = datas.data('posts');

        $.ajax({
            type : "post",
            dataType : "json",
            url : ajaxurl,
            data : {action: "remove_ajax", id : id, module : module, posts : posts},
            success: function(response) {
                if( response.status == 1 ){
                    if( module == 'movies-banner' ) {
                        datas.parents("tr").hide();
                    } else {
                        datas.html('N/A');
                        datas.removeClass('featured-class');
                    }
                    
                } else {
                    alert('Can not process your request.')
                }         
            }
         });
        
    });

    $( '.add-picks-btn' ).on( 'click', function(e) {
        var posts = 'movies';

        $.ajax({
            type : "post",
            dataType : "json",
            url : ajaxurl,
            data : {action: "add_picks_ajax", posts : posts},
            success: function(response) {
                console.log(response);      
            }
         });
    });

});
