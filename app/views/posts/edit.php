<?php require APPROOT . '/views/inc/header.php'?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <h2 style="color: blue;text-align: center">Edit Issues</h2>
    <form action="<?php echo URLROOT;?>/posts/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
            <label for="name" style="color: black">Name : </label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>

            <label for="contact" style="color: black">Contact : </label>
            <input type="text" name="contact" class="form-control form-control-lg <?php echo (!empty($data['contact_err'])) ? 'is-invalid' : '';?>"value="<?php echo $data['contact']; ?>">
            <span class="invalid-feedback"><?php echo $data['contact_err']; ?></span>

            <label for="flat_no" style="color: black">Flat No : </label>
            <input type="text" name="flat_no" class="form-control form-control-lg <?php echo (!empty($data['flat_no_err'])) ? 'is-invalid' : '';?>"value="<?php echo $data['flat_no']; ?>" >
            <span class="invalid-feedback"><?php echo $data['flat_no_err']; ?></span>

            <label for="title" style="color: black">Title : </label>
            <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['title']; ?>" >
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>

            <label for="issue" style="color: black">Body : </label>
            <textarea name="issue" rows="4" class="form-control form-control-lg <?php echo (!empty($data['issue_err'])) ? 'is-invalid' : '';?>"><?php echo $data['issue']; ?></textarea>
            <span class="invalid-feedback"><?php echo $data['issue_err']; ?></span>

            <label for="image" style="color: black"> Select Image to upload:-: </label><br>
            <input type="file" name="img" id="fileToUpload"><?php echo $data['img']; ?>

        </div>
        <input type="submit" class="btn btn-success" value="Submit">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'?>

