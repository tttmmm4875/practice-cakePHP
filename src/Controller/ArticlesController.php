<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController
{
    public function index()
    {
        echo "Hello!!!!\n";
        $articles = $this->paginate($this->Articles);
        // $this->loadComponent('Paginator');
        // $articles = $this->Paginator->paginate($this->Articles->find());
        $this->set(compact('articles'));
    }
}

