<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title title-cg" id="myModalLabel"></h4>
</div>

<form class="update-category form-horizontal form-label-left" action="<?php echo base_url();?>admin/setting" method="post" >
    <div class="modal-body">
        <span class="response-message"></span>
        <input type="hidden" name="id" id="" />
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tiêu đề: <span class="required">*</span>
            </label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="text" placeholder="Vui lòng nhập tiêu đề.." value="" name="title" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Danh mục cha: <span class="required">*</span>
            </label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <select name="parent_id" class="form-control col-md-5 col-xs-12">
                    <option value="">--Chọn danh mục--</option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mô tả:
            </label>
            <div class="col-md-10 col-sm-10 col-xs-12">
               <textarea class="ckeditor" id="description"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hình ảnh:
            </label>
            <div class="div-img col-md-10 col-sm-10 col-xs-12">
                <span class="loadings"></span>
                <div class="image"><img style="width: 100px; height: 100px; border: 2px solid rgba(221, 221, 221, 0.42)" src="<?php echo base_url(); ?>assets/images/no_image.jpg" alt="" id="thumb-logo">
                    <input type="hidden" name="logo" value="" id="logo">
                    <br>
                    <a  style="cursor: pointer"  id="upload" >Duyệt</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a style="cursor: pointer" onclick="$('#thumb-logo').attr('src', '<?php echo base_url() ?>assets/images/no_image.jpg'); $('#logo').attr('value', '');">Xóa hình</a></div>
            </div>
        </div>
    </div>
    <div class="modal-footer from-action">
        <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
        <button id="save_edit_category"  type="button"  class="btn btn-primary pull-right"></button>
    </div>
</form>

