<?php echo $head_content ?>
<?php echo $banner_main ?>

<main role="main">
    <header class="section background-white">
        <div class="line text-center">
            <h1 class="text-dark text-s-size-30 text-m-size-40 text-l-size-headline text-thin text-line-height-1">
                <?php echo $article['title'] ?>
            </h1>
        </div>
    </header>
    <img class="l-8 m-12 s-12 l-offset-2 section-small-padding" src="/img/attachment/original/img-<?php echo $article['id'] ?>.jpg" alt="">
    <div class="section-small-padding full-width background-white">
        <div class="m-12 s-12 l-8 l-offset-2">
            <?php echo $article['content'] ?>
        </div>

    </div>
</main>

<?php echo $foot_info ?>
<?php echo $foot_content ?>
