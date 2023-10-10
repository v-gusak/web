<?php

interface Downloader {
    public function download(string $url): string;
}

class SimpleDownloader implements Downloader {
    public function download(string $url): string {
        // Реалізація завантаження файлу
    }
}

class CachingDownloader implements Downloader {
    private $realDownloader;
    private $cache = [];

    public function __construct(SimpleDownloader $realDownloader) {
        $this->realDownloader = $realDownloader;
    }

    public function download(string $url): string {
        if (!isset($this->cache[$url])) {
            // Якщо дані не знаходяться в кеші, завантажуємо їх
            $this->cache[$url] = $this->realDownloader->download($url);
        }

        // Повертаємо дані з кешу
        return $this->cache[$url];
    }
}


$simpleDownloader = new SimpleDownloader();
$cachingDownloader = new CachingDownloader($simpleDownloader);

$url = "http://example.com/file.txt";

$data1 = $simpleDownloader->download($url);
$data2 = $cachingDownloader->download($url);

?>