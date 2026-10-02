<?php
header('Content-Type: application/json');
include('vendor/autoload.php');
use Snipworks\Smtp\Email;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['status' => 'error', 'desc' => 'Metoda niedozwolona.']));
}

$entityBody = json_decode(file_get_contents('php://input'), true);

if (!$entityBody || empty($entityBody['email']) || empty($entityBody['message']) || empty($entityBody['title'])) {
    http_response_code(400);
    die(json_encode(['status' => 'error', 'desc' => 'Brakuje wymaganych pól.']));
}

// Honeypot - pole niewidoczne dla ludzi, boty je wypełniają
if (!empty($entityBody['website'])) {
    die(json_encode(['status' => 'ok']));
}

if (!filter_var($entityBody['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    die(json_encode(['status' => 'error', 'desc' => 'Nieprawidłowy adres email.']));
}

$allowedSubjects = ['Organizacja Wydarzenia', 'Wypożyczenie Techniki / Obsługa', 'Animacje / Wynajem Aktorów', 'Inne'];
$rawSubject = $entityBody['subject'] ?? 'Inne';
if (!in_array($rawSubject, $allowedSubjects, true)) {
    $rawSubject = 'Inne';
}

// Wartości trafiające do nagłówków nie mogą zawierać znaków nowej linii
$stripNewlines = fn($v) => str_replace(["\r", "\n"], ' ', (string) $v);

$title = htmlspecialchars($stripNewlines($entityBody['title']));
$email = htmlspecialchars($entityBody['email']);
$contact = htmlspecialchars($stripNewlines($entityBody['phone'] ?? ''));
$subject = htmlspecialchars($rawSubject);
$message = nl2br(htmlspecialchars($entityBody['message']));

$smtpUser = getenv('SMTP_USER');
$smtpPass = getenv('SMTP_PASS');
if (!$smtpUser || !$smtpPass) {
    error_log('msg.php: brak SMTP_USER/SMTP_PASS w zmiennych środowiskowych');
    http_response_code(500);
    die(json_encode(['status' => 'error', 'desc' => 'Formularz jest chwilowo niedostępny.']));
}

$mail = new Email(getenv('SMTP_HOST') ?: 'r1.idhosting.pl', (int) (getenv('SMTP_PORT') ?: 465));
$mail->setProtocol(Email::SSL);
$mail->setLogin($smtpUser, $smtpPass);
foreach (array_filter(array_map('trim', explode(',', getenv('MAIL_TO') ?: 'kontakt@legacyevents.pl'))) as $to) {
    $mail->addTo($to, 'LegacyEvents');
}
$mail->addReplyTo($entityBody['email'], $stripNewlines($entityBody['title']));
$mail->setFrom(getenv('MAIL_FROM') ?: 'zapytanie@legacyevents.pl', 'LegacyEvents');
$mail->setSubject('[LegacyEvents] ' . $rawSubject);
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
    error_log('msg.php: wysyłka przez SMTP nieudana');
    http_response_code(500);
    die(json_encode(['status' => 'error', 'desc' => 'Nie udało się wysłać wiadomości.']));
}
