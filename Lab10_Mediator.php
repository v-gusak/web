<?php

// Посередник
class OrderMediator {
    private $datePicker;
    private $receiverCheckbox;
    private $pickupCheckbox;

    public function __construct(DatePicker $datePicker, ReceiverCheckbox $receiverCheckbox, PickupCheckbox $pickupCheckbox) {
        $this->datePicker = $datePicker;
        $this->receiverCheckbox = $receiverCheckbox;
        $this->pickupCheckbox = $pickupCheckbox;

        // Встановлюємо посередницькі зв'язки
        $this->datePicker->setMediator($this);
        $this->receiverCheckbox->setMediator($this);
        $this->pickupCheckbox->setMediator($this);
    }

    public function onDateChanged() {
        // Логіка, яка відбувається при зміні дати
        $this->receiverCheckbox->update();
    }

    public function onReceiverCheckboxChanged() {
        // Логіка, яка відбувається при зміні стану чекбокса "отримувач інша особа"
        $this->datePicker->update();
        $this->pickupCheckbox->update();
    }

    public function onPickupCheckboxChanged() {
        // Логіка, яка відбувається при зміні стану чекбокса "самовивіз"
        // Додаткові оновлення для інших елементів форми
    }
}

// Колега - елемент вибору дати
class DatePicker {
    private $mediator;

    public function setMediator(OrderMediator $mediator) {
        $this->mediator = $mediator;
    }

    public function update() {
        // Логіка оновлення доступних проміжків часу в залежності від обраної дати
    }
}

// Колега - чекбокс "отримувач інша особа"
class ReceiverCheckbox {
    private $mediator;

    public function setMediator(OrderMediator $mediator) {
        $this->mediator = $mediator;
    }

    public function update() {
        // Логіка виведення/приховування полів Ім'я та Телефон в залежності від стану чекбокса
    }
}

// Колега - чекбокс "самовивіз"
class PickupCheckbox {
    private $mediator;

    public function setMediator(OrderMediator $mediator) {
        $this->mediator = $mediator;
    }

    public function update() {
        // Логіка активації/деактивації елементів форми при виборі самовивозу
    }
}

$datePicker = new DatePicker();
$receiverCheckbox = new ReceiverCheckbox();
$pickupCheckbox = new PickupCheckbox();

$mediator = new OrderMediator($datePicker, $receiverCheckbox, $pickupCheckbox);

// Тепер можна взаємодіяти з елементами форми, і зміни будуть відбуватися через посередника
$datePicker->updateSelectedDate();
$receiverCheckbox->setChecked(true);
$pickupCheckbox->setChecked(false);

?>