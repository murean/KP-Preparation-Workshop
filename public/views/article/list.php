<style media="screen">
    /*.banner, .news-thumbnail {
        position: relative;
    }

    .login-trigger, .news-thumbnail figcaption {
        position: absolute;
    }

    .container {
        padding: 2.5%;
    }
    .news-thumbnail {
        height: 350px;
        border: 1px solid #3498db;
        margin: 5px;
    }

    .news-thumbnail figcaption {
        bottom: 0;
        left:0;
        width: 100%;
        min-height: 55px;
        background: rgba(41, 128, 185, .75);
    }

    #search-container form {
        width: 95%;
        max-width: 320px;
        margin: auto;
    }

    .pagination-container {
        margin-top: 15px;
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #3498db;
    }

    .pagination-container a {
        color: #3498db;
        font-weight: bold;
        font-size: 105%;
        padding: 15px;
    }

    .pagination-number {
        border: 1px solid #3498db;
    }

    .logo {
        height:50px;
        width:100px;
    }

    .login-trigger {
        right: 0;
    }*/
</style>

<!-- top header, contains logo and login button -->
<div class="banner">
    <img src="/image/logo.png" alt="" class="onc banner__left-item--absolute">
    <!-- <a class="login-trigger button banner__right-item--absolute" href="#"><i class="fa fa-unlock"></i>&nbsp;Login</a> -->
    <!-- <form class="banner__right-item--absolute banner__search-form" action="">
        <input type="text" placeholder="Pencarian" class="banner__search-form__input">
        <button type="reset" class="button--o-red" value=""><i class="fa fa-close"></i></button>
    </form> -->
</div>

<div class="container">
    <!-- second top header, contains search form -->
    <div class="row" id="article-search-container">
        <div class="column">
        </div>
    </div>
    <div class="row">
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 1</figcaption>
        </figure>
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 2</figcaption>
        </figure>
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 3</figcaption>
        </figure>
    </div>
    <div class="row">
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 1</figcaption>
        </figure>
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 2</figcaption>
        </figure>
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 3</figcaption>
        </figure>
    </div>
    <div class="row">
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 1</figcaption>
        </figure>
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 2</figcaption>
        </figure>
        <figure class="column block--rigid grid__thumbnail">
            <img src="/" alt="">
            <figcaption class="grid__caption">Figure 3</figcaption>
        </figure>
    </div>
    <!-- pagination -->
    <div class="row pagination">
        <div class="column">
            <a href="#" class="pagination--item"><i class="fa fa-arrow-left"></i></a>
            <a href="#" class="pagination--item">1</a>
            <a href="#" class="pagination--item">2</a>
            <a href="#" class="pagination--item">3</a>
            <a href="#" class="pagination--item">4</a>
            <a href="#" class="pagination--item">5</a>
            <a href="#" class="pagination--item"><i class="fa fa-arrow-right"></i></a>
        </div>
    </div>
</div>
