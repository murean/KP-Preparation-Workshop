<?php echo $head_content ?>
<?php echo $banner_main ?>
<!-- MAIN -->
<main role="main">
    <!-- Content -->
    <article>
        <header class="section background-white">
            <div class="line text-center">
                <h1 class="text-dark text-s-size-30 text-m-size-40 text-l-size-headline text-thin text-line-height-1">Minimalista</h1>

                <form action="#" method="get" class="customform">
                    <input type="text" placeholder="Pencarian" class="email">
                </form>
            </div>
        </header>
        <div class="background-white full-width">
            <?php foreach ($lists['dataset'] as $list) { ?>
                <!--Article Thumbnail List-->
                <div class="s-12 m-6 l-five">
                    <a class="image-with-hover-overlay image-hover-zoom" href="/article/<?php echo $list['id'] ?>" title="Portfolio Image">
                        <div class="image-hover-overlay background-primary">
                            <div class="image-hover-overlay-content text-center padding-2x">
                                <h3 class="text-white text-size-20 margin-bottom-10">
                                    <!--title-->
                                    <?php echo $list['title'] ?>
                                </h3>
                                <p class="text-white text-size-14 margin-bottom-20">
                                    <!--summary-->
                                    <?php echo $list['summary'] ?>
                                </p>
                            </div>
                        </div>
                        <img class="full-img" src="/img/attachment/thumbnail/thumb-img-<?php echo $list['id'] ?>.jpg" alt=""/>
                    </a>
                </div>
            <?php } ?>

        </div>
        <!-- PAGINATION -->
        <div class="background-white full-width section-small-padding">
            <!--Pagination-->
            <?php
            $search_query = (isset($_GET['title'])) ? '?title=' . $_GET['title']
                    : '';
            ?>
            <?php for ($i = 1; $i <= $lists['offsets']; $i++) { ?>
                <a href="/<?php echo $i . $search_query ?>" class="button text-dark-hover">
                    <?php echo $i ?>
                </a>
            <?php } ?>
        </div>
    </article>
</main>

<?php echo $foot_info ?>
<?php echo $foot_content ?>
