<?php

abstract class APIResourceUpdater {
    // Основний шаблонний метод
    public function updateResource($data) {
        $resource = $this->getResource();
        if ($this->validateData($data, $resource)) {
            $this->beforeSave($resource, $data);
            $response = $this->saveResource($resource);
            $this->afterSave($resource, $response);
            return $this->formatResponse($response);
        } else {
            return $this->handleValidationError($resource, $data);
        }
    }

    protected abstract function getResource();
    protected abstract function validateData($data, $resource);
    protected function beforeSave($resource, $data)
    protected abstract function saveResource($resource);
    protected function afterSave($resource, $response)
    protected abstract function formatResponse($response);
    protected abstract function handleValidationError($resource, $data);
}

class ProductUpdater extends APIResourceUpdater {
    protected function getResource() {
        // Повертає об'єкт Товару
    }

    protected function validateData($data, $resource) {
        // Перевірка валідності даних для Товару
    }

    protected function saveResource($resource) {
        // Зберігання оновленого Товару
    }

    protected function formatResponse($response) {
        // Формування відповіді
    }

    protected function handleValidationError($resource, $data) {
        // Оповіщення адміністратора у разі помилки валідації
    }
}

class UserUpdater extends APIResourceUpdater {
    protected function getResource() {
        // Повертає об'єкт Користувача
    }

    protected function validateData($data, $resource) {
        // Перевірка, що email не змінюється
    }

    // Решта методів аналогічно до класу ProductUpdater
}

class OrderUpdater extends APIResourceUpdater {
    protected function getResource() {
        // Повертає об'єкт Замовлення
    }

    protected function formatResponse($response) {
        // Формування відповіді з JSON-поданням Замовлення
    }

    // Решта методів аналогічно до класу ProductUpdater
}

?>