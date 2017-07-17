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
                    <li><a href="/writer/dashboard">Dashboard</a></li>
                    <li><a href="/writer/articles">Artikel</a></li>
                    <li><a href="/user/account">Akun</a></li>
                    <li><a href="/prc/logout">Logout</a></li>
                    <li>
                        <img
                            style="width:50px;"
                            src="/img/user/thumbnail/thumb-user-<?php echo Session::GetSessionData()['id'] ?>.jpg"
                            alt="">
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
