<?php e($head_content) ?>
<?php e($banner_main) ?>

<main role="main">
    <header class="section background-white">
        <div class="line text-center">
            <h1 class="text-dark text-s-size-30 text-m-size-40 text-l-size-headline text-thin text-line-height-1">
                <?php e($article['title']) ?>
            </h1>
        </div>
    </header>
    <img class="l-8 m-12 s-12 l-offset-2 section-small-padding" src="/img/attachment/original/img-<?php e($article['id']) ?>.jpg" alt="">
    <div class="section-small-padding full-width background-white">
        <div class="m-12 s-12 l-8 l-offset-2">
            <!--Content-->
            <?php e($article['content']) ?>
            <hr>
            <!--Profile Picture-->
            <figure class="text-center l-1 m-4 s-4">
                <img style="width:100px;"
                     src="/img/user/thumbnail/thumb-user-<?php e($article['creator']) ?>.jpg">
            </figure>
            <!--Meta-->
            <div class="l-11 m-8 m-8">
                &nbsp;
                <label class="icon-user text-dark text-size-12">
                    <?php e($article['name']) ?>
                </label><br>
                &nbsp;
                <label class="icon-pen text-dark text-size-12">
                    <?php e(readableTime($article['created_at'])) ?>
                </label>
                <br>
                &nbsp;
                <label class="icon-refresh text-dark text-size-12">
                    <?php e(readableTime($article['updated_at'])) ?>
                </label>
            </div>
        </div>
    </div>
</main>

<?php e($foot_info) ?>
<?php e($foot_content) ?>