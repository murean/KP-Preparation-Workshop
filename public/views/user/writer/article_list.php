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

                <tr class="text-dark-hover">
                    <td></td>
                    <td><!--Title--><br>(<!--Last Edited-->)</td>
                    <td></td>
                    <td>
                        <!--Edit Trigger-->
                        <a class="button icon-pen text-dark-hover"
                           href="/writer/article/editor/{id}"></a>
                        <!--Delete Trigger-->
                        <a class="button delete icon-trash_can text-dark-hover"
                           href="/prc/article/delete/{id}?ref={referrer}"></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <!--Pagination-->
        <a href="/writer/articles/{page}{search_query}" class="button text-dark-hover">{page_number}</a>
    </div>
</main>
<script>
	$('#article-list').on('click', '.delete', function () {
		let conf = confirm('Anda Yakin?');
		if (!conf) {
			return false;
		}
	});

</script>
