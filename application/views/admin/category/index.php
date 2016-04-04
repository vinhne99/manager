<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ - Danh sách danh mục</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý danh mục</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-10 col-sm-10 col-xs-12">
                    <button id="add-category" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới danh mục</button>
                    <div id="sortable" class="tree-menu">
                        <span class="loading1"></span>
                        <div>
                            <?php echo $tree; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        load_tree();
        $("#add-category").click(function(){
            edit_category(0);
        });
    });
    function load_tree(){
        $( "#sortable ul" ).sortable({
            connectWith: '#sortable ul',
            placeholder: 'ui-state-highlight',
            distance: 5,
            update: function(event, ui){
                var newOrder = $(this).sortable('toArray').toString();
                var _parent = Number(ui.item[0].parentElement.id);
                var id_item = ui.item[0].id;

                $(".loading1").show();
                if (!isNaN(_parent))
                    id_parent = _parent;

                //$("#result").html("Datos a enviar: order=" + newOrder + "&parent=" + _parent + "&id=" + id_item)
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url(); ?>admin/category/order_category",
                    data: 'order=' + newOrder + '&parent=' + id_parent + '&id=' + id_item,
                    error: function(data){
                        //alert('error test');
                    },
                    success: function(data){
                        $( ".loading1").hide();
                    }
                });
                //
            }
        });
    }
    function edit_category(id){
        var element = $("#change-content");
        element.find(".modal-content").html("<div class='loading-content'>Đang tải dữ liệu, vui lòng đợi....</div>");
        element.modal('show');
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/category/edit/" + id,
            data: {'id': id },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                element.find(".modal-content").html(data);
                CKEDITOR.replace( "description");

                $("#save_edit_category").click(function(){
                    set_disable_form_element(element);
                    var content = CKEDITOR.instances['description'].getData();
                    var parent_id = $(".update-category select[name='parent_id']").val();
                    var title = $(".update-category input[name='title']").val();
                    if(title == ''){
                        $(".update-category input[name='title']").css('border', '1px solid red');
                        return false;
                    }
                    $.ajax({
                        type: "POST",
                        url:"<?php echo base_url(); ?>admin/category/update_category",
                        data: {'id': id, 'description': content, 'title': title, 'parent_id': parent_id },
                        dataType: 'json',
                        error: function(data){
                            //alert('error test');
                        },
                        success: function(data){
                            set_enable_form_element(element);
                            element.modal('hide');
                            $("#sortable div").html(data['tree']);
                            load_tree();
                            new PNotify({
                                title: 'Thông báo thành công',
                                text: data['success'],
                                type: 'success'
                            });
                        }
                    });

                });

            }
        });

    }


    function delete_category(id){
        var confirmBox = confirm('Bạn có muốn xóa không?');
        if (!confirmBox) return false;
        $(".loading1").show();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/category/delete_category",
            data: {'id': id },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $("#"+id).remove();
                $( ".loading1").hide();
            }
        });
    }


</script>


<script >
    $(function(){
/*
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
*/
    });
</script>