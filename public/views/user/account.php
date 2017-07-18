<?php echo $head_content ?>
<?php echo $$banner ?>
<main role="main">
    <div class="section l-8 l-offset-2 m-12 s-12">
        <form action="/prc/account/update" class="customform" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
            <label>Foto Profil</label><input type="file" name="image">
            <hr>
            <label class="text-primary">Kosongkan Jika Tidak Ingin Mengubah Password</label><br>
            <label>Password Lama</label><input type="password" name="old_password">
            <label>Password Baru</label><input type="password" name="new_password">

            <button type="submit" >Simpan Perubahan</button>
        </form>
    </div>
</main>
<script>
<?php echo getMessage() ?>
</script>
<?php echo $foot_content ?>