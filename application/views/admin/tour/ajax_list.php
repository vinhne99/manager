<?php
$size_img = $this->config->item('size_img_tour');
foreach ($tours as $tour): ?>
    <tr class="even pointer pro-<?php echo $tour->post_id; ?>">
        <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records">
        </td>
        <td class=" "><img class="img-g" onclick="manager_image(<?php echo $tour->post_id; ?>);" height="40px" src="<?php echo get_image_product('tour' , $tour->post_id, $size_img[0][0]); ?>"></td>
        <td class=" "><?php echo $tour->title; ?></td>
        <td class=" "><?php if ($tour->price == '') echo '<i>(Chưa có)</i>'; else echo $tour->price; ?></td>
        <td class=" "><?php echo $tour->price_seo; ?></td>
        <td class="a-right a-right "><?php echo date_format(date_create($tour->date_create), "d/m/Y"); ?></td>
        <td class=" last">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-danger">Chọn</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Hành động</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="<?php echo base_url();  ?>admin/tour/edit/<?php echo $tour->post_id; ?>"><i class="fa fa-edit"></i> Sửa</a>
                    </li>
                    <li>
                        <a onclick="delete_tour(<?php echo $tour->post_id; ?>)" href="#"><i class="fa fa-remove"></i> Xóa</a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
<tr><td colspan="7"><?php echo $pagination;  ?></td></tr>
