$(".datepicker").datepicker();



/* Tooltip */
$(".btn[title]").attr({
    'data-toggle': "tooltip",
    'data-placement': "bottom"
});
$(".btn.btn-outline-success[title]").attr('data-custom-class', "tooltip-success");
$(".btn.btn-outline-primary[title]").attr('data-custom-class', "tooltip-primary");
$(".btn.btn-outline-info[title]").attr('data-custom-class', "tooltip-info");
$(".btn.btn-outline-warning[title]").attr('data-custom-class', "tooltip-warning");
$(".btn.btn-outline-danger[title]").attr('data-custom-class', "tooltip-danger");





$('.edit_category_popup').hide();
$(document).on('click', '.edit_category_popup_btn', function () {
    var bbq_cat_id = $(this).data('bbq_cat_id');
    var categoryname = $(this).data('categoryname');
    $("#bbq_cat_id").val(bbq_cat_id);
    $("#category_name").val(categoryname);
    $('.edit_category_popup').show().addClass('popup_active');
});

$(document).on('click', '.close_category_popup_btn', function () {
    $('.edit_category_popup').hide().removeClass('popup_active');
});


$('.delete_popup').hide();
$(document).on('click', '.open_delete_popup_btn', function () {
       var data_href = $(this).data('href');
    //   alert(data_href);
        $('.delete_button_div').html('<button class="btn btn-outline-primary mr-4 close_delete_popup_btn">Cancel</button><a href="' + data_href + '" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a>');
        $('.delete_popup').show().addClass('popup_active');
        return false;
    
});
$(document).on('click', '.close_delete_popup_btn', function () {
    $('.delete_popup').hide().removeClass('popup_active');
});




function gallery_img_preview (){

    $('.form-group').each(function(){
        var inpu_file = $(this).find('input[type="file"]');
        var gallery_images = $(this).find('.gallery_preview ul');

        function readURL(input) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                
                    reader.onload = function (e) {
                        $(gallery_images).append(`<li>
                            <img src="${e.target.result}" alt="">
                            <span class="remove_gallery_item_icon removeImage"><i class="fa fa-remove"></i></span> 
                        </li>`);
                        
                    };

                    reader.readAsDataURL(input.files[i]);
                }
                
            }
        }
        $(inpu_file).change(function () {
            readURL(this);
        });
    });

     $(document).on('click', '.removeImage', function(){
//         alert('test');   
//         $(this).parents('li').remove();
$(this).closest('li').remove();
     });
}
gallery_img_preview();



if ($(".myTinyMceEditor").length) {
    tinymce.init({
      selector: '.myTinyMceEditor',
      height: 300,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
      ],
      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | codesample help',
      image_advtab: true,
      templates: [{
          title: 'Test template 1',
          content: 'Test 1'
        },
        {
          title: 'Test template 2',
          content: 'Test 2'
        }
      ],
      content_css: []
    });
  }



