<?php

// telop.txtの内容を読み込み配列に格納する
$handle  = file('./telop.txt');
// fileで読み込んだ配列を逆順にする
$handle_reverse = array_reverse($handle);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="./css/style.css" type="text/css" >
    <!-- テロップを表示するjsの読み込み -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/SlideText.js"></script>
    <title>Festa TV 2016</title>
  </head>

  <body>
    <!-- ONAIR.gif　ここから -->
    <img class="ONAIR" src="./images/ONAIR.gif" alt="ONAIR">
    <!-- ONAIR.gif　おわり　 -->

    <!-- tweet_box.png　ここから -->
    <img class="tweet_box" src="./images/tweet_box.png" alt="tweet_box">
    <!-- tweet_box.png　おわり　 -->

    <!-- ipu_kun_tweet.png　ここから -->
    <img class="ipu_kun_tweet" src="./images/ipu_kun_tweet.png" alt="ipu_kun_tweet">
    <!-- ipu_kun_tweet.png　おわり　 -->

    <!-- Twitter　ここから -->
    <div class="Twitter">
      <script>!function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + "://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs");
        </script>
        <blockquote class="twitter-tweet"
                    align="left">
            <a class="twitter-timeline"
               href="https://twitter.com/festa_iwate_pu"
               width="250"
               height="600"
               data-chrome="noheader nofooter noborders noscrollbar">
            </a>
        </blockquote>
      </div>
      <!-- Twitter　おわり　 -->

      <!-- clocklink　ここから -->
      <div class="clocklink">
        <iframe scrolling="no" frameborder="no" clocktype="html5"
          src="http://www.clocklink.com/html5embed.php?clock=004&timezone=Japan_Tokyo&color=white&size=240&Title=&Message=&Target=&From=2017,1,1,0,0,0&Color=white">
        </iframe>
      </div>
      <!-- clocklink　おわり -->

      <!-- テロップ設定 ここから -->
      <script>
        $(function(){
          $("#msgConf").est({
            // roopTiming: 6000,
            // slideSpeed: 1000,
            // slideDelay: 800,
            // outSpeed: 100
          });
        });
      </script>
      <!-- テロップ設定補足
       roopTiming: 次の文字列までの待ち時間: defaults(6000)
       slideSpeed: フレームインの速度: defaults(1000)
       slideDelay: フレームインを遅らせる: defaults(800)
       outSpeed: フレームアウトの速度: defaults(100)
      -->
      <!-- テロップ設定 おわり -->

      <!-- テロップ ここから -->
      <div class="msgBox">
        <div id="msgConf">
          <?php
            // 配列をループして表示する
            foreach ($handle_reverse as $value){
              // XSS対策 (<br>タグは有効にする)
              $value = str_replace('&lt;br&gt;', '<br>', htmlspecialchars($value ,ENT_QUOTES));
              // $valueの値をdivで囲んで出力
              echo "<div>". $value . "</div>";
            }
          ?>
        </div>
      </div>
      <!-- テロップ おわり　 -->
  </body>

</html>
