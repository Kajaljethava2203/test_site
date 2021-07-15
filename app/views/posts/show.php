<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<div class="jumbotron jumbotron-flud ">
    <h3 style="color: blue"><?php echo $data['post']->title; ?></h3>
<?php if ($data['post']->user_id == $_SESSION['user_id']) : ?>
<!--    <hr>-->

    <form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <input type="submit" value="DELETE" class="btn btn-danger" style="margin-left: 20px">
    </form>

    <form class="pull-right " method="post">
        <a href="<?php echo URLROOT;?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">EDIT</a>
    </form>
  <br><br>

<?php endif; ?>
<!--    --><?php //echo URLROOT;?><!--/img/ --><?php //echo $data['post']->img ?>
    <img src=" <?php echo URLROOT;?>/img/<?php echo $data['post']->img ?>" height="400px" width="600px"><br><br>
    <p>Name : <?php echo $data['post']->name; ?></p>
    <p>Contact-No. : <?php echo $data['post']->contact; ?></p>
    <p>Flat-No. : <?php echo $data['post']->flat_no; ?></p>

    <p><?php echo $data['post']->issue; ?></p>

    <div class="bg-secondary text-white p-2 mb-3">
        Written By <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
    </div>

    <?php
    $username='admin';
    if ($username === 'adsmin')
    {
        echo '<button>Feedback</button>';
    }
    else
    {
        echo '';
    }
    ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

