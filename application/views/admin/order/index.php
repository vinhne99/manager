<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ - Danh sách đơn đặt hàng</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Quản lý đơn đặt hàng</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped responsive-utilities bulk_action">
                    <thead>
                    <tr class="headings">
                        <th>
                        </th>
                        <th class="column-title">Thông tin khác hàng</th>
                        <th class="column-title">Ngày đặt</th>
                        <th width="150px" class="column-title no-link last"><span class="nobr">Hành động</span>
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

<div id="detail" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Chi tiết đơn hàng</h4>
            </div>
            <div class="modal-body detail-order">
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        load_order(<?php if ($this->session->userdata('page_order')) echo $this->session->userdata('page_order'); else echo 0; ?>);

    });

    function load_order(page){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/order/ajax_order",
            data: {'page': page },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                $("#table-content").html(data);
            }
        });

    }
    function change_status(id, value){
        $.ajax({
            type: "POST",
            url:"<?php echo base_url(); ?>admin/order/ajax_status",
            data: {'id': id,  status: value },
            error: function(data){
                //alert('error test');
            },
            success: function(data){
                new PNotify({
                    title: 'Thông báo thành công',
                    text: "Cập nhật thành công",
                    type: 'success'
                });
            }
        });
    }
    function detail(id){
        $("#detail").modal("show");
        $(".detail-order").html("Đang tải dữ liệu, vui lòng chờ......");
        $.ajax({
            type: "GET",
            url:"<?php echo base_url(); ?>admin/order/get_detail_order/"+id,
          //  data: { },
            error: function(data){

            },
            success: function(data){
                $(".detail-order").html(data);
            }
        });
    }
</script>