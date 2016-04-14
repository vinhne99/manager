<div class="page-title">
    <div class="title_left">
        <h3>Trang chủ - Cập nhật sản phẩm</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Cập nhật sản phẩm - ID: <?php echo $product->id;  ?> </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php  $this->load->view('admin/product/form'); ?>
            </div>
        </div>
    </div>