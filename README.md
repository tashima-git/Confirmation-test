# お問い合わせフォームアプリ

## 概要
Laravel と Docker を用いたシンプルなお問い合わせフォームです。<br>
お問い合わせ入力、確認、サンクスページが表示されます。<br>
管理者画面からお問い合わせ内容の一覧表示、検索、削除、CSVエクスポートが可能です。


## 環境構築

### Dockerビルド
1.[git clone リンク](https://github.com/tashima-git/Confirmation-test) <br>
2.docker-compse up -d --build


※ MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

### Laravel環境構築
<ol>
  <li>docker-compose exec php bash
  <li>composer install
  <li>.env.exampleファイルから.envを作成し、環境変数を変更
  <li>php artisan migrate
  <li>php artisan db:seed
</ol>

## 使用技術
- PHP 8.1.33
- Laravel 10.48.29
- MYSQL　8.0.26

## ER図
![ER図](docs/er-diagram.png)

## URL
- 開発環境: [http://localhost/](http://localhost/)
- phpMyAdmin: [http://localhost:8080/](http://localhost:8080/)

##追記
- メールアドレス形式のエラーメッセージを表示するために標準搭載のバリデーションは動作しないようにしてあります。
- 管理者画面で名前メールアドレス検索をかける際の完全一致と部分一致の搭載について。 <br>
　→イメージ画像や要件項目で切り替えボタン等が見つけられなかったので完全一致のデータがあればそのデータだけを表示し、完全一致データがなければ部分一致で検索するようにしました。
- 要件に詳細情報はなかったのですが、セキュリティの観点からユーザー登録の際パスワードは8文字以上入力するよう設定しエラーメッセージを表示するようにしています。
- ログイン時にメールアドレス・パスワード認証出来なかった場合"メールアドレスまたはパスワードが間違っています"と表示するようにしました。
