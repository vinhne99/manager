<form class="form-product form-horizontal form-label-left" >
    <span class="response-message"></span>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tiêu đề: <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" value="<?php if (isset($product)) echo $product->title;  ?>" name="title" required="required" class="form-control col-md-7 col-xs-12" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Danh mục: <span class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <select name="parent_id" class="form-control col-md-5 col-xs-12">
                <option value="">--Chọn danh mục--</option>
                <?php echo $tree; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mô tả:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <textarea id="description"><?php  if (isset($product))  echo $product->description;  ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Giá:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" value="<?php if (isset($option)) echo $option->price;  ?>" name="price" required="required" class="form-control col-md-7 col-xs-12" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Giá khuyến mãi:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" value="<?php if (isset($option)) echo $option->seo_price;  ?>" name="price_seo" required="required" class="form-control col-md-7 col-xs-12" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hình ảnh:
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <div style="opacity: 0;" id="image"></div>
            <div id="image-show"><div class="clearfix"></div></div>
            <div class="clearfix"></div>
            <button id="upload" type="button" class="btn btn-info">Thêm hình ảnh</button>  <span class="load-upload"></span>
        </div>
    </div>
    <div class="modal-footer from-action">
        <button id="save_product"  type="button"  class="btn btn-primary pull-right"><?php if (isset($product)): ?>Cập nhật <?php else: ?>Thêm mới <?php endif; ?></button>
    </div>
</form>

<script> CKEDITOR.replace( "description");</script>
<script >
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
                    $("#image-show").prepend('<img class="img-show" src="<?php echo base_url(); ?>' + data[1] +'" />');

                }

            }
        });
    });

    $(function(){
        $('#save_product').click(function(){
            var element = $(".form-product");
            var content = CKEDITOR.instances['description'].getData();
            var parent_id = element.find("select[name='parent_id']").val();
            var title =  element.find(" input[name='title']").val();
            var price =  element.find(" input[name='price']").val();
            var price_seo =  element.find(" input[name='price_seo']").val();
            var image =  element.find("#image").html();
            if(title == ''){
                element.find("input[name='title']").css('border', '1px solid red');
                return false;
            }
            if(parent_id == ''){
                element.find("select[name='parent_id']").css('border', '1px solid red');
                return false;
            }
            set_disable_form_element(element);
            $.ajax({
                type: "POST",
                url:"<?php echo base_url(); ?>admin/product/update_product",
                data: {'id': '<?php  if (isset($product)) echo $product->id;  ?>',
                    'description': content, 'title': title,
                    'parent_id': parent_id,
                    'image': image,
                    'price': price,
                    'price_seo': price_seo
                },
                dataType: 'json',
                error: function(data){
                    //alert('error test');
                },
                success: function(data){
                    var element = $(".form-product");
                    set_enable_form_element(element);
                    new PNotify({
                        title: 'Thông báo thành công',
                        text: data['success'],
                        type: 'success'
                    });
                }
            });
        });
    });


</script>