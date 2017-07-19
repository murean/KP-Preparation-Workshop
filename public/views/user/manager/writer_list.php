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
                <tr class="text-dark-hover">
                    <td>{name}</td>
                    <td>{email}</td>
                    <td>{created_at}</td>
                    <td>
                        <!--Delete Trigger-->
                        <a class="button delete icon-trash_can
                           text-dark-hover" href="/prc/writer/delete/{writer_id}?ref={referrer}"></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <!--Pagination-->


        <a href="/manager/writers/{page}{search_query}" class="button text-dark-hover">
            {page_number}
        </a>

    </div>
</main>
<script>
	$('#writer-list').on('click', '.delete', function () {
		let conf = confirm('Anda Yakin?');
		if (!conf) {
			return false;
		}
	});
</script>