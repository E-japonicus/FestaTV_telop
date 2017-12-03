# FestaTVについて
## ファイル構成について
FestaTV/  
  ├　index.php　　＃TOPページ  
  ├　all_list.php　　＃テロップ追加ページ  
  ├　edit.php　 　　＃telop追加・削除コード  
  ├　telop.txt  　　　＃テロップ保存用テキストファイル  
  │  
  ├　css/  
  │　　├　bootstrap.min.css　　＃bootstrapファイル  
  │　　└　style.css 　　　 　　 　＃CSS記載ファイル  
  │    
  ├　images/  
  │　　├　background.jpg　　　 ＃背景用画像  
  │　　├　ipu_kun_tweet.png　　＃いぷくん画像  
  │　　├　ONAIR.gif 　　　　　　＃ONAIR画像  
  │　　└　tweet_box.png 　　　　＃ツイッター枠  
  │  
  ├　js/  
  │　　├　jquery.min.js 　　　＃jqueryファイル  
  └　　└　SlideText.js 　　　 ＃テロップ用js  

## index.phpについて

* テキストファイル`telop.txt`から文字列を読み取りテロップとして表示  
* 最後に追加した文字列を最初に表示するために読み取った文字列を逆順で表示する  

* 各変数の値を設定することでテロップの挙動を変えることが可能
```
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
```
```
roopTiming: 次の文字列までの待ち時間: defaults(6000)
slideSpeed: フレームインの速度: defaults(1000)
slideDelay: フレームインを遅らせる: defaults(800)
outSpeed: フレームアウトの速度: defaults(100)
```
※基本的には今の設定で問題ないと思うが念のため記載しておく  

## all_list.phpについて  
* テキストボックスにテロップとして表示したい文字列を入力し送信ボタンを押すことでテキストファイルに書き込む  
* テロップ記載時の注意事項の表示  
* 現在表示されているテロップ文章の表示  
* 削除ボタンを押すことでテロップの削除が可能  

## edit.php
`check_msg`  
　　テロップ文字列のエラーチェック関数  
　　`$maxstr = 36;`の値を変更することで表示する文字列の長さを調整することが可能  

`insert_msg`  
　　テロップ文章の追記関数  

`delete_msg`  
　　テロップ文章の削除関数

## style.cssについて
* 各種アイテムのstyleについて記載  
* 大きさの設定，場所の設定共に`px`で記載しているので，環境に合わせて変更すること  
* `clocklink`等の配置は`!important`を用いて最優先権限で指定  

## SlideText.jsについて
<http://cly7796.net/wp/javascript/own-plugin-easy-slide-text/>  
※上記ページから引用

#### 若干の変更
* 読み込むテキストが最後かどうかを認識しフラッグを立てる
* フラッグを判定し，最後のテキストだった場合index.phpをリロードし，テロップ文章を再読み込みする
