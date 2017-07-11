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
            <?php foreach ($lists as $list) { ?>
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
                        <img class="full-img" src="/img/portfolio/thumb-01.jpg" alt=""/>
                    </a>
                </div>
            <?php } ?>

        </div>
        <!-- PAGINATION -->
        <div class="background-white full-width section-small-padding">
            <a href="#" class="button left background-primary">&lt; Kembali</a>
            <a href="#" class="button right background-primary">Lanjut &gt;</a>
        </div>
    </article>
</main>



<?php echo $foot_content ?>
