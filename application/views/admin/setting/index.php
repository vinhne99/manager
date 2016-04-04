<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ - Cấu hình website</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Cấu hình website</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form class="form-horizontal form-label-left" action="<?php echo base_url();?>admin/setting" method="post" >

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tiêu đề: <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" value="<?php echo setting_value("title");  ?>"  name="title" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="3668">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Mô tả: <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea name="description" class="form-control col-md-7 col-xs-12" style="width: 100%; height: 200px" ><?php echo setting_value("description");  ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Logo: <span class="required">*</span>
                        </label>
                        <div class="div-img col-md-10 col-sm-10 col-xs-12">
                            <span class="loadings"></span>
                            <div class="image"><img style="width: 100px; height: 100px; border: 2px solid rgba(221, 221, 221, 0.42)" src="<?php echo get_image(setting_value("logo")); ?>" alt="" id="thumb-logo">
                                <input type="hidden" name="logo" value="<?php echo setting_value("logo");  ?>" id="logo">
                                <br>
                                <a  style="cursor: pointer"  id="upload" >Duyệt</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a style="cursor: pointer" onclick="$('#thumb-logo').attr('src', '<?php echo base_url() ?>assets/images/no_image.jpg'); $('#logo').attr('value', '');">Xóa hình</a></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Email: <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" value="<?php echo setting_value("email");  ?>" name="email"  required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="3668">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Điện thoại: <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input type="text" value="<?php echo setting_value("tell");  ?>" name="tell" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="3668">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Hotline: <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input  value="<?php echo setting_value("hotline");  ?>"  type="text" name="hotline"  required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="3668">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Liên hệ: <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea id="contact" name="contact"><?php echo setting_value("contact");  ?></textarea>
                            <script type="text/javascript">CKEDITOR.replace( "contact"); </script>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2">
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script >
    $(function(){

        var btnUpload=$('#upload');
        new AjaxUpload(btnUpload, {
            action: '<?php echo base_url();	?>admin/media/upload',
            name: 'uploadfile',
            data: {},
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    alert('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
                $(".loadings").show();
            },
            onComplete: function(file, response){
                //On completion clear the status
                //Add uploaded file to list
                $(".loadings").hide();
                if(response==="error"){
                    //error return
                    alert('error');
                } else{
                    $("#logo").val(response);
                    $('#thumb-logo').attr('src', '<?php echo base_url(); ?>' + response );

                }

            }
        });

    });
</script>
