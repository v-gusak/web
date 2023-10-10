<?php

interface Page {
    public function render(Renderer $renderer);
}

interface Renderer {
    public function renderPage(Page $page);
}

class SimplePage implements Page {
    private $title;
    private $content;

    public function __construct($title, $content) {
        $this->title = $title;
        $this->content = $content;
    }

    public function render(Renderer $renderer) {
        return $renderer->renderPage($this);
    }
}

class ProductPage implements Page {
    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function render(Renderer $renderer) {
        return $renderer->renderPage($this);
    }
}

class HTMLRenderer implements Renderer {
    public function renderPage(Page $page) {
        // Рендеринг сторінки у форматі HTML
    }
}

class JsonRenderer implements Renderer {
    public function renderPage(Page $page) {
        // Рендеринг сторінки у форматі JSON
    }
}

class XmlRenderer implements Renderer {
    public function renderPage(Page $page) {
        // Рендеринг сторінки у форматі XML
    }
}

class Product {
    private $id;
    private $name;
    private $description;
    private $image;

    public function __construct($id, $name, $description, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    // Геттери та інші методи
}

// Створення сторінки товару
$product = new Product(1, "Назва товару", "Опис товару", "image.jpg");
$productPage = new ProductPage($product);

// Вибір рендерера
$htmlRenderer = new HTMLRenderer();
$jsonRenderer = new JsonRenderer();
$xmlRenderer = new XmlRenderer();

// Рендерінг сторінок у різних форматах
$htmlResult = $productPage->render($htmlRenderer);
$jsonResult = $productPage->render($jsonRenderer);
$xmlResult = $productPage->render($xmlRenderer);

echo "HTML рендерінг:\n";
echo $htmlResult;

echo "\nJSON рендерінг:\n";
echo $jsonResult;

echo "\nXML рендерінг:\n";
echo $xmlResult;

?>