<?php

namespace App\Http\Controllers;

use App\Parser;
use App\PublishingHouse;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class ParserController extends Controller
{
    public $parser;
    public $url;
    public $category;
    public $path;

    public function __construct($url = 'https://book24.ua/', $category = 'publishers/', $path = 'images/parser/publishing/logo/')
    {
        $this->url = $url;
        $this->category = $category;
        $this->path = $path;
    }

    public function parser() {

        $html = file_get_contents($this->url . $this->category);
        $crawler = new Crawler($html);

        $countCrawler = $crawler->filter('.pagination > ul > li > a');
        $countCrawler = count($countCrawler);


        for ($i = 1; $i <= $countCrawler; $i++) {
            $html = file_get_contents($this->url . $this->category . "?PAGEN_1=$i");
            $crawler = new Crawler($html);

            $publishingHouses = $crawler->filter('div.vendors-section-item')->each(function (Crawler $node, $i) {
                $name = $node->text('.item-title');
                $image = $node->filter('span.image > img')->attr('src');
                $image = substr($image, 1);
                $image = $this->url . $image;
                $imagePathArray = explode('/', $image );
                $imageName = array_pop($imagePathArray);

                file_put_contents($this->path . $imageName, file_get_contents($image));

                $publishingHouse = new PublishingHouse([
                    'name' => $name,
                    'image' => $this->path . $imageName,

                ]);
                $publishingHouse->save();

            });

           //var_dump($publishingHouses);die;
/*
            $i = 0;
            foreach ($crawler as $node) {
                $publishingHouses[$i]['name'] = $node->text('.item-title');
                $publishingHouses[$i]['image'] = 'https://book24.ua' . $node->filter('span.image > img')->attr('src');
                $i++;
            }*/

        }
                                                                                                                                                 var_dump($publishingHouses); die;


        return view('books.parser', [
            'publishingHouses' => $publishingHouses,
        ]);

    }



}
