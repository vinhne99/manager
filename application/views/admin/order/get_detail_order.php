<table class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
    <th>#</th>
    <th>Thông tin</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Thành tiền</th>
    </thead>
    <tbody>
    <?php
    $i = 1;
    $total = 0;
    foreach ($detail_orders as $order):
        $total += $order->price *$order->amout;
        ?>
        <tr>
            <td><?php echo $i++;  ?></td>
            <td>
                <?php
                $size_img = $this->config->item('size_img_tour');
                $post = get_post($order->post_id);
                ?>
                <img style="float: left;  margin-right: 14px;" src="<?php echo get_image_product('tour' , $post->id, $size_img[0][0]); ?>" />
                <p><b><?php echo $post->title;  ?></b></p>
            </td>
            <td><?php echo $order->price ?></td>
            <td><?php echo $order->amout ?></td>
            <td><?php echo number_format($order->price *$order->amout , 2 ); ?> VND</td>
        </tr>
        <?php
    endforeach;
    ?>
    </tbody>
</table>

<div style="text-align: right"><b>Tổng cộng: <?php echo number_format($total , 2 ); ?> VND</b></div>
