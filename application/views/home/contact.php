<div class="wrapper contact content-center">
    <div>
        <h3>Thông tin liên hệ</h3>
        <?php echo setting_value("contact");  ?>
    </div>
    <div class="from">
        <form>
            <div class="row-item">
                <label form="email">Email</label>
                <input type="email" name="email"  />
            </div>
            <div class="row-item">
                <label form="content">Nội dung</label>
                <textarea class="content" name="content"></textarea>
            </div>
        </form>
    </div>
</div>