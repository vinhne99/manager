<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ - Danh sách slide</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý Sile</h2>
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
                    <div id="sortable" class="tree-menu-slide">
                        <span class="loading1"></span>
                        <div id="content">
                        </div>
                    </div>
                    <button class="btn btn-success" id="upload">Thêm mới</button><span class="text-loading"></span>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        load();
    });

    function hover_li(){
        $("#content li").hover(function(){
            $(this).find("span.action").show();
            $(this).find("span.img a").show();
            $(this).find("a.edit").show();
            $(this).find("img").addClass("hover-img");
        }, function(){
            $(this).find("span.action").hide();
            $(this).find("span.img a").hide();
            $(this).find("a.edit").hide();
            $(this).find("img").removeClass("hover-img");
        });

    }

    function load(){
        $(".loading1").show();
        $.ajax({
            type: "GET",
            url:"<?php echo base_url(); ?>admin/slide/ajax_load",
            //data: {'id': id },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $("#content").html(data);
                hover_li();
                load_tree();
                $(".loading1").hide();
            }
        });
    }

    function edit_slide(id){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/slide/edit_image",
            data: 'id=' + id,
            error: function(data){
                //alert('error test');
            },
            success: function(data){
            }
        });
        $( "input[name='uploadfile']" ).trigger( "click" );
    }

    function edit_slide_title(id){
       var element = $(".item-" + id);
        element.find("span.title").hide();
        var title = element.find("span.title span").html();
        var html = '<input value="' + title + '" class="form-control input-edit" /><a class="btn btn-primary" onclick="save_edit(' + id + ');" href="javascript:;">Cập nhật</a> <a onclick="cancel(' + id + ');" class="btn btn-danger" href="javascript:;">Hủy bỏ</a>';
        element.find("span.action-edit").html(html);
    }
    function cancel(id){
        var element = $(".item-" + id);
        element.find("span.title").show();
        element.find("span.action-edit").html('');
    }

    function save_edit(id){
        var element = $(".item-" + id);
        element.find("input").attr ('disabled', 'disabled');
        element.find("span.action-edit a").attr ('disabled', 'disabled');
        var title =  element.find("input").val();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/slide/save_edit",
            data: {id: id, title: title},
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                element.find("span.title span").html(title);
                cancel(id);
            }
        });
    }

    function load_tree(){
        $( "#sortable ul" ).sortable({
            connectWith: '#sortable ul',
            placeholder: 'ui-state-highlight',
            distance: 1,
            update: function(event, ui){
                var newOrder = $(this).sortable('toArray').toString();
                $(".loading1").show();
                $.ajax({
                    type: "POST",
                    url:"<?php echo base_url(); ?>admin/slide/order",
                    data: 'order=' + newOrder,
                    error: function(data){
                        //alert('error test');
                    },
                    success: function(data){
                        $( ".loading1").hide();
                        load_number();
                    }
                });
                //
            }
        });
    }

    function load_number(){
        var i = 0;
        $( "#sortable ul li" ).each(function( index ) {
            i++;
            $(this).find("span.number").html(i);
        });
    }

    function delete_slide(id){
        var confirmBox = confirm('Bạn có muốn xóa không?');
        if (!confirmBox) return false;
        $(".loading1").show();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/slide/delete_slide",
            data: {'id': id },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $("#"+id).remove();
                $( ".loading1").hide();
                load_number();
                load();
                new PNotify({
                    title: 'Thông báo thành công',
                    text: "Bạn vừa xóa một slide!",
                    type: 'success'
                });
            }
        });
    }


</script>


<script >
    $(function(){
        var btnUpload=$('#upload');
        new AjaxUpload(btnUpload, {
            action: '<?php echo base_url();	?>admin/media/upload_slide',
            name: 'uploadfile',
            data: { },
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    // extension is not allowed
                    alert('Only JPG, PNG or GIF files are allowed');
                    return false;
                }
                $(".text-loading").html("Đang upload, vui lòng đợi chút xíu nhé...");
            },
            onComplete: function(file, response){
                //On completion clear the status
                //Add uploaded file to list
                $(".text-loading").html('');
                if(response==="error"){
                    //error return
                    alert('error');
                } else{
                    // $("#logo").val(response);
                    // $('#thumb-logo').attr('src', '<?php echo base_url(); ?>' + response );
                    load();
                    new PNotify({
                        title: 'Thông báo thành công',
                        text: "Thao tác upload hình thành công!",
                        type: 'success'
                    });
                }

            }
        });

    });
</script>