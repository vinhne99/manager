<?php
foreach ($posts as $post): ?>
    <tr class="even pointer pro-<?php echo $post->post_id; ?>">

        <td class=" "><img class="img-g" onclick="manager_image(<?php echo $post->post_id; ?>);" height="40px" src="<?php echo get_image_product('post' , $post->post_id, 50); ?>"></td>
        <td class=" "><?php echo $post->title; ?></td>
        <td class="a-right a-right "><?php echo date_format(date_create($post->date_create), "d/m/Y"); ?></td>
        <td class=" last">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-danger">Chọn</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Hành động</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="<?php echo base_url();  ?>admin/post/edit/<?php echo $post->post_id; ?>"><i class="fa fa-edit"></i> Sửa</a>
                    </li>
                    <li>
                        <a onclick="delete_product(<?php echo $post->post_id; ?>)" href="#"><i class="fa fa-remove"></i> Xóa</a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
<tr><td colspan="7"><?php echo $pagination;  ?></td></tr>
