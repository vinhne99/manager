<form class="form-product form-horizontal form-label-left" >
    <span class="response-message"></span>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tiêu đề: <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" placeholder="Vui lòng nhập tên sản phẩm" value="<?php if (isset($post)) echo $post->title;  ?>" name="title" required="required" class="form-control col-md-7 col-xs-12" >
        </div>
    </div>
    <!--
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Danh mục: <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <select name="parent_id" class="form-control col-md-5 col-xs-12">
                <option value="">--Chọn danh mục--</option>
                <?php echo $tree; ?>
            </select>
        </div>
    </div> -->
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mô tả:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <textarea id="description"><?php  if (isset($post))  echo $post->description;  ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hình ảnh:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <div style="opacity: 0;" id="image"><?php if (isset($image)) : foreach ($image as $img){ echo ',' . $img->id; } endif; ?></div>
            <div id="image-show">
                <?php if (isset($image)):
                    foreach ($image as $img): ?>
                        <div class="img-show img-<?php echo $img->id; ?>">
                            <div class="loading-img"></div>
                            <span><a onclick="delete_img(<?php echo $img->id; ?>)" class="delete" title="Xóa hình" href="javascript:;"><i class="fa fa-remove"></i></a></span>
                            <img src="<?php echo base_url();  ?>uploads/images/post/50/<?php echo $img->image_path; ?>">
                            <div class="image-default <?php if ($img->default == 1) echo 'active';  ?>" onclick="image_default(<?php echo $img->id; ?>);"></div>
                        </div>
                    <?php endforeach;
                endif;
                ?>
                <div class="clearfix"></div>
                <input type="hidden" name="image_default"   />
            </div>
            <div class="clearfix"></div>
            <button id="upload" type="button" class="btn btn-info">Thêm hình ảnh</button>  <span class="load-upload"></span>
        </div>
    </div>
    <div class="modal-footer from-action">
        <button id="save_product"  type="button"  class="btn btn-primary pull-right"><?php if (isset($post)): ?>Cập nhật <?php else: ?>Thêm mới <?php endif; ?></button>
    </div>
</form>

<script>
    CKEDITOR.replace( 'description');
</script>
<script >

    function image_default(img_id){
        $(".img-show" ).find("div.image-default").removeClass("active");
        $(".img-" + img_id).find("div.image-default").addClass("active");
        $("input[name='image_default']").val(img_id);
        <?php if (isset($post)) : ?>
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/media/update_default_image",
            data: { 'img_id' : img_id , 'parent_id' : <?php echo $post->id; ?>},
            dataType: 'html',
            error: function(data){
                //alert('error test');
            },
            success: function(data){

            }
        });
        <?php endif; ?>

    }

    $(function(){
        var btnUpload=$('#upload');
        new AjaxUpload(btnUpload, {
            action: '<?php echo base_url();	?>admin/media/upload_post',
            name: 'uploadfile',
            data: { <?php if (isset($post)) { echo '"id":' . $post->id; }  ?> },
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    alert('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
                $(".load-upload").html('Đang tải hình ảnh...');
                set_disable_form_element($(".form-product"));
            },
            onComplete: function(file, response){
                //On completion clear the status
                //Add uploaded file to list
                var data = response.split('-::-');
                $(".load-upload").html('');
                set_enable_form_element($(".form-product"));
                if(data==="error"){
                    //error return
                    alert('error');
                } else{
                    $("#image").append(","+data[0]);
                    $("#image-show").prepend('<div  class="img-show img-' + data[0]+ '"> <div class="loading-img"></div><span><a onclick="delete_img(' + data[0]+ ')" class="delete" title="Xóa hình" href="javascript:;"><i class="fa fa-remove"></i></a></span><img src="<?php echo base_url(); ?>' + data[1] +'" /><div class="image-default" onclick="image_default(' + data[0]+ ');"></div></span>');
                }

            }
        });
    });

    $(function(){
        $('#save_product').click(function(){
            var element = $(".form-product");
            var content = CKEDITOR.instances['description'].getData();
            //var parent_id = element.find("select[name='parent_id']").val();
            var title =  element.find(" input[name='title']").val();

            var image =  element.find("#image").html();
            var image_default = $("input[name='image_default']").val();
            if(title == ''){
                element.find("input[name='title']").css('border', '1px solid red').focus();;
                return false;
            }

            set_disable_form_element(element);
            $.ajax({
                type: "POST",
                url:"<?php echo base_url(); ?>admin/post/update_post",
                data: {'id': '<?php  if (isset($post)) echo $post->id;  ?>',
                    'description': content, 'title': title,
                    'parent_id': 0,
                    'image': image,
                    'image_default': image_default
                },
                dataType: 'json',
                error: function(data){
                    //alert('error test');
                },
                success: function(data){
                    var element = $(".form-product");
                    set_enable_form_element(element);
                    <?php
                    if (!isset($post)) :
                        ?>
                            $("#image").html('');
                            $("#image-show").html('');
                         //   element.find("select[name='parent_id']").val('');
                             $("input[name='image_default']").val('');
                            element.find(" input[type='text']").val('');
                            CKEDITOR.instances['description'].setData('');
                        <?php
                     endif;
                     ?>
                    new PNotify({
                        title: 'Thông báo thành công',
                        text: data['success'],
                        type: 'success'
                    });
                }
            });
        });
    });

    function delete_img(id){
        $(".img-" + id).find(".loading-img").show();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/media/delete_image",
            data: {'post_id': '<?php  if (isset($post)) echo $post->id;  ?>',
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
            }
        });
    }



</script>