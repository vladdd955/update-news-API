<?php

namespace App\Controllers;


use App\Services\IndexArticlesService;
use App\Template;


class ApiController

{
    public function index(): Template
    {
        $search = $_GET['search'] ?? 'Covid';

        $category = $_GET['category'] ?? null;

        $articles = (new IndexArticlesService())->execute($search,$category);

        return new Template('articles/index.twig',
            [
                'articles' => $articles->get(),
                'searchValue'=>$search

            ]
        );
    }
}
































//namespace App\Controllers;
//
//
//
//use App\Services\IndexArticlesService;
//use App\Template;
//
//
//
//
//class ApiController
//{
//
//    public function index(): Template
//    {
//        $search = $_GET["search"] ?? "Riga";
//
//        $articles = (new IndexArticlesService())->execute($search);
//
//
//       return new Template(
//           "articles/index.twig",
//           [
//               "articles" => $articles
//           ]
//       );
//    }
//
//}
//
//
