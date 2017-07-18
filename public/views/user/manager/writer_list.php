<?php e($head_content) ?>
<?php e($banner_manager) ?>

<main role="main">
    <!--Search Form-->
    <div class="section-top-padding">
        <form action="/manager/writers/1" class="customform" method="get">
            <input type="text" placeholder="Pencarian" name="name">
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
                        <td><?php e($writer['name']) ?></td>
                        <td><?php e($writer['email']) ?></td>
                        <td><?php e(readableTime($writer['created_at'])) ?></td>
                        <td>
                            <!--Delete Trigger-->
                            <a class="button delete icon-trash_can
                               text-dark-hover" href="/prc/writer/delete/<?php e($writer['id']) ?>?ref=<?php e($_SERVER['REQUEST_URI']) ?>"></a>
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
            <a href="/manager/writers/<?php e($i . $search_query) ?>" class="button text-dark-hover">
                <?php e($i) ?>
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
<?php e(toastrMessage()) ?>
</script>

<?php e($foot_content) ?>