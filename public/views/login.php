<?php echo $head_content ?>

<?php if (isset($failure_warning_content)) { echo $failure_warning_content; } ?>

<div id="main">
    <form action="#" method="post" class="container container--small container--middle">
        <br>
        <input type="text" placeholder="email"><br>
        <input type="password" placeholder="password"><br>
        <button type="submit" class="button--blue button--wide">&emsp;<i class="fa fa-unlock"></i> Login&emsp;</button>
        <button type="reset" class="button--red button--wide"><i class="fa fa-arrow-left"></i> Kembali</button>
    </form>
</div>

<?php echo $foot_content ?>
