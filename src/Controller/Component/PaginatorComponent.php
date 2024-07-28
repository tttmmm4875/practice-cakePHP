<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\Query;

class PaginatorComponent extends Component
{
    public function paginate(Query $query, array $settings = [])
    {
        // デフォルトの設定
        $defaults = [
            'limit' => 20,
            'page' => 1,
        ];
        $settings = array_merge($defaults, $settings);

        // ページネーションのロジック
        $limit = $settings['limit'];
        $page = $settings['page'];
        $offset = ($page - 1) * $limit;

        $results = $query->limit($limit)->offset($offset)->all();

        return $results;
    }
}