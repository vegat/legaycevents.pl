<?php
// Meta dane SEO dla poszczególnych podstron (klucz = nazwa pliku bez .php)

$site_url = rtrim(getenv('SITE_URL') ?: 'https://legacyevents.pl', '/');

$seo_pages = [
    'index' => [
        'path' => '/',
        'title' => 'LegacyEvents - Eventy na zamkach, pokazy świetlne i videomapping | Dolny Śląsk',
        'desc' => 'Tworzymy immersyjne wydarzenia na zamkach i w obiektach historycznych: Akademia Magii, Smocze Dziedzictwo, Moonlight Castle Festival. Technika sceniczna, videomapping, animacje. Bolków, Dolny Śląsk.',
    ],
    'oferta' => [
        'path' => '/oferta',
        'title' => 'Oferta - organizacja eventów, technika sceniczna, rental | LegacyEvents',
        'desc' => 'Organizacja wydarzeń na zamówienie, technika sceniczna, videomapping, animacje z aktorami, rental sprzętu i realizacja koncertów. Działamy w całej Polsce.',
    ],
    'oferta_wydarzenia' => [
        'path' => '/oferta_wydarzenia',
        'title' => 'Organizacja wydarzeń i imprez firmowych na zamkach | LegacyEvents',
        'desc' => 'Autorskie wydarzenia fabularne, imprezy firmowe i gry terenowe w zamkach, ruinach i halach. Pełna infrastruktura od zera, aktorzy, pokazy laserowe. Darmowa wycena.',
    ],
    'oferta_technika' => [
        'path' => '/oferta_technika',
        'title' => 'Technika sceniczna, lasery i videomapping | LegacyEvents',
        'desc' => 'Nagłośnienie, oświetlenie, autorskie pokazy laserowe, videomapping budynków, live streaming i system Pay-Per-View. Własna rozdzielnia prądowa i bezprzewodowa technika.',
    ],
    'oferta_animacje' => [
        'path' => '/oferta_animacje',
        'title' => 'Animacje, aktorzy w kostiumach i fireshow | LegacyEvents',
        'desc' => 'Fabularyzowane animacje dla dzieci, szkół i firm. Grupa teatralno-akrobatyczna w ręcznie szytych kostiumach, nagradzane pokazy fireshow.',
    ],
    'oferta_rental' => [
        'path' => '/oferta_rental',
        'title' => 'Wynajem namiotów, nagłośnienia i oświetlenia | LegacyEvents',
        'desc' => 'Rental sprzętu eventowego: namioty, meble, nagłośnienie, oświetlenie LED, wytwornice dymu i iskier. Dry hire lub pełen montaż z obsługą.',
    ],
    'oferta_koncerty' => [
        'path' => '/oferta_koncerty',
        'title' => 'Realizacja koncertów - nagłośnienie i światło | LegacyEvents',
        'desc' => 'Kompleksowa obsługa techniczna koncertów w plenerze, ruinach zamków i wnętrzach. Nagłośnienie 6 kW+, odsłuchy IEM, oświetlenie sceniczne, rejestracja audio i wideo.',
    ],
    'oferta_zamki' => [
        'path' => '/oferta_zamki',
        'title' => 'Oferta dla zamków i obiektów historycznych | LegacyEvents',
        'desc' => 'Ożywiamy zamki: wydarzenia z fabułą, infrastruktura od zera, gry terenowe i aplikacje dla zwiedzających. Współpracujemy z zamkami Bolków, Świny, Ząbkowice Śląskie, Międzyrzecz, Czersk.',
    ],
    'galeria' => [
        'path' => '/galeria',
        'title' => 'Galeria zdjęć z wydarzeń | LegacyEvents',
        'desc' => 'Zdjęcia z naszych wydarzeń: Halloween na Zamku Świny, Moonlight Castle Festival w Bolkowie, Elfy Przejmują Zamek.',
    ],
    'wspolpracujemy' => [
        'path' => '/wspolpracujemy',
        'title' => 'Partnerzy i obiekty, z którymi współpracujemy | LegacyEvents',
        'desc' => 'Zamki, grupy teatralne i fotografowie, z którymi tworzymy wydarzenia: Zamek Świny, Zamek Bolków, Zamek Międzyrzecz, Zamek Ząbkowice Śląskie, Grupa Teatralna Wernisaż.',
    ],
    'kontakt' => [
        'path' => '/kontakt',
        'title' => 'Kontakt - zapytaj o wycenę wydarzenia | LegacyEvents',
        'desc' => 'Skontaktuj się z LegacyEvents: tel. 780 752 938, kontakt@legacyevents.pl. Siedziba: Bolków, Dolnośląskie. Darmowa wycena wydarzenia.',
    ],
    '404' => [
        'path' => '/404',
        'title' => 'Nie znaleziono strony | LegacyEvents',
        'desc' => 'Strona, której szukasz, nie istnieje.',
        'noindex' => true,
    ],
    'blog' => [
        'path' => '/blog',
        'title' => 'Blog eventowy | LegacyEvents',
        'desc' => 'Historie zza sceny, relacje z wydarzeń, inspiracje i poradniki dla organizatorów eventów.',
    ],
    'polityka_prywatnosci' => [
        'path' => '/polityka_prywatnosci',
        'title' => 'Polityka prywatności | LegacyEvents',
        'desc' => 'Zasady przetwarzania danych osobowych oraz polityka plików cookies serwisu LegacyEvents.',
    ],
];

$seo_page_key = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php', '.php');
$seo = $seo_pages[$seo_page_key] ?? ['title' => 'LegacyEvents', 'desc' => ''];
// Strony spoza mapy (np. post?slug=...) - kanoniczny adres to bieżący URL
$seo_canonical = isset($seo['path']) ? $site_url . $seo['path'] : $site_url . ($_SERVER['REQUEST_URI'] ?? '/');
$seo_image = $site_url . '/image.php?src=' . urlencode('Events/moonlight_castle_2025/CV300261-ARW.jpg') . '&w=1200&h=630&crop=1';

$seo_org = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    '@id' => $site_url . '/#organization',
    'name' => 'LegacyEvents',
    'legalName' => 'Legacy Events By Michał Lipa',
    'description' => 'Organizacja immersyjnych wydarzeń na zamkach i w obiektach historycznych, technika sceniczna, videomapping, animacje i rental sprzętu eventowego.',
    'slogan' => 'Tworzymy światy, nie tylko eventy',
    'url' => $site_url . '/',
    'logo' => $site_url . '/image.php?src=Logo/legacyevents_transparent.png&w=512',
    'image' => $seo_image,
    'telephone' => '+48780752938',
    'email' => 'kontakt@legacyevents.pl',
    'taxID' => '6951540199',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Nowa Wieś Wielka 35',
        'postalCode' => '59-411',
        'addressLocality' => 'Paszowice',
        'addressRegion' => 'dolnośląskie',
        'addressCountry' => 'PL',
    ],
    'areaServed' => ['@type' => 'Country', 'name' => 'Polska'],
    'sameAs' => [
        'https://www.facebook.com/profile.php?id=61560702814608',
        'https://instagram.com/legacy_events_poland',
        'https://www.youtube.com/@Legacy_Events_Poland',
    ],
    'knowsAbout' => ['organizacja wydarzeń', 'eventy na zamkach', 'videomapping', 'pokazy laserowe', 'technika sceniczna', 'animacje dla dzieci', 'fireshow', 'gry terenowe'],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Oferta LegacyEvents',
        'itemListElement' => array_map(fn($k) => [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'Service',
                'name' => preg_replace('/ \| LegacyEvents$/', '', $seo_pages[$k]['title']),
                'description' => $seo_pages[$k]['desc'],
                'url' => $site_url . $seo_pages[$k]['path'],
            ],
        ], ['oferta_wydarzenia', 'oferta_technika', 'oferta_animacje', 'oferta_rental', 'oferta_koncerty', 'oferta_zamki']),
    ],
];
