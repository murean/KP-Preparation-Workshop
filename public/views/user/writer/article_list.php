<?php echo $head_content ?>
<?php echo $banner_writer ?>

<main role="main">
    <!--Search Form-->
    <div class="section-top-padding">
        <form action="/writer/articles/1" class="customform" method="get">
            <input type="text" placeholder="Pencarian" name="title">
        </form>
    </div>
    <!--Article List-->
    <div class="section l-10 l-offset-1 m-12 s-12 background-white">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Ringkasan</th>
                    <th><a href="/writer/article/creator" class="button icon-plus text-dark-hover"> Artikel</a></th>
                </tr>
            </thead>
            <tbody id="article-list">
                <?php foreach ($articles['dataset'] as $article) { ?>
                    <tr class="text-dark-hover">
                        <td><?php echo $article['id'] ?></td>
                        <td>
                            <?php echo $article['title'] ?>
                            <br>
                            (
                            <?php
                            $last_update = ($article['created_at'] <=> $article['updated_at'])
                                    ? $article['created_at'] : $article['updated_at'];
                            echo readableTime($last_update);
                            ?>
                            )</td>
                        <td><?php echo $article['summary'] ?></td>
                        <td>
                            <!--Edit Trigger-->
                            <a class="button icon-pen
                               text-dark-hover" href="/writer/article/editor/<?php echo $article['id'] ?>"></a>
                            <!--Delete Trigger-->
                            <a class="button delete icon-trash_can
                               text-dark-hover" href="/prc/article/delete/<?php echo $article['id'] ?>?ref=<?php echo $_SERVER['REQUEST_URI'] ?>"></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <!--Pagination-->
        <?php
        $search_query = (isset($_GET['title'])) ? '?title=' . $_GET['title'] : '';
        ?>
        <?php for ($i = 1; $i <= $articles['offsets']; $i++) { ?>
            <a href="/writer/articles/<?php echo $i . $search_query ?>" class="button text-dark-hover">
                <?php echo $i ?>
            </a>
        <?php } ?>
    </div>
</main>
<script>
    $('#article-list').on('click', '.delete', function () {
        let conf = confirm('Anda Yakin?');
        if (!conf) {
            return false;
        }
    });
<?php
// action message
$message = getProcessMessage();
if ($message) {
    ?>
        toastr.success('<?php echo $message ?>');
<?php } ?>
</script>
<?php echo $foot_content ?>