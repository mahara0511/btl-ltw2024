    <?php include ROOT_PATH."/views/layouts/header.php"; ?> 

    <link type="text/css" rel="stylesheet" href="public/css/news.css"/>
    <link type="text/css" rel="stylesheet" href="public/css/aboutUs.css"/>

    <div class="bigwrapper">
        <div class="about-section">
            <h1 class="about-us-title">Latest News and Updates</h1>
        </div>

        <div class="container about-content">
            <section class="row" id="news-list">
                <?php if (!isset($news) || empty($news)): ?>
                    <div class='col-sm-12'>
                    <div class="alert alert-danger m-auto text-center w-100" role="alert">
                        Sorry... Our store currently has no news available
                    </div>
                </div>
                <?php else: ?>
                    <div class="col-md-12">
                        <br>
                        <button id="back-btn" onclick="setSessionCookie(<?php echo ($curpage - 1); ?>)" class="btn-back-and-forth">Back</button>
                        <button class="page-num" disabled="true">Page <?php echo $curpage ?> / <?php echo $npage ?></button>
                        <button id="forth-btn" onclick="setSessionCookie(<?php echo ($curpage + 1); ?>)" class="btn-back-and-forth">Next</button>
                        <br>
                    </div>
                    <?php foreach ($news as $dummy):
                        $news_id = $dummy['id'];
                        $news_title = $dummy['title'];
                        $news_subtitle = $dummy['subtitle'];
                        $news_content = $dummy['content'];
                        $news_image = $dummy['img'];
                        $news_category = $dummy['category'];
                        ?>

                        <a href="#" onclick="<?php echo("showNews($news_id);"); ?>">
                            <div class="col-md-4">
                                <div class="card">
                                    <?php echo "<script>console.log($news_image)</script>" ?>
                                    <img src="public/img/<?php echo $news_image ?>" alt="News Image" style="width:100%; height:32vh;">
                                    <div class="wrapper">
                                        <div class="news-title">
                                            <p><?php echo $news_title ?></p>
                                        </div>
                                        <div class="news-subtitle">
                                            <p><?php echo $news_subtitle ?></p>
                                        </div>
                                        <div class="news-category">
                                            <p><?php echo $news_category ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="col-md-12">
                    <br>
                </div>
            </section>

            <section class="news-content" id="news-content">
                <br><br>
                <article id="news-article">
                    <h1>News Title</h1>
                    <h4>News subtitle will be displayed here.</h4>
                    <img src="" alt="News Image" style="height: 50vh;">
                </article>
                <br><br>
                <button onclick="goBack()" class="news-goback-btn">Back</button>
                <br><br>
            </section>
        </div>
    </div>
    <?php include ROOT_PATH."/views/layouts/footer.php"; ?>

    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/slick.min.js"></script>
    <script src="public/js/nouislider.min.js"></script>
    <script src="public/js/jquery.zoom.min.js"></script>
    <script src="public/js/sweetalert.min.js"></script>
    <script src="public/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="public/js/main.js"></script>
    <script src="public/js/actions.js"></script>
    <script src="public/js/script.js"></script>
    <script>var c = 0;
        function menu(){
            if(c % 2 == 0) {
                document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu active";    
                document.querySelector('.cont_icon_trg').className = "cont_icon_trg active";    
                c++; 
            } else{
                document.querySelector('.cont_drobpdown_menu').className = "cont_drobpdown_menu disable";        
                document.querySelector('.cont_icon_trg').className = "cont_icon_trg disable";        
                c++;
            }
        }
    </script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>

    <script>
        function addParagraph(p) {
            const newsArticle = document.getElementById('news-article');
            const para = document.createElement("p");
            para.className = "news-p";
            para.appendChild(document.createTextNode(p));
            newsArticle.appendChild(para);
        }
    </script>

    <?php echo "\n<script>\n"; ?>
    <?php if (!isset($news) || empty($news)): ?>
        <?php echo("console.log(\"Nuh-uh\");\n"); ?>
    <?php else: ?>
        <?php echo "let newsData = {0 : {title: \"News Title\", subtitle: \"News Subtitle\", img: \"\", content: \"New Content\"}};\n" ?>
        <?php foreach ($news as $dummy):
            $news_id = $dummy['id'];
            $news_title = $dummy['title'];
            $news_subtitle = $dummy['subtitle'];
            $news_content = implode("\\n", explode(PHP_EOL, $dummy['content']));
            $news_image = '/public/img/'.$dummy['img'];
            $news_category = $dummy['category'];

            echo "console.log(newsData)\n
                newsData[$news_id] = {\n
                title: \"$news_title\",\n
                subtitle: \"$news_subtitle\",\n
                img: \"$news_image\",\n
                content: \"$news_content\"\n
            }\n";
            ?>
        <?php endforeach; ?>

        <?php echo "function showNews(newsId) {\n
            const newsList = document.getElementById('news-list');\n
            const newsContent = document.getElementById('news-content');\n
            const newsArticle = document.getElementById('news-article');\n

            // Populate content
            newsArticle.querySelector('h1').textContent = newsData[newsId].title;\n
            newsArticle.querySelector('h4').textContent = newsData[newsId].subtitle;\n
            newsArticle.querySelector('img').src = newsData[newsId].img;\n
            newsData[newsId].content.split(\"\\n\").forEach(addParagraph);\n

            // Toggle visibility\n
            newsList.style.display = 'none';\n
            newsContent.style.display = 'block';\n
        }\n

        // Go back to news list\n
        function goBack() {\n
            const newsList = document.getElementById('news-list');\n
            const newsContent = document.getElementById('news-content');\n

            newsContent.style.display = 'none';\n
            newsList.style.display = 'block';\n
        }\n"; ?>
    <?php endif; ?>
    <?php echo "</script>\n"; ?>

    <script>
        if (<?php echo $curpage; ?> == 1) {
            btn_back = document.getElementById("back-btn");
            btn_back.style.backgroundColor =  "gray";
            btn_back.disabled = true;
        }

        if (<?php echo $curpage; ?> == <?php echo $npage; ?>) {
            btn_forth = document.getElementById("forth-btn");
            btn_forth.style.backgroundColor = "gray";
            btn_forth.disabled = true;
        }
    </script>

    <script>
        function setSessionCookie(value) {
            document.cookie = "curpage=" + value + "; path=/";  // No expiration date, so it's a session cookie
            window.location.href = "news";
        }
    </script>
</body>
</html>
