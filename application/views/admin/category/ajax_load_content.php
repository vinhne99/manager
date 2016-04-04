<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title" id="myModalLabel"><?php if ($category): ?>Cập nhật danh mục <?php else: ?>Thêm danh mục <?php endif; ?></h4>
</div>

<form class="update-category form-horizontal form-label-left" action="<?php echo base_url();?>admin/setting" method="post" >
    <div class="modal-body">
        <span class="response-message"></span>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tiêu đề: <span class="required">*</span>
            </label>
            <div class="col-md-10 col-sm-10 col-xs-12">
                <input type="text" value="<?php if ($category) echo $category->title;  ?>" name="title" required="required" class="form-control col-md-7 col-xs-12" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Danh mục cha: <span class="required">*</span>
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
               <textarea id="description"><?php  if ($category)  echo $category->description;  ?></textarea>
            </div>
        </div>

    </div>
    <div class="modal-footer from-action">
        <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
        <button id="save_edit_category"  type="button"  class="btn btn-primary pull-right"><?php if ($category): ?>Cập nhật <?php else: ?>Thêm mới <?php endif; ?></button>
    </div>
</form>