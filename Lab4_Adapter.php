<?php
interface Notification
{
    public function send(string $title, string $message);
}

class EmailNotification implements Notification
{
    private $adminEmail;

    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    public function send(string $title, string $message): void
    {
        mail($this->adminEmail, $title, $message); // Логіка надсилання email
        echo "Sent email with title '$title' to '{$this->adminEmail}' that says '$message'.";
    }
}

class SmsNotification
{
    private $phoneNumber;
    private $sender;

    public function __construct(string $phoneNumber, string $sender)
    {
        $this->phoneNumber = $phoneNumber;
        $this->sender = $sender;
    }

    public function send(string $title, string $message): void
    {
        // Тут додати логіку надсилання SMS
        echo "Sent SMS with title '$title' to '{$this->phoneNumber}' from '{$this->sender}' that says '$message'.";
    }
}

class SlackNotification
{
    private $login;
    private $apiKey;
    private $chatId;

    public function __construct(string $login, string $apiKey, string $chatId)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
        $this->chatId = $chatId;
    }

    public function send(string $title, string $message): void
    {
        // Тут додати логіку надсилання Slack
        echo "Sent Slack message with title '$title' to chat '{$this->chatId}' that says '$message'.";
    }
}

class SlackNotificationAdapter implements Notification
{
    private $slackNotification;

    public function __construct(SlackNotification $slackNotification)
    {
        $this->slackNotification = $slackNotification;
    }

    public function send(string $title, string $message): void
    {
        $this->slackNotification->send($title, $message);
    }
}

class SmsNotificationAdapter implements Notification
{
    private $smsNotification;

    public function __construct(SmsNotification $smsNotification)
    {
        $this->smsNotification = $smsNotification;
    }

    public function send(string $title, string $message): void
    {
        $this->smsNotification->send($title, $message);
    }
}

$emailNotification = new EmailNotification('admin@example.com');
$emailNotification->send('Test Email', 'This is a test email.');

$slackNotification = new SlackNotification('slack_login', 'slack_api_key', 'slack_chat_id');
$slackNotificationAdapter = new SlackNotificationAdapter($slackNotification);
$slackNotificationAdapter->send('Test Slack', 'This is a test Slack message.');

$smsNotification = new SmsNotification('380959999999', 'Sender');
$smsNotificationAdapter = new SmsNotificationAdapter($smsNotification);
$smsNotificationAdapter->send('Test SMS', 'This is a test SMS.');

?>