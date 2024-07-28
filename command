#ローカルの起動
bin/cake server

#push
#変更をステージングエリアに追加
git add .
#コミットを作成
git commit -m "修正内容の説明"
#リモートリポジトリにプッシュ
git push origin main


#リポジトリ作成
#README.mdを作成
echo "# practice-cakePHP" >> README.md
#リポジトリを作成
git init
#README.mdを追加
git add README.md
コミットを作成  
git commit -m "first commit"
#ブランチを作成
git branch -M main
#リモートリポジトリを追加
git remote add origin https://github.com/tttmmm4875/practice-cakePHP.git
#リモートリポジトリにプッシュ
git push -u origin main


##DB
#ログイン
mysql -h 127.0.0.1 -P 3307 -u cakephp cake_cms -p'cakephp'

##docker
#docker 停止 docker stop dockerId
docker stop 0b5aad08487b
#コンテナの起動
docker start <コンテナIDまたは名前>
#docker 起動
docker compose up -d
# コンテナの停止
docker stop containerID
# コンテナを停止・削除:
docker compose down
# コンテナの削除
docker rm containerID
# 停止中のすべてのコンテナを一括削除
docker container prune

#コンテナ一覧
docker ps -a

#キャッシュのクリア
#古いコンテナやボリュームのキャッシュが原因で問題が発生している場合があります。以下の手順でキャッシュをクリアします。
#1. コンテナを停止・削除:
docker compose down
#ボリューム一覧
docker volume ls
#ボリュームを削除:
docker volume rm db-for-cakephp-docker_db-volume
#新しい設定でコンテナを起動:
docker compose up -d
