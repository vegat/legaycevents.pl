<?php
header('Content-Type: application/json');
include('vendor/autoload.php');
use Snipworks\Smtp\Email;
error_reporting(E_ALL);
ini_set('display_errors', 1);
$entityBody = json_decode(file_get_contents('php://input'), true);

if (!$entityBody || empty($entityBody['email']) || empty($entityBody['message']) || empty($entityBody['title'])) {
    http_response_code(400);
    die(json_encode(['status' => 'error', 'desc' => 'Brakuje wymaganych pól.']));
}

$title = htmlspecialchars($entityBody['title']);
$email = htmlspecialchars($entityBody['email']);
$contact = htmlspecialchars($entityBody['phone'] ?? '');
$subject = htmlspecialchars($entityBody['subject'] ?? 'Inne');
$message = nl2br(htmlspecialchars($entityBody['message']));

$mail = new Email('r1.idhosting.pl', 465);
$mail->setProtocol(Email::SSL);
$mail->setLogin('zapytanie@starapodkowa.com', 'ko6279$sK');
$mail->addTo('kontakt@legacyevents.pl', 'LegacyEvents');
$mail->addTo('banasiak@nexo-it.pl', 'LegacyEvents');
$mail->setFrom('zapytanie@legacyevents.pl', 'LegacyEvents');
$mail->setSubject('[LegacyEvents] ' . $subject);
$mail->setHtmlMessage('
    <h1>Nowe zapytanie ze strony</h1>
    <p><b>Imię i nazwisko:</b> ' . $title . '</p>
    <p><b>Email:</b> ' . $email . '</p>
    ' . ($contact ? '<p><b>Telefon:</b> ' . $contact . '</p>' : '') . '
    <p><b>Temat:</b> ' . $subject . '</p>
    <p><b>Treść:</b><br>' . $message . '</p>
    <hr>
    <small>Wysłane z formularza LegacyEvents</small>
');

if ($mail->send()) {
    die(json_encode(['status' => 'ok']));
} else {
    http_response_code(500);
    die(json_encode(['status' => 'error', 'desc' => 'Nie udało się wysłać wiadomości.']));
}
