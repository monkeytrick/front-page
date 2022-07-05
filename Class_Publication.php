<?php

require 'vendor/autoload.php';

use Goutte\Client;

class Publication {

    public $pub_name;
    public $logo;
    public $site_url;
    public $paywall;
    public $article_search_url;
    public $article_link_url;
    // public $articles;
    public $search_strings;
    public $region;
    public $type;

    public function __construct($pub_name, $logo, $paywall, $site_url, $article_search_url, $article_link_url, $search_strings, $region, $type) {
        
        $this->pub_name             = $pub_name;
        $this->logo                 = $logo;
        $this->paywall              = $paywall;
        $this->site_url             = $site_url;
        $this->article_search_url   = $article_search_url;
        $this->article_link_url     = $article_link_url;
        $this->articles             = [];
        // Strings to be used for article search - headline, article link, article img 
        $this->search_strings       = $search_strings;
        $this->region               = $region;
        $this->type                 = $type;

    }

    public function get_articles($num_articles) {
        
        try {

            $client = new Client();
            $crawler = $client->request('GET', $this->article_search_url);

            $dom = $crawler->filter($this->search_strings['parent_elem']);
       
            for($i = 0; $i < $num_articles; $i++) {

                $article = [];

                // article link/URL
                $link = $dom->eq($i)->children($this->search_strings['link'])->attr('href');
             
                // article headline
                $headline = $dom->eq($i)->children($this->search_strings['headline'])->text();

                
                $article["headline"] = $headline;

                if ($this->search_strings['relative_links'] == true) {
                   
                    // Add prefix
                    $article["link"] = $this->article_link_url . $link;
                }
                else {
                    $article["link"] = $link;
                }

                array_push($this->articles, $article);
            }

        } catch(Exception $e) {
            print_r($e);
       }
        return $this->articles;
    }

}
?>