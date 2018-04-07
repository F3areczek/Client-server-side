<?php

abstract class Repository extends Nette\Object {

    const USER_TABLE = "users";
    const FLOWER_TABLE = "flowers";
    const EVALUATION_TABLE = "evaluation";

    public $baseUri = "http://localhost/"; // dle hostingu

    /** @var Nette\Database\Context */
    protected $connection;

    public function __construct(Nette\Database\Context $db) {
        $this->connection = $db;
    }

    public function table($table) {
        return $this->connection->table($table);
    }
    
    public function query($query){
        return $this->connection->query($query);
    }

    // Create dynamically Sitemap
    public function createSitemap() {
        $baseUri = $this->baseUri;
        $flowers = $this->connection->table("flowers")->select("*")->where("accepted", 1)->fetchAll();

        // Create XML tag with version and encoding
        $xml = new DOMDocument(1, "UTF-8");
        $xml->formatOutput = true;
        $xml->preserveWhiteSpace = true;

        // Create urlset tag with settings
        $urlset = $xml->createElement("urlset");
        $urlset->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
        $urlset->setAttribute("xmlns:xsi", "http://www.w3.org/2001/XMLSchema-instance");
        $urlset->setAttribute("xsi:schemaLocation", "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");
        $path = $baseUri;

        // HomepagePresenter
        $urlset->appendChild($this->fillUrlForSitemap($xml, $path, 0.9));
        $urlset->appendChild($this->fillUrlForSitemap($xml, $path . "encyclopedie"));
        $urlset->appendChild($this->fillUrlForSitemap($xml, $path . "zebricek"));
        $urlset->appendChild($this->fillUrlForSitemap($xml, $path . "pridat-pivonku"));

        // HomepagePresenter - Filling encyclopedia
        foreach ($flowers as $flower) {
            $urlset->appendChild($this->fillUrlForSitemap($xml, $path . "encyclopedie?id=" . $flower->id));
        }

        // SignPresenter
        $urlset->appendChild($this->fillUrlForSitemap($xml, $path . "registrace"));

        $xml->appendChild($urlset);
        $xml->save("sitemap.xml");
        chmod("sitemap.xml", 0777);
    }

    // Creating and populating url tag
    private function fillUrlForSitemap($xml, $loc, $priority = 0.5, $changeFreq = "daily", $lastmod = NULL) {
        if ($lastmod == NULL)
            $lastmod = date("Y-m-d");
        // Create Loc of URL
        $url = $xml->createElement("url");
        $loc = $xml->createElement("loc", $loc);
        $url->appendChild($loc);
        // Create lastmod of URL
        $lastmod = $xml->createElement("lastmod", $lastmod);
        $url->appendChild($lastmod);
        // Create changefreq of URL
        $changefreq = $xml->createElement("changefreq", $changeFreq);
        $url->appendChild($changefreq);
        // Create priority of URL
        $priority = $xml->createElement("priority", $priority);
        $url->appendChild($priority);
        return $url;
    }
}