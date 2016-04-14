<?php
$size_img = $this->config->item('size_img_product');
foreach ($products as $product): ?>
    <tr class="even pointer pro-<?php echo $product->product_id; ?>">
        <td class="a-center ">
            <input type="checkbox" class="flat" name="table_records">
        </td>
        <td class=" "><img height="40px" src="<?php echo get_image_product($product->product_id, $size_img[0][0]); ?>"></td>
        <td class=" "><?php echo $product->title; ?></td>
        <td class=" "><?php if ($product->price == '') echo '<i>(Chưa có)</i>'; else echo $product->price; ?></td>
        <td class=" "><?php echo $product->price_seo; ?></td>
        <td class="a-right a-right "><?php echo date_format(date_create($product->date_create), "d/m/Y"); ?></td>
        <td class=" last">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-danger">Chọn</button>
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Hành động</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="<?php echo base_url();  ?>admin/product/edit/<?php echo $product->product_id; ?>"><i class="fa fa-edit"></i> Sửa</a>
                    </li>
                    <li>
                        <a onclick="delete_product(<?php echo $product->product_id; ?>)" href="#"><i class="fa fa-remove"></i> Xóa</a>
                    </li>
                </ul>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
<tr><td colspan="7"><?php echo $pagination;  ?></td></tr>
