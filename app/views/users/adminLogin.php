<?php require APPROOT . '/views/inc/header.php'?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2 style="color: blue;text-align: center">ADMIN LOGIN</h2>
            <form action="<?php echo URLROOT;?>/users/adminLogin" method="post">
                <div class="form-group">

                    <label for="email" style="color: black">Email : </label>
                    <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>

                    <label for="password" style="color: black">Password : </label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>

                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="LOGIN" class="btn btn-success btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'?>

