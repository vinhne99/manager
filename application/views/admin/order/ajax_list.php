<?php foreach($orders as $order): ?>
    <tr>
        <td></td>
        <td><?php
            $customer = get_custormer($order->custormer_id);
            if (!empty($customer)){?>
                <table width="100%" class="sub">
                    <tr>
                        <td><?php  echo 'Tên đầy đủ: '. $customer->fullname; ?></td>
                        <td><?php echo 'Email: '. $customer->email; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo 'Đia chỉ: '. $customer->address ; ?></td>
                    </tr>
                    <tr>
                        <td><?php  echo 'Số điện thoại: '. $customer->phone; ?></td>
                        <td><?php echo 'Tài khoản: '. $customer->username; ?></td>
                    </tr>
                </table>
            <?php
            } else {
                ?>
                <table width="100%" class="sub">
                    <tr>
                        <td><?php  echo 'Tên đầy đủ: '. $order->fullname; ?></td>
                        <td><?php echo 'Email: '. $order->email; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo 'Đia chỉ: '. $order->address ; ?></td>
                    </tr>
                    <tr>
                        <td><?php  echo 'Số điện thoại: '. $order->phone; ?></td>
                        <td></td>
                    </tr>
                </table>
                <?php
            }
            ?></td>
        <td><span class="label label-info"><?php echo date_format(date_create($order->date_create), "d-m-Y H:s"); ?></span></td>
        <td align="center">
            <select style="margin-bottom: 4px;" class="form-control " onchange="change_status(<?php echo $order->id; ?>, this.value);" name="status">
                <option <?php if($order->status == 0) echo 'selected'; ?> value="0">Mới nhận</option>
                <option <?php if($order->status == 1) echo 'selected'; ?> value="1">Đang chờ</option>
                <option <?php if($order->status == 2) echo 'selected'; ?> value="2">Thành công</option>
            </select>
            <a onclick="detail(<?php echo $order->id; ?>);" class="btn btn-success" href="javascript:;">Xem chi tiết</a>
        </td>
    </tr>
<?php endforeach; ?>
<tr><td colspan="4"><?php echo $pagination;  ?></td></tr>