<?php
echo "here";
die();
use Snipworks\Smtp\Email;

$entityBody = json_decode(file_get_contents('php://input'));

$contact = $entityBody['contact'];
$message = $entityBody['message'];
$title = $entityBody['title'];

$mail = new Email('smtp.gmail.com', 587);
$mail->setProtocol(Email::TLS);
$mail->setLogin('banasiak@nexo-it.pl', 'baHegem00ny');
$mail->addTo('banasiak@nexo-it.pl', 'Tomek Banasiak');
$mail->setFrom('kontakt@starapodkowa.com', 'StaraPodkowa - Kontakt Castle Party');
$mail->setSubject('[CP2023] Zapytanie o rezerwację');
$mail->setHtmlMessage('
    <h1>Nowe zapytanie o rezerwację</h1>
    <p><b>Imię i nazwisko:</b> ' . $title . '</p>
    <p><b>Kontakt:</b> ' . $contact . '</p>
    <p><b>Treść:</b> ' . $message . '</p>
    
    Wysłane z formularza CastleParty 2023 Stara Podkowa
');

if ($mail->send()) {
    die('{"status": "ok"}');
    header('Location: https://cp.starapodkowa.com/?success=1');
} else {
    die('{"status": "error"}');
    echo "
    <h1>Nie udało się wysłać wiadomości :( </h1>
    <p>Wyślij nam wiadomość na kontakt@starapodkowa.com</p>
    <p><b>Imię:</b> ' . $title . '</p>
    <p><b>Kontakt:</b> ' . $contact . '</p>
    <p><b>Treść:</b> ' . $message . '</p>";
}
