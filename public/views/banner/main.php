<!-- HEADER (Main Menu) -->
<header role="banner" class="position-absolute margin-top-30 margin-m-top-0 margin-s-top-0">
    <!-- Top Navigation -->
    <nav class="background-transparent background-transparent-hightlight full-width sticky">
        <div class="s-12 l-2">
            <a href="/" class="logo">
                <!-- Logo version before sticky nav -->
                <img class="logo-before" src="/img/logo-dark.png" alt="">
                <!-- Logo version after sticky nav -->
                <img class="logo-after" src="/img/logo-dark.png" alt="">
            </a>
        </div>
        <div class="s-12 l-10">
            <div class="top-nav right">
                <p class="nav-text"></p>
                <ul class="right chevron">
                    <li><a href="/">Home</a></li>
                    <!--Login-->
                    <li>
                        <?php $session = Session::GetSessionData() ?>
                        <?php if ($session) { ?>

                            <a href="<?php echo ($session['type'] === 1) ? '/manager/dashboard'
                                : '/writer/dashboard' ?>">
                            <?php echo $session['name'] ?>
                            </a>
                        <?php } else { ?>
                            <a href="/login">Login</a>
<?php } ?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</header>
