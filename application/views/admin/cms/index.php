
<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ </h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý thông tin</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php
                        $temp = true;
                        foreach ($cms as $row): ?>
                            <li role="presentation" <?php if ($temp) { echo 'class="active"'; $temp = false; }  ?> ><a href="#tab_content<?php echo $row->id; ?>" id="tab-<?php echo $row->id; ?>" role="tab" data-toggle="tab" aria-expanded="true"><?php echo $row->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="load"></div>
                        <?php
                        $temp = true;
                        foreach ($cms as $row): ?>
                            <div role="tabpanel" class="tab-pane fade <?php if ($temp) { echo 'active in';  $temp = false;}  ?> " id="tab_content<?php echo $row->id; ?>" aria-labelledby="tab-<?php echo $row->id; ?>">
                                <textarea id="description<?php echo $row->id; ?>"><?php  if (isset($row))  echo $row->description;  ?></textarea>
                                <script>  CKEDITOR.replace( 'description<?php echo $row->id; ?>');</script>
                                <br/>
                                <a class="btn btn-success" onclick="save_cms(<?php echo $row->id; ?>);" href="javascript:;">Cập nhật</a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function save_cms(id){
        $(".load").show();
        var description = CKEDITOR.instances['description'+id].getData();
        var title = $("#tab-" + id).html();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/cms/update",
            data: { 'description' : description , 'id' : id},
            dataType: 'html',
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $(".load").hide();
                new PNotify({
                    title: 'Thông báo thành công',
                    text: "Cập nhật " + title + " thành công!",
                    type: 'success'
                });
            }
        });
    }
</script>