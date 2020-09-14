//Slider part
var moveSlider = false;
jQuery(document).ready(function($){
    $(".ba-Slider").each(function(i){
        $(this).children(".slider").mousedown(function(){
             moveSlider = true;
            $(this).parent().children("#before").removeClass("ease");
            $(this).removeClass("ease");
        });
        $(this).children(".slider").mouseup(function(){
            moveSlider = false;
            $(this).parent().children("#before").addClass("ease");
            $(this).addClass("ease");
            var minmax = $(this).parent().width() / 8;
            if($(this).parent().children("#before").width() > $(this).parent().width() - minmax){
                $(this).parent().children("#before").width("100%");
                var sOffset = $(this).parent().width() - 16.5;
                $(this).css("left", sOffset);
            }else if($(this).parent().children("#before").width() < minmax){
                $(this).parent().children("#before").width(0);
                var sOffset = -16.5;
                $(this).css("left", sOffset);
             }
            
        });
        
        $(this).mouseup(function(){
            moveSlider = false;
            $(this).children("#before").addClass("ease");
            $(this).children(".slider").addClass("ease");
            var minmax = $(this).width() / 8;
            if($(this).children("#before").width() > $(this).width() - minmax){
                $(this).children("#before").width("100%");
                var sOffset = $(this).width() - 16.5;
                $(this).children(".slider").css("left", sOffset);
            }else if($(this).children("#before").width() < minmax){
                $(this).children("#before").width(0);
                var sOffset = -16.5;
                $(this).children(".slider").css("left", sOffset);
             }
            
            
        });
        $(this).mousemove(function(e){
            if(moveSlider == true){
                var pOffset = $(this).offset(); 
                var mouseX = e.pageX - pOffset.left;
                $(this).children("#before").width(mouseX - 0.5);
                var sOffset = mouseX - 16.5;
                $(this).children(".slider").css("left", sOffset);
            }
            
        });
    });
});

//________________________DELETE____________________________//
$('#customers > tbody').on('click', '.button_delete', function(event) {
    const this$ = $(event.currentTarget);
    const itemId = this$.siblings('.id_all').val();
    $('#ModalDelete').attr('item-id', itemId);
});

$('.btn-delete-item').on('click', function(event) {
    const itemId = $('#ModalDelete').attr('item-id');
    $.ajax({
        method: 'post',
        url: '/wp-content/plugins/BSBA/back/delete.php',
        data:{
            'item_id': itemId,
        },
        success(data){
            if(data.success){
                $(`.item-${itemId}`).remove();
            }
        }
    });
  
});

//_________________________EDIT__________________________//
$('#customers').on('click', '.button_edit', function() {
    var itemId = $(this).parent().find(".id_all").val();
    $('#ModalEdit .btn-edit-item').data('item-id', itemId);
});
   

$('#modal-form').on('submit', function(event) {
    event.preventDefault();
    let formData = new FormData($(this)[0]);
    let itemId = $('#ModalEdit .btn-edit-item').data('item-id');
    formData.append('item_id', itemId);
    
        $.ajax({
            method: 'post',
            url: "/wp-content/plugins/BSBA/back/update.php", // form$.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
        }).done(function(data) {

            $('#customers > tbody').html(getTBodyHtml(data));
            $('#ModalEdit').modal('hide');
        }).fail(function() {

        }).always(function() {
            formData.reset;
        });
});

    
    //create html for tbody part____________________________
    function getTBodyHtml(data)
    {
        let html = '';

        JSON.parse(data).forEach(function(item){
            html += `
                <tr class="item-${item.id}">
                    <td>
                        <img src="/wp-content/plugins/BSBA/storage/before/${item.pic_name}" alt="">
                    </td>
                    <td>
                        <img src="/wp-content/plugins/BSBA/storage/after/${item.pic_name}" alt="">
                    </td>
                    <td>
                        ${getBlockName(item.pic_name)}
                    </td>
                    <td style="text-align: center;">
                        <input  type="hidden" class="id_all" value="${item.id}">
                        <button type="button" data-toggle="modal" data-target="#ModalEdit" class="button_edit"><i class="fas fa-pen"></i></button>
                        <button type="button" data-toggle="modal" data-target="#ModalDelete" class="button_delete"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>`;
            });	

        return html;
    }

    //______________________________
    function getBlockName(str)
    {
        arr = str.split('_');
        return arr[1].split('.')[0];
    }