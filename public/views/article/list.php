{+ head_content}
{+ banner_main}
<!-- MAIN -->
<main role="main">
    <!-- Content -->
    <article>
        <header class="section background-white">
            <div class="line text-center">
                <h1 class="text-dark text-s-size-30 text-m-size-40 text-l-size-headline text-thin text-line-height-1">Minimalista</h1>

                <form action="/1" method="get" class="customform">
                    <input name="title" type="text" placeholder="Pencarian" class="email">
                </form>
            </div>
        </header>
        <div class="background-white full-width">

            <!--Article Thumbnail List-->
            <div class="s-12 m-6 l-five">
                <a class="image-with-hover-overlay image-hover-zoom"
                   href="/article/{article_id}" title="Portfolio Image">
                    <div class="image-hover-overlay background-primary">
                        <div class="image-hover-overlay-content text-center padding-2x">
                            <h3 class="text-white text-size-20 margin-bottom-10">
                                <!--title-->
                                {title}
                            </h3>
                            <p class="text-white text-size-14 margin-bottom-20">
                                <!--summary-->
                                {summary}
                            </p>
                        </div>
                    </div>
                    <img class="full-img"
                         src="/img/attachment/thumbnail/thumb-img-{article_id}.jpg" alt=""/>
                </a>
            </div>
        </div>
        <!-- PAGINATION -->
        <div class="background-white full-width section-small-padding">
            <!--Pagination-->

            <a href="/{page}{search_key}" class="button text-dark-hover">{page}</a>

        </div>
    </article>
</main>

{+foot_info}
{+foot_content}