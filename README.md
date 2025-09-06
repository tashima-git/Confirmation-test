# お問い合わせフォームアプリ

## 概要
Laravel と Docker を用いたシンプルなお問い合わせフォームです。<br>
お問い合わせ入力、確認、サンクスページが表示されます。<br>
管理者画面からお問い合わせ内容の一覧表示、検索、削除、CSVエクスポートが可能です。


## 環境構築

### Dockerビルド
<ol>
  <li>git clone リンク
  <li>docker-compse up -d --build
</ol>

※ MySQLは、OSによって起動しない場合があるので、それぞれのPCに合わせてdoxker-compose.ymlファイルを編集してください。

### Laravel環境構築
<ol>
  <li>doxker-compose exec php bash
  <li>composer install
  <li>.env.exampleファイルから.envを作成し、環境変数を変更
  <li>php artisan migrate
  <li>php artisan db:seed
</ol>

## 使用技術
<li>PHP 8.1.33
<li>Laravel 10.48.29
<li>MYSQL　8.0.26

## URL
<li>開発環境:http://localhost/
<li>phpMyAdminhttp://localhost:8080/
