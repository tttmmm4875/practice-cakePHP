<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
    {
        $articles = $this->paginate($this->Articles);
        $this->set(compact('articles'));
    }

    public function view($slug = null)
    {
        // Update retrieving tags with contain()
        print "$slug\n";
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags')
            ->firstOrFail();
            
        $this->set(compact('article'));
    }
    
    public function add()
    {
        $this->getDate("add");
        $article = $this->Articles->newEmptyEntity(); 
        if ($this->request->is('post')) {
            $this->getDate("add save");
            $article = $this->Articles->patchEntity($article, $this->request->getData());

            // user_id の決め打ちは一時的なもので、あとで認証を構築する際に削除されます。
            $article->user_id = 1;

            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list')->all();

        // ビューコンテキストにtagsをセット
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    public function edit($slug)
    {
        $article = $this->Articles
            ->findBySlug($slug)
            ->contain('Tags') // 関連づけられた Tags を読み込む
            ->firstOrFail();

        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }

        // タグのリストを取得
        $tags = $this->Articles->Tags->find('list')->all();

        // ビューコンテキストに tags をセット
        $this->set('tags', $tags);

        $this->set('article', $article);
    }

    public function delete($slug)
    {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->findBySlug($slug)->firstOrFail();
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The {0} article has been deleted.', $article->title));

            return $this->redirect(['action' => 'index']);
        }
    }

    public function tags()
    {
        // 'pass' キーは CakePHP によって提供され、リクエストに渡された
        // 全ての URL パスセグメントを含みます。
        $tags = $this->request->getParam('pass');

        // ArticlesTable を使用してタグ付きの記事を検索します。
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ])
        ->all();

        // 変数をビューテンプレートのコンテキストに渡します。
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }

    /*
    渡された引数はメソッドのパラメーターとして渡されるので、 PHP の可変引数を使ってアクションを記述することもできます。
    public function tags(...$tags)
    {
        // ArticlesTable を使用してタグ付きの記事を検索します。
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ])
        ->all();

        // 変数をビューテンプレートのコンテキストに渡します。
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }
    */

    public function getDate(string $str) {
        $current_time = date('Y-m-d H:i:s');
        echo $current_time."\t".$str;
        $this->log($current_time."\t".$str, "debug");
    }

}

