# practice-cakePHP
- cakePHP学習用のリポジトリ
## 目的
- 業務でCakePHPを使うため、[https://book.cakephp.org/3/ja/tutorials-and-examples/cms/installation.html](https://book.cakephp.org/3/ja/tutorials-and-examples/cms/installation.html)を参考にして業務で使えるようになることを目的とする。

## ローカル起動
- ローカルで起動するためには、以下のコマンドを実行する。
```
bin/cake server
```
- DBに接続するための設定は、`config/app_local.php`を確認し適宜修正する。
```
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'DBを起動しているホスト',
            'username' => 'DBに接続するユーザー名',
            'password' => 'DBに接続するパスワード',
            'database' => 'DB名',
            'encoding' => 'utf8mb4',
            'port' => 'DBのポート番号',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
        ],
    ],
```
