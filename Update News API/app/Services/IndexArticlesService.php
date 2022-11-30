<?php


namespace App\Services;


use App\Models\Article;
use App\Models\Collections\ArticlesCollection;
use Carbon\Carbon;
use jcobhams\NewsApi\NewsApi;


class IndexArticlesService
{
    private NewsApi $api;

    public function __construct()
    {
        $this->api = new NewsApi('db87e8bec0044bbe9fb9c5d9e667406e');
    }


    public function execute(string $search,?string $category=null): ArticlesCollection
    {
        $articlesApiResponse = $this->getArticles($search,$category);

        $articles = new ArticlesCollection();
        foreach ($articlesApiResponse->articles as $article) {
            $articles->add(new Article(
                $article->title,
                $article->url,
                $article->description,
                Carbon::createFromDate($article->publishedAt)->format("d.m.Y h:i"),
                $article->urlToImage
            ));
        }

        return $articles;
    }


    private function getArticles(string $search, $category)
    {

        if(!$category) {
            return $this->api->getEverything($search);
        }

        return $this->api->getTopHeadLines($category);
    }

}



















//
//
//
//
//
//
//namespace App\Services;
//
//
//use App\Models\Article;
//use Carbon\Carbon;
//use jcobhams\NewsApi\NewsApi;
//
//class IndexArticlesService
//{
//    public function execute(string $search): array
//    {
//        $newsapi = new NewsApi("db87e8bec0044bbe9fb9c5d9e667406e");
//
//        $search = $_GET["search"] ?? "Riga";
//
//        $articlesApi = $newsapi->getEverything($search);
//
//
//        $articles = [];
//
//        foreach ($articlesApi->articles as $article) {
//            $articles [] = new Article(
//                $article->title,
//                $article->url,
//                $article->description,
//                Carbon::createFromDate($article->publishedAt)->format("d.m.Y h:i"),
//                $article->urlToImage
//            );
//
//        }
//
//        return $articles;
//    }
//}