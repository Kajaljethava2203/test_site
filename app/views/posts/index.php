<?php require APPROOT . '/views/inc/header.php'?>
<?php flash('post_message');?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Issues Report</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i>ADD ISSUES
        </a>
    </div>
</div>

<?php foreach ($data['posts'] as $post) :?>
<div class="card card-body mb-3">
    <img src=" <?php echo URLROOT;?>/img/<?php echo $post->img ?>" height="400px">
    <h4 class="card-title" style="color: blue;"><?php echo $post->title; ?></h4>

    <p class="card-text">
        <?php echo $post->issue;?>
    </p>
    <div class="bg-light p-2 mb-3">
    Written by <?php echo $post->name; ?> On <?php echo $post->issueCreated;?>
    </div>
    <br><a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->issuetId; ?>" class="btn btn-dark btn-lg">More</a>
</div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'?>
