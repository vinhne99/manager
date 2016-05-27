<?php $results = get_slide();
    if (!empty($results)):
        $size_img = $this->config->item('size_img_slide');
?>
    <div class="wrapper slide">
        <ul class="bxslider">
            <?php
            foreach ($results as $slide): ?>
                <li><img src="<?php echo get_image_slide($slide->id, $size_img[1][0]); ?>" /></li>
            <?php endforeach; ?>
        </ul>
        <a class="btn-now wow bounceInRight animated" href="javascript:;">Bắt đầu ngay</a>
    </div>
<?php endif; ?>

<div class="wrapper box1">
    <div class="col-md-3 item wow bounceInLeft animated">
        <img src="<?php echo base_url() ?>assets/images/dichvu1.png">
        <div class="name col-md-10 ">khách hàng lự chọn giao diện<br/> website phù hợp</div>
    </div>
    <div class="col-md-3 item wow bounceIn animated">
        <img src="<?php echo base_url() ?>assets/images/dichvu2.png">
        <div class="name col-md-10 ">Cung cấp thông tin<br/>
            và yêu cầu chỉnh sửa website</div>
    </div>
    <div class="col-md-3 item wow bounceIn animated">
        <img src="<?php echo base_url() ?>assets/images/dichvu3.png">
        <div class="name col-md-10 ">Chỉnh sữa theo yêu cầu<br/>
            và cung cấp Demo
        </div>
    </div>
    <div class="col-md-3 item last  wow bounceInRight animated">
        <img src="<?php echo base_url() ?>assets/images/dichvu4.png">
        <div class="name col-md-10">Tiến hành chạy thử nghiệm<br/>
            và bàn giao sản phẩm</div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="wrapper box-content">
    <div class="now-design">
        <div class="col-md-6  wow bounceIn animated"><img id="laptop" class="animated infinite lightSpeedIn" src="<?php echo base_url(); ?>assets/images/laptop.png" /></div>
        <div class="service col-md-6  wow bounceIn animated"><img src="<?php echo base_url(); ?>assets/images/dich-vu.png" />
            <a class="now-let-go wow bounceInRight animated" href="javascript:;">Bắt đầu ngay</a>
        </div>
        <div class="clearfix"></div>
    </div>
     <div class="col-md-6">
         <div class="website wow bounceIn animated"><img src="<?php echo base_url(); ?>assets/images/website.png" /></div>
         <a class="choose-design wow bounceInLeft animated" href="javascript:;">Lựa chọn giao diện</a>
     </div>
    <div class="col-md-6 d-ipad">
        <div class="wow bounceIn animated"><img class="ipad animated infinite rotateInDownLeft" src="<?php echo base_url(); ?>assets/images/ipad.png" /></div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="wrapper pro-design">

    <div class="camera cd-items ">
        <br/>
        <h3 class="wow bounceInLeft animated"><img src="<?php echo base_url(); ?>assets/images/btn-camera.png"></h3>
        <?php
        $j = 0;
        $i = 1;
        if ($category_camera):
        foreach ($category_camera as $cate):
            $camera = $this->home_model->get_post_type_category_by_cat_id_one("PRODUCT", $cate->id);
            ?>
            <div class="col-md-3   camera-item <?php if ($i%4 == 0)  echo "last"; $i++;  if ($j%4 == 0)  echo "first wow bounceIn animated zoomIn"; $j++; ?>">
                <h4><a href=""><?php echo $cate->title; ?></a></h4>
               <div class="cd-item">
                   <img src="<?php echo get_image_product('sanpham' , $camera->post_id, 330); ?>">
                            <span>
                                <?php echo $camera->title; ?><br/>
                                <a class="detail" href="#">Xem chi tiết</a>
                            </span>
                   <a href="javascript:;" data-id="<?php echo $camera->post_id; ?>" class="cd-trigger"></a>
               </div>
            </div>
        <?php endforeach;
        endif;
        ?>
        <div class="clearfix"></div>
    </div>


    <div class="">
        <ul class="simplefilter">
            <li style="width: 0px; height: 0px; overflow: hidden;padding: 0; margin: 0;" class="default" data-filter="1"></li>
            <?php
            if ($categorys):
            foreach ($categorys as $category):  ?>
                <li class="wow bounceIn animated"  data-filter="<?php echo $category->id; ?>">
                    <img  class="img-responsive" src="<?php echo get_image($category->image);  ?>">
                    <span><?php echo sub_str($category->title, 2); ?></span>
                </li>
            <?php endforeach;
            endif;
            ?>
        </ul>
    </div>
    <div class="clearfix"></div>

    <div class="content" style="overflow: hidden;    padding-bottom: 35px; ">
        <div class="filtr-container">
            <?php
            $i = 1;
            foreach ($designs as $design):  ?>
                <div  class="col-xs-6 col-sm-4 col-md-4 filtr-item <?php //if ($i <=6) echo 'actives';   ?> " data-category="<?php echo $design->category_id; if ($i <=6) echo ", 1"; $i++; ?>" data-sort="<?php echo $design->title; ?>">
                    <div class="img">
                        <a class="fancybox" href="<?php echo get_image_product("sanpham",$design->post_id);   ?>" data-fancybox-group="gallery" title="<?php echo $design->title; ?>"><img class="img-responsive" src="<?php echo get_image_product("sanpham",$design->post_id, 330);   ?>" alt="<?php echo $design->title; ?>"></a>
                        <span class="item-desc"><?php echo $design->title; ?></span>
                    </div>
                </div>
                <?php
            endforeach;  ?>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="ngt"></div>
    <div class="soft-w">
        <h3 class="title">Thiết kế phần mềm</h3>
        <?php
        $i = 1;
        foreach ($posts as $post):  ?>
            <?php if ($i <= 3): ?>
                <div class="item-soft col-md-4 <?php if ( $i == 3 ) echo "last-child"; ?> wow bounceIn animated">
                    <img class="img-responsive" src="<?php echo get_image_product('post' , $post->post_id); ?>">
                    <div>
                        <h4><?php echo $post->title; ?></h4>
                        <p><?php echo sub_str_description($post->description, 20); ?></p>
                        <a class="read-more pull-right" href="#">Chi tiết</a>
                    </div>
                </div>
                <?php if ($i == 3) echo ' <div class="ngt clearfix"></div>'; ?>
            <?php else: ?>
                <div class="item-soft col-md-3 <?php if ( $i == count($posts) ) echo "last-child"; ?> wow bounceIn animated">
                    <h4><?php echo $post->title; ?></h4>
                    <div>
                        <img class="img-responsive" src="<?php echo get_image_product('post' , $post->post_id); ?>">
                        <p><?php echo sub_str_description($post->description, 20); ?></p>
                        <a class="read-more pull-right" href="#">Chi tiết</a>
                    </div>
                </div>
            <?php endif;  ?>

            <?php $i++; endforeach; ?>
    </div>

</div>