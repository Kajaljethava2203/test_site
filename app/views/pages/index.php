<?php require APPROOT . '/views/inc/header.php'?>
    <div class="jumbotron jumbotron-flud text-center">
        <?php foreach ($data['posts'] as $post) :?>
            <div class="card card-body mb-3">
                <img src=" <?php echo URLROOT;?>/img/<?php echo $post->img ?>" height="300px">
                <h4 class="card-title" style="color: blue;"><?php echo $post->title; ?></h4>

                <p class="card-text">
                    <?php echo $post->issue;?>
                </p>
                <div class="bg-light p-2 mb-3">
                    Written by <?php echo $post->name; ?> On <?php echo $post->issueCreated;?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php'?>