<?php e($head_content) ?>
<?php e($banner_writer) ?>

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
                        <td><?php e($article['id']) ?></td>
                        <td>
                            <?php e($article['title']) ?>
                            <br>
                            (
                            <?php
                            e(readableTime(latestDates($article['created_at'], $article['updated_at'])));
                            ?>
                            )</td>
                        <td><?php e($article['summary']) ?></td>
                        <td>
                            <!--Edit Trigger-->
                            <a class="button icon-pen text-dark-hover"
                               href="/writer/article/editor/<?php e($article['id']) ?>"></a>
                            <!--Delete Trigger-->
                            <a class="button delete icon-trash_can text-dark-hover"
                               href="/prc/article/delete/<?php e($article['id']) ?>?ref=<?php e($_SERVER['REQUEST_URI']) ?>"></a>
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
            <a href="/writer/articles/<?php e($i . $search_query) ?>" class="button text-dark-hover">
                <?php e($i) ?>
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
<?php e(toastrMessage()) ?>
</script>
<?php e($foot_content) ?>