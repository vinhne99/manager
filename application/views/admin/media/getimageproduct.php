<div id="image-show">
    <?php if (!empty($image)):
        foreach ($image as $img): ?>
            <div class="img-show img-<?php echo $img->id; ?>">
                <div class="loading-img"></div>
                <span><a onclick="delete_img(<?php echo $img->id; ?>)" class="delete" title="Xóa hình" href="javascript:;"><i class="fa fa-remove"></i></a></span>
                <img src="<?php echo base_url();  ?>uploads/images/sanpham/50/<?php echo $img->image_path; ?>">
                <div class="image-default <?php if ($img->default == 1) echo 'active';  ?>" onclick="image_default(<?php echo $img->id; ?>);"></div>
            </div>
        <?php endforeach;
    endif;
    ?>
    <div class="clearfix"></div>
    <button id="upload" type="button" class="btn btn-info">Thêm hình ảnh</button>  <span class="load-upload"></span>
</div>

<script>
    function image_default(img_id){
        $(".img-show" ).find("div.image-default").removeClass("active");
        $(".img-" + img_id).find("div.image-default").addClass("active");
        $("input[name='image_default']").val(img_id);
        <?php if (isset($product)) : ?>
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/media/update_default_image",
            data: { 'img_id' : img_id , 'parent_id' : <?php echo $product->id; ?>},
            dataType: 'html',
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                load_product(<?php if ($this->session->userdata('page_product')) echo $this->session->userdata('page_product'); else echo 0; ?>);
            }
        });
        <?php endif; ?>

    }
    $(function(){
        var btnUpload=$('#upload');
        new AjaxUpload(btnUpload, {
            action: '<?php echo base_url();	?>admin/media/upload_product',
            name: 'uploadfile',
            data: { <?php if (isset($product)) { echo '"id":' . $product->id; }  ?> },
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    alert('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
                $(".load-upload").html('Đang tải hình ảnh...');
                set_disable_form_element($(".form-tour"));
            },
            onComplete: function(file, response){
                //On completion clear the status
                //Add uploaded file to list
                var data = response.split('-::-');
                $(".load-upload").html('');
                set_enable_form_element($(".form-tour"));
                if(data==="error"){
                    //error return
                    alert('error');
                } else{
                    $("#image").append(","+data[0]);
                    $("#image-show").prepend('<div  class="img-show img-' + data[0]+ '"> <div class="loading-img"></div><span><a onclick="delete_img(' + data[0]+ ')" class="delete" title="Xóa hình" href="javascript:;"><i class="fa fa-remove"></i></a></span><img src="<?php echo base_url(); ?>' + data[1] +'" /><div class="image-default" onclick="image_default(' + data[0]+ ');"></div></div>');

                }

            }
        });
    });


    function delete_img(id){
        $(".img-" + id).find(".loading-img").show();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/media/delete_image",
            data: {'tour_id': '<?php  if (isset($product)) echo $product->id;  ?>',
                'id' : id
            },
            dataType: 'html',
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $(".img-" + id).remove();
                new PNotify({
                    title: 'Thông báo thành công',
                    text: "Bạn vừa xóa một hình ảnh",
                    type: 'success'
                });
                load_product(<?php if ($this->session->userdata('page_product')) echo $this->session->userdata('page_product'); else echo 0; ?>);
            }
        });
    }
</script>