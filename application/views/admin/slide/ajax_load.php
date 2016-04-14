<ul>
    <?php
    $i = 1;
    $size_img = $this->config->item('size_img_slide');
    foreach ($slides as $slide):
        ?>
        <li class="item-<?php echo $slide->id; ?>" id="<?php echo $slide->id; ?>"><span class="number"><?php echo $i++;  ?></span>
            <span class="img" style="width: <?php echo $size_img[0][0];  ?>px;">
                <a  onclick="edit_slide(<?php echo $slide->id; ?>);" href="javascript:;" title="Sửa hình"><i class="fa fa-edit"></i></a>
                <img  src="<?php echo get_image_slide($slide->id, $size_img[0][0]); ?>"></span>
            <span data-title="<?php echo $slide->title;  ?>" class="title"><span><?php echo $slide->title;  ?></span><a href="javascript:;" onclick="edit_slide_title(<?php echo $slide->id; ?>)" title="Sửa tiêu đề" class="edit" ><i class="fa fa-edit"></i></a></span>
            <span class="action-edit"></span>
            <span class="action"><a onclick="delete_slide(<?php echo $slide->id; ?>);"  title="Xóa" href="javascript:;"><i class="fa fa-remove"></i></a></span>
        </li>
    <?php endforeach;  ?>
</ul>