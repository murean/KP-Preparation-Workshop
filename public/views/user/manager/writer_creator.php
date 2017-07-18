<?php echo $head_content ?>
<?php echo $banner_manager ?>

<main role="main">
    <div class="section background-white l-8 l-offset-2 m-12 s-12">
        <label class="text-dark text-uppercase">Penulis Baru</label><br><br>
        <form class="customform" action="/prc/writer/create" method="post">
            <label>Nama</label>
            <input type="text" name="name">
            <label>Email</label>
            <input type="text" name="email">
            <label>Password</label>
            <input type="text" name="password">

            <button type="submit">Simpan</button>
        </form>
    </div>
</main>


<script> <?php echo getMessage() ?></script>


<?php echo $foot_content ?>