<?php

interface DeliveryStrategy {
    public function calculateDeliveryCost($order);
}

class SelfPickupStrategy implements DeliveryStrategy {
    public function calculateDeliveryCost($order) {
        // Тут реалізація розрахунку вартості доставки для самовивозу

        return $deliveryCost;
    }
}

class ExternalDeliveryStrategy implements DeliveryStrategy {
    public function calculateDeliveryCost($order) {
        // Тут реалізація розрахунку вартості доставки для зовнішньої служби доставки

        return $deliveryCost;
    }
}

class OwnDeliveryStrategy implements DeliveryStrategy {
    public function calculateDeliveryCost($order) {
        // Тут реалізація розрахунку вартості доставки для власної служби доставки

        return $deliveryCost;
    }
}

class DeliveryService {
    private $deliveryStrategy;

    public function __construct(DeliveryStrategy $strategy) {
        $this->deliveryStrategy = $strategy;
    }

    public function setDeliveryStrategy(DeliveryStrategy $strategy) {
        $this->deliveryStrategy = $strategy;
    }

    public function calculateDeliveryCost($order) {
        return $this->deliveryStrategy->calculateDeliveryCost($order);
    }
}

// Створення об'єктів стратегій
$selfPickup = new SelfPickupStrategy();
$externalDelivery = new ExternalDeliveryStrategy();
$ownDelivery = new OwnDeliveryStrategy();

// Створення об'єкту сервісу доставки з обраною стратегією
$deliveryService = new DeliveryService($selfPickup);

// Розрахунок вартості доставки для обраної стратегії
$deliveryCost = $deliveryService->calculateDeliveryCost($order);

// Також можна змінити стратегію та перерахувати вартість доставки
$deliveryService->setDeliveryStrategy($externalDelivery);
$deliveryCost = $deliveryService->calculateDeliveryCost($order);

?>