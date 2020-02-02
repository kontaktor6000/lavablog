<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\DomCrawler\Crawler;

class Scaner extends Model
{

    public $link = 'https://book24.ua/publishers/';
    public function getContent($parser, $link)
    {
        // Get html remote text.
        $html = file_get_contents($link);

        dd($html);

        // Create new instance for parser.
        $crawler = new Crawler(null, $link);
        $crawler->addHtmlContent($html, 'UTF-8');

        // Get title text.
        $title = $crawler->filter($parser->settings->title)->text();

        $content = [
            'link' => $link,
            'title' => $title,
        ];

        return $content;

    }
}
