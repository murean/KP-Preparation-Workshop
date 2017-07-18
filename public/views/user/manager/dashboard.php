<?php e($head_content) ?>
<?php e($banner_manager) ?>
<style>
    .text-cue {
        color: #f1c40f;
    }
    .text-left {
        text-align: left;
    }
    ul {
        list-style-type: square;
    }
    .li--wide {
        border-bottom: 1px dotted #555;
        padding: 15px 5px;
    }
</style>
<main role="main">
    <div class="section background-white full-width">
        <div class="s-12 m-12 l-10 l-offset-1 text-center">
            <!--Total Hit-->
            <div class="s-12 m-12 l-4 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Hit</label>
                <label class="text-size-50 text-strong text-white"><?php e($total_hit) ?></label>
            </div>
            <!--Total Article-->
            <div class="s-12 m-12 l-4 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Article</label>
                <label class="text-size-50 text-strong text-white"><?php e($total_article) ?></label>
            </div>
            <!--Total Writer-->
            <div class="s-12 m-12 l-4 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Writer</label>
                <label class="text-size-50 text-strong text-white"><?php e($total_writer) ?></label>
            </div>
            <!--Top Articles-->
            <div class="s-12 m-12 l-4 background-white padding-2x">
                <label class="text-s-size-16 text-center full-width">Top Articles</label><br>
                <ul class="text-left text-dark">
                    <?php foreach ($tops as $top) { ?>
                        <li class="li--wide">
                            <a href="/article/<?php e($top['id']) ?>">
                                <!--Title-->
                                <?php e($top['title'] . ' ~ ' . $top['name']) ?><br>

                                <!--Hit Counter-->
                                <span class="icon-graph"></span>
                                <label class="text-size-12"><?php e($top['hit']) ?></label>

                                <!--Creation Time-->
                                <span class="icon-pen"></span>
                                <label class="text-size-12"><?php e(readableTime($top['created_at'])) ?></label>

                                <!--If the article ever edited-->
                                <?php if ($top['updated_at'] !== null) { ?>
                                    <span class="icon-refresh"></span>
                                    <label class="text-size-12">
                                        <?php e(readableTime($top['updated_at'])) ?>
                                    </label>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!--New Articles-->
            <div class="s-12 m-12 l-4 background-white padding-2x">
                <label class="text-s-size-16 text-center full-width">New Articles</label><br>
                <ul class="text-left text-dark">
                    <?php foreach ($lasts as $last) { ?>
                        <li class="li--wide">
                            <a href="/article/<?php e($last['id']) ?>">
                                <?php e($last['title'] . ' ~ ' . $last['name']) ?><br>
                                <!--Hit Counter-->
                                <span class="icon-graph"></span>
                                <label class="text-size-12"><?php e($last['hit']) ?></label>

                                <!--Creation Time-->
                                <span class="icon-pen"></span>
                                <label class="text-size-12"><?php e(readableTime($last['created_at'])) ?></label>

                                <!--If the article ever edited-->
                                <?php if ($top['updated_at'] !== null) { ?>
                                    <span class="icon-refresh"></span>
                                    <label class="text-size-12">
                                        <?php e(readableTime($last['updated_at'])) ?>
                                    </label>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <!--Top Writer-->
            <div class="s-12 m-12 l-4 background-white padding-2x">
                <label class="text-s-size-16 text-center full-width">Top Writers</label><br>
                <ul class="text-left text-dark">
                    <?php foreach ($top_writers as $top_writer) { ?>
                        <li class="li--wide">

                            <?php e($top_writer['name']) ?><br>
                            <!--Hit Counter-->
                            <span class="icon-graph"></span>
                            <label class="text-size-12"><?php e($top_writer['poin']) ?></label>

                            <!--Creation Time-->
                            <span class="icon-pen"></span>
                            <label class="text-size-12"><?php e(readableTime($last['created_at'])) ?></label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php e($foot_content) ?>