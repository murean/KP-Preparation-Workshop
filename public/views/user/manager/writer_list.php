<?php echo $head_content ?>
<?php echo $banner_manager ?>

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
                    <!--<th>ID</th>-->
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Terdaftar</th>
                    <th>
                        <a href="/manager/writer/creator" class="button icon-plus text-dark-hover"> Writer</a>
                    </th>
                </tr>
            </thead>
            <tbody id="writer-list">
                <?php foreach ($writers['dataset'] as $writer) { ?>
                    <tr class="text-dark-hover">
                        <td><?php echo $writer['name'] ?></td>
                        <td><?php echo $writer['email'] ?></td>
                        <td><?php echo readableTime($writer['created_at']) ?></td>
                        <td>
                            <!--Delete Trigger-->
                            <a class="button delete icon-trash_can
                               text-dark-hover" href="/prc/writer/delete/<?php echo $writer['id'] ?>?ref=<?php echo $_SERVER['REQUEST_URI'] ?>"></a>
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
        <?php for ($i = 1; $i <= $writers['offsets']; $i++) { ?>
            <a href="/manager/writers/<?php echo $i . $search_query ?>" class="button text-dark-hover">
                <?php echo $i ?>
            </a>
        <?php } ?>
    </div>
</main>
<script>
	$('#writer-list').on('click', '.delete', function () {
		let conf = confirm('Anda Yakin?');
		if (!conf) {
			return false;
		}
	});
<?php echo getMessage(); ?>
</script>

<?php echo $foot_content ?>