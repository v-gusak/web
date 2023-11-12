<?php

interface Renderer {
    public function renderPage($title, $content);
    public function renderProduct(Product $product);
}

class HTMLRenderer implements Renderer {
    public function renderPage($title, $content) {
        // Відобразити сторінку у форматі HTML
    }

    public function renderProduct(Product $product) {
        // Відобразити продукт у форматі HTML
    }
}

class JSONRenderer implements Renderer {
    public function renderPage($title, $content) {
        // Відобразити сторінку у форматі JSON
    }

    public function renderProduct(Product $product) {
        // Відобразити продукт у форматі JSON
    }
}

class XMLRenderer implements Renderer {
    public function renderPage($title, $content) {
        // Відобразити сторінку у форматі XML
    }

    public function renderProduct(Product $product) {
        // Відобразити продукт у форматі XML
    }
}

interface Page {
    public function render(Renderer $renderer);
}

class SimplePage implements Page {
    private $title;
    private $content;

    public function __construct($title, $content) {
        $this->title = $title;
        $this->content = $content;
    }

    public function render(Renderer $renderer) {
        return $renderer->renderPage($this->title, $this->content);
    }
}

class ProductPage implements Page {
    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }

    public function render(Renderer $renderer) {
        return $renderer->renderProduct($this->product);
    }
}

$simplePage = new SimplePage("Simple Page", "This is a simple page");
$product = new Product("Product Name", "Product Description", "product.jpg");
$productPage = new ProductPage($product);

$htmlRenderer = new HTMLRenderer();
$jsonRenderer = new JSONRenderer();
$xmlRenderer = new XMLRenderer();

$htmlSimplePage = $simplePage->render($htmlRenderer);
$jsonSimplePage = $simplePage->render($jsonRenderer);
$xmlSimplePage = $simplePage->render($xmlRenderer);

$htmlProductPage = $productPage->render($htmlRenderer);
$jsonProductPage = $productPage->render($jsonRenderer);
$xmlProductPage = $productPage->render($xmlRenderer);

?>