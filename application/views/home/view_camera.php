<?php $time = time();  ?>
<div class="col-md-6 bx-viewport1">
    <?php if (!empty($image) && count($image) > 1): ?>
        <ul class="bxslider<?php echo $time; ?>">
            <?php  foreach ($image as $img): ?>
                <li><img src="<?php echo get_image_post_by_id(330 , $img->image_path); ?>" /></li>
           <?php endforeach;  ?>
        </ul>
    <?php else : ?>
        <img src="<?php echo get_image_post_by_id(330 , $image[0]->image_path); ?>" />
    <?php endif; ?>
</div>
<div class="col-md-6">
    <h3 class="title"><?php echo $post->title; ?></h3>
    <div><?php echo $post->description; ?></div>
</div>
<div class="clearfix"></div>
<script>
    $(function(){
        $('.bxslider<?php echo $time;  ?>').bxSlider({
            auto: true
        });
    });
</script>