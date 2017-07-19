<main role="main">
    <div class="section m-12 s-12 l-8 l-offset-2">
        <h1>Artikel Baru</h1>
        <form enctype="multipart/form-data" action="/prc/article/update" method="post" class="customform">
            <input type="hidden" name="id" readonly="readonly" value="">
            <!--Title-->
            <label>Judul</label>
            <input name="title" type="text" placeholder="Judul" value="">
            <!--Image-->
            <label>Gambar (Rekomendasi Rasio = 16:9; Kosongkan Jika Tidak Ingin Mengubah)</label>
            <input type="file" name="image" placeholder="">
            <!--Summary-->
            <label>Ringkasan (Maksimal 75 Karakter)</label>
            <textarea class="" maxlength="75" name="summary"
                      cols="30" rows="5" placeholder="Ringkasan"></textarea>
            <!--Content-->
            <label>Konten</label>
            <textarea name="content" id="content"
                      cols="30" rows="10" placeholder="Konten"></textarea>
            <!--Submit Trigger-->
            <button type="submit" class="icon-check l-3"></button>
        </form>
    </div>
</main>

<!--Add Markdown Editor-->
<script src="/js/simplemde/dist/simplemde.min.js"></script>
<script>
	var linkElement = document.createElement("link");
	linkElement.rel = 'stylesheet';
	linkElement.href = '/js/simplemde/dist/simplemde.min.css';

	document.head.appendChild(linkElement);

	let simplemde = new SimpleMDE({element: document.getElementById('content')});
</script>
