<?php echo $head_content ?>
<?php echo $banner_writer ?>
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
            <div class="s-12 m-12 l-6 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Hit</label>
                <label class="text-size-50 text-strong text-white"><?php echo $total_hit ?></label>
            </div>
            <!--Total Article-->
            <div class="s-12 m-12 l-6 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Article</label>
                <label class="text-size-50 text-strong text-white"><?php echo $total_owned ?></label>
            </div>
            <!--Top Articles-->
            <div class="s-12 m-12 l-6 background-dark padding-2x">
                <label class="text-s-size-16 text-cue text-center full-width">Top Articles</label><br>
                <ul class="text-left text-white">
                    <?php foreach ($tops as $top) { ?>
                        <li class="li--wide">
                            <a href="/article/<?php echo $top['id'] ?>">
                                <!--Title-->
                                <?php echo $top['title'] ?><br>

                                <!--Hit Counter-->
                                <span class="icon-graph"></span>
                                <label class="text-size-12"><?php echo $top['hit'] ?></label>

                                <!--Creation Time-->
                                <span class="icon-pen"></span>
                                <label class="text-size-12"><?php echo readableTime($top['created_at']) ?></label>

                                <!--If the article ever edited-->
                                <?php if ($top['updated_at'] !== null) { ?>
                                    <span class="icon-refresh"></span>
                                    <label class="text-size-12">
                                        <?php echo readableTime($top['updated_at']) ?>
                                    </label>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!--New Articles-->
            <div class="s-12 m-12 l-6 background-dark padding-2x">
                <label class="text-s-size-16 text-cue text-center full-width">New Articles</label><br>
                <ul class="text-left text-white">
                    <?php foreach ($lasts as $last) { ?>
                        <li class="li--wide">
                            <a href="/article/<?php echo $last['id'] ?>">
                                <?php echo $last['title'] ?><br>
                                <!--Hit Counter-->
                                <span class="icon-graph"></span>
                                <label class="text-size-12"><?php echo $last['hit'] ?></label>

                                <!--Creation Time-->
                                <span class="icon-pen"></span>
                                <label class="text-size-12"><?php echo readableTime($last['created_at']) ?></label>

                                <!--If the article ever edited-->
                                <?php if ($top['updated_at'] !== null) { ?>
                                    <span class="icon-refresh"></span>
                                    <label class="text-size-12">
                                        <?php echo readableTime($last['updated_at']) ?>
                                    </label>
                                <?php } ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php echo $foot_content ?>
