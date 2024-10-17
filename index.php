<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的網站 - AWS Technical Essentials</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <header>
            <h1>你好，我叫林晏寬</h1>

            <!-- EC2 動態數據區塊移到 header 中 -->
            <section id="dynamic-data" class="jumbotron">
                <h2>EC2 動態數據</h2>
                <p>
                    <?php include('get-index-meta-data.php'); ?>
                    <hr />
                    <?php include('get-cpu-load.php'); ?>
                </p>
            </section>
        </header>

        <section id="about">
            <h2>自我介紹</h2>
            <p>我叫林晏寬，目前就讀資工三甲，MBTI:ENTJ，對程式設計和技術創新充滿熱情。我愛好打羽球、溜滑板和旅遊，並對區塊鏈和智能合約技術充滿興趣。</p>
        </section>

        <section id="projects">
            <h2>我的作品</h2>
            <div class="project">
                <h3>作品: 車牌辨識</h3>
                <img src="https://website-daniel.s3.amazonaws.com/%E8%9E%A2%E5%B9%95%E6%93%B7%E5%8F%96%E7%95%AB%E9%9D%A2+2024-09-25+213953.png" alt="車牌辨識系統">
            </div>
        </section>

        <section id="audio">
            <h2>我的音檔</h2>
            <audio controls>
                <source src="https://website-daniel.s3.amazonaws.com/%E6%96%B0%E9%8C%84%E9%9F%B3+14.m4a" type="audio/mp3">
                您的瀏覽器不支援音訊播放。
            </audio>
        </section>

        <section id="video">
            <h2>我的影片</h2>
            <video controls height="400" width="600">
                <source src="https://website-daniel.s3.amazonaws.com/748965626.641854.mp4" type="video/mp4">
                您的瀏覽器不支援影片播放。
            </video>
        </section>

        <section id="contact">
            <h2>聯絡方式</h2>
            <p>以下是我的聯絡方式:<br>Email: daniel40906@gmail.com<br>Phone: 0909771479<br>GitHub: <a href="https://github.com/daniel921213">https://github.com/daniel921213</a></p>
        </section>

        <footer>
            <p>&copy; 2024 林晏寬</p>
        </footer>

    </div>

    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
