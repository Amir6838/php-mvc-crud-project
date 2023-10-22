<form id="msform" action="<?php echo URLROOT.'/account/register' ?>" method="POST">
    <fieldset>
        <?php
        var_dump($data);
        ?>
        <h2 class="fs-title">ایجاد حساب کاربری</h2>
        <h3 class="fs-subtitle">لطفا اطلاعات زیر را وارد کنید</h3>
        <input type="text" name="username" placeholder="نام کاربری"/>
        <input type="text" name="email" placeholder="پست الکترونیک"/>
        <input type="password" name="password" placeholder="رمز عبور"/>
        <input type="password" name="repassword" placeholder="تکرار رمز عبور"/>
        <input type="submit" name="next" class="next action-button" value="ثبت نام"/>
    </fieldset>
</form>