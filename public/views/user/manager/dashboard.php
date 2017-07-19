<style>
    .text-cue {
        color: #f1c40f;
    }
    .text-left {
        text-align: left;
    }
    ul {
        list-style-type: square;
    }
    .li--wide {
        border-bottom: 1px dotted #555;
        padding: 15px 5px;
    }
</style>
<main role="main">
    <div class="section background-white full-width">
        <div class="s-12 m-12 l-10 l-offset-1 text-center">
            <!--Total Hit-->
            <div class="s-12 m-12 l-4 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Hit</label>
                <label class="text-size-50 text-strong text-white">0</label>
            </div>
            <!--Total Article-->
            <div class="s-12 m-12 l-4 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Article</label>
                <label class="text-size-50 text-strong text-white">0</label>
            </div>
            <!--Total Writer-->
            <div class="s-12 m-12 l-4 background-dark padding-2x">
                <label class="text-s-size-16 full-width text-cue">Total Writer</label>
                <label class="text-size-50 text-strong text-white">0</label>
            </div>
            <!--Top Articles-->
            <div class="s-12 m-12 l-4 background-white padding-2x">
                <label class="text-s-size-16 text-center full-width">Top Articles</label><br>
                <ul class="text-left text-dark">

                    <li class="li--wide">
                        <a href="/article/{article_id}">
                            <!--Title-->
                            {title} ~ {name}

                            <!--Hit Counter-->
                            <span class="icon-graph"></span>
                            <label class="text-size-12">{hit}</label>

                            <!--Creation Time-->
                            <span class="icon-pen"></span>
                            <label class="text-size-12">{created_at}</label>

                            <!--If the article ever edited-->
                            <span class="icon-refresh"></span>
                            <label class="text-size-12">{updated_at}</label>

                        </a>
                    </li>
                </ul>
            </div>
            <!--New Articles-->
            <div class="s-12 m-12 l-4 background-white padding-2x">
                <label class="text-s-size-16 text-center full-width">New Articles</label><br>
                <ul class="text-left text-dark">

                    <li class="li--wide">
                        <a href="/article/{article_id}">
                            {title} ~ {name}<br>
                            <!--Hit Counter-->
                            <span class="icon-graph"></span>
                            <label class="text-size-12">{hit}</label>

                            <!--Creation Time-->
                            <span class="icon-pen"></span>
                            <label class="text-size-12">{created_at}</label>

                            <!--If the article ever edited-->
                            <span class="icon-refresh"></span>
                            <label class="text-size-12">{updated_at}</label>
                        </a>
                    </li>
                </ul>
            </div>

            <!--Top Writer-->
            <div class="s-12 m-12 l-4 background-white padding-2x">
                <label class="text-s-size-16 text-center full-width">Top Writers</label><br>
                <ul class="text-left text-dark">
                    <li class="li--wide">
                        {name}<br>
                        <!--Hit Counter-->
                        <span class="icon-graph"></span>
                        <label class="text-size-12">{poin}</label>

                        <!--Creation Time-->
                        <span class="icon-pen"></span>
                        <label class="text-size-12">{created_at}</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>