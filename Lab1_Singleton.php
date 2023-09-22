<?php

abstract class Storage {
    abstract public function connect();
    abstract public function uploadFile($filePath, $destination);
    abstract public function downloadFile($source, $destination);
    abstract public function listFiles($directory);
    abstract public function deleteFile($filePath);
}

class StorageManager {
    private static $instance;
    private $storage;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setStorage(Storage $storage) {
        $this->storage = $storage;
        $this->storage->connect();
    }

    public function uploadFile($filePath, $destination) {
        return $this->storage->uploadFile($filePath, $destination);
    }

    public function downloadFile($source, $destination) {
        return $this->storage->downloadFile($source, $destination);
    }

    public function deleteFile($filePath) {
        return $this->storage->listFiles($directory);
    }

    public function deleteFile($filePath) {
        return $this->storage->deleteFile($filePath);
    }
}

$storageManager = StorageManager::getInstance();

$localStorage = new LocalStorage();
$storageManager->setStorage($localStorage);
$storageManager->uploadFile('path', 'local-file.txt');

$s3Storage = new S3Storage();
$storageManager->setStorage($s3Storage);
$storageManager->uploadFile('path', 's3-file.txt');

?>