<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ - Danh sách bài viết</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý bài viết</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <a href="<?php echo base_url(); ?>admin/post/create"  class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới bài viết</a>
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">Hình ảnh </th>
                            <th class="column-title">Tiêu đề </th>
                            <th class="column-title">Ngày</th>
                            <th width="130px" style="text-align: right" align="right" class="column-title no-link last"><span class="nobr">Hành động</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="table-content">

                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        load_post(<?php if ($this->session->userdata('page_post')) echo $this->session->userdata('page_post'); else echo 0; ?>);

    });

function load_post(page){
    $.ajax({
        type: "POST",
        url:"<?php echo base_url(); ?>admin/post/ajax_post",
        data: {'page': page },
        error: function(data){
            //alert('error test');
        },
        success: function(data){
           $("#table-content").html(data);

        }
    });

}

    function delete_product(id){
        var confirmBox = confirm('Bạn có chắc xóa bài viết này không vậy?');
        if (!confirmBox) return false;
       // $(".pro-" + id).find(".loading-img").show();
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/post/delete",
            data: { 'id' : id  },
            dataType: 'json',
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $(".pro-" + id).remove();
                new PNotify({
                    title: 'Thông báo thành công',
                    text: data['success'],
                    type: 'success'
                });
            }
        });
    }
    function manager_image(post_id){
        $("#image-manager").modal("show");
        $(".content-manager-image").html('Đang tải dữ liệu, đợi chút xíu nhé...');
        $.ajax({
            type: "GET",
            url:"<?php echo base_url(); ?>admin/media/getimageproduct/" + post_id,
            //data: {'page': page },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $(".content-manager-image").html(data);
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