<?php
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', '300');
session_start();

$data_dir = __DIR__ . '/data';
if (!is_dir($data_dir)) {
    @mkdir($data_dir, 0755, true);
}

$admin_json = $data_dir . '/admin.json';
$attempts_json = $data_dir . '/login_attempts.json';

// Odbudowanie admin.json z domyślnym hasłem, jeśli Git usunął plik lub hasło uległo uszkodzeniu (slash)
$needs_fix = true;
if (file_exists($admin_json)) {
    $cfg = json_decode(file_get_contents($admin_json), true);
    if (isset($cfg['password_hash']) && strpos($cfg['password_hash'], '\\/') === false) {
        $needs_fix = false;
    }
}
if ($needs_fix) {
    file_put_contents($admin_json, json_encode(['password_hash' => '$2y$05$xdY9fcy/5uFF3JJpzZnWdONbR4msbLL6bILiV.FqsFblPsjAPH4IS']));
    if (file_exists($attempts_json)) @unlink($attempts_json); // Odblokowanie po błędzie
}

$seo_json = $data_dir . '/seo_config.json';
if (!file_exists($seo_json)) {
    file_put_contents($seo_json, json_encode([
        'global_title' => 'LegacyEvents - Tworzymy światy, nie tylko eventy',
        'global_description' => 'Kompleksowa organizacja wydarzeń. Scenotechnika, efekty wizualne, nagłośnienie i oświetlenie. Zobacz naszą ofertę!',
        'geo_placename' => 'Bolków',
        'geo_position' => '50.92, 16.10',
        'og_image' => 'https://widget.legacyevents.pl/assets/Logo/legacyevents_transparent.png'
    ], JSON_PRETTY_PRINT));
}

$pages_seo_file = $data_dir . '/pages_seo.json';
if (!file_exists($pages_seo_file)) {
    $default_pages_seo = [
        'index.php' => ['title' => 'LegacyEvents - Tworzymy światy, nie tylko eventy', 'desc' => 'Tworzymy niesamowite wydarzenia, koncerty, eventy firmowe oraz pokazy sceniczne. Poznaj możliwości agencji LegacyEvents na Dolnym Śląsku.'],
        'oferta.php' => ['title' => 'Pełna Oferta - Technika, Wynajem, Animacje', 'desc' => 'Odkryj potężny arsenał możliwości LegacyEvents. Wynajem sprzętu, nagłośnienie, oświetlenie, animacje i technika estradowa.'],
        'oferta_animacje.php' => ['title' => 'Animacje i Kostiumy | Atrakcje na event', 'desc' => 'Zaczaruj swój event z LegacyEvents! Wynajem przepięknych kostiumów i profesjonalne animacje dla dzieci i dorosłych.'],
        'oferta_koncerty.php' => ['title' => 'Realizacja Koncertów | Obsługa Techniczna', 'desc' => 'Krystalicznie czysty dźwięk i oszałamiające efekty świetlne. Kompleksowa realizacja techniczna koncertów plenerowych, klubowych i festiwali.'],
        'oferta_rental.php' => ['title' => 'Wynajem Sprzętu Eventowego', 'desc' => 'Profesjonalny rental sprzętu eventowego. Oferujemy nowoczesne nagłośnienie, oświetlenie, konstrukcje sceniczne i lasery.'],
        'oferta_technika.php' => ['title' => 'Technika Sceniczna i Światła', 'desc' => 'Potężne nagłośnienie i widowiskowe światła. Zaufaj specjalistom z LegacyEvents i wykorzystaj bezkompromisową technikę sceniczną.'],
        'oferta_wydarzenia.php' => ['title' => 'Organizacja Wydarzeń i Eventów', 'desc' => 'Kompleksowo prowadzimy wydarzenia korporacyjne, festyny, eventy promocyjne i masowe od pierwszego szkicu aż po wielki finał.'],
        'oferta_zamki.php' => ['title' => 'Dmuchane Zamki i Zjeżdżalnie na Wynajem', 'desc' => 'Rozkręć każdą imprezę plenerową! Wypożycz ogromne dmuchane zamki, potężne zjeżdżalnie i kolorowe atrakcje dla dzieci.'],
        'kontakt.php' => ['title' => 'Kontakt z LegacyEvents', 'desc' => 'Masz pomysł na spektakularny event? Skontaktuj się z agencją LegacyEvents! Szybka darmowa wycena i doradztwo techniczne.'],
        'galeria.php' => ['title' => 'Galeria Realizacji Eventowych', 'desc' => 'Obrazy mówią więcej niż tysiąc słów. Zobacz zjawiskowe zdjęcia z naszych dotychczasowych realizacji, pokazów i koncertów.'],
        'wspolpracujemy.php' => ['title' => 'Nasi Partnerzy', 'desc' => 'Poznaj zaufane marki i profesjonalistów, z którymi LegacyEvents współtworzy największe widowiska na terenie całej Polski.']
    ];
    file_put_contents($pages_seo_file, json_encode($default_pages_seo, JSON_PRETTY_PRINT));
}

$posts_json = $data_dir . '/posts.json';
$upload_dir = __DIR__ . '/assets/blog/';

// --- Anti-bruteforce ---
$ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
$attempts_data = file_exists($attempts_json) ? json_decode(file_get_contents($attempts_json), true) : [];
if (!is_array($attempts_data)) $attempts_data = [];

// Clear old attempts (> 15 mins)
$now = time();
foreach ($attempts_data as $ip_key => $data) {
    if ($now - $data['time'] > 900) {
        unset($attempts_data[$ip_key]);
    }
}

if (isset($attempts_data[$ip]) && $attempts_data[$ip]['count'] >= 5) {
    die("Zbyt wiele nieudanych próśb logowania z tego IP. Zablokowano na 15 minut.");
}

// --- Login Handle ---
$admin_config = file_exists($admin_json) ? json_decode(file_get_contents($admin_json), true) : [];
$password_hash = $admin_config['password_hash'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if (password_verify($_POST['password'], $password_hash)) {
        $_SESSION['admin_logged_in'] = true;
        unset($attempts_data[$ip]);
    } else {
        $attempts_data[$ip] = [
            'count' => ($attempts_data[$ip]['count'] ?? 0) + 1,
            'time' => $now
        ];
    }
    file_put_contents($attempts_json, json_encode($attempts_data));
    header("Location: adminpanel");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: adminpanel");
    exit;
}

$is_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// --- Helper Functions ---
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

function processImage($file, $upload_dir) {
    if ($file['error'] !== UPLOAD_ERR_OK) return null;
    $info = getimagesize($file['tmp_name']);
    if ($info === false) return null;
    
    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg': $img = imagecreatefromjpeg($file['tmp_name']); break;
        case 'image/png': $img = imagecreatefrompng($file['tmp_name']); break;
        case 'image/webp': $img = imagecreatefromwebp($file['tmp_name']); break;
        default: return null;
    }
    
    $width = imagesx($img);
    $height = imagesy($img);
    
    // Target 16:9
    $target_ratio = 16 / 9;
    $current_ratio = $width / $height;
    
    if ($current_ratio > $target_ratio) {
        $new_width = $height * $target_ratio;
        $new_height = $height;
        $x = ($width - $new_width) / 2;
        $y = 0;
    } else {
        $new_width = $width;
        $new_height = $width / $target_ratio;
        $x = 0;
        $y = ($height - $new_height) / 2;
    }
    
    $new_img = imagecreatetruecolor((int)$new_width, (int)$new_height);
    // preserve transparency
    if ($mime == 'image/png' || $mime == 'image/webp') {
        imagealphablending($new_img, false);
        imagesavealpha($new_img, true);
        $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
        imagefilledrectangle($new_img, 0, 0, (int)$new_width, (int)$new_height, $transparent);
    }
    
    imagecopyresampled($new_img, $img, 0, 0, (int)$x, (int)$y, (int)$new_width, (int)$new_height, (int)$new_width, (int)$new_height);
    
    $filename = uniqid('blog_') . '.webp';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
    imagewebp($new_img, $upload_dir . $filename, 85);
    
    imagedestroy($img);
    imagedestroy($new_img);
    
    return 'assets/blog/' . $filename;
}

function processGalleryImage($tmp_name, $mime, $upload_dir) {
    if (!file_exists($tmp_name)) return null;
    
    switch ($mime) {
        case 'image/jpeg': $img = imagecreatefromjpeg($tmp_name); break;
        case 'image/png': $img = imagecreatefrompng($tmp_name); break;
        case 'image/webp': $img = imagecreatefromwebp($tmp_name); break;
        default: return null;
    }
    
    $width = imagesx($img);
    $height = imagesy($img);
    
    // Scale down if larger than 1920px
    $max_dim = 1920;
    if ($width > $max_dim || $height > $max_dim) {
        if ($width > $height) {
            $new_width = $max_dim;
            $new_height = ($max_dim / $width) * $height;
        } else {
            $new_height = $max_dim;
            $new_width = ($max_dim / $height) * $width;
        }
    } else {
        $new_width = $width;
        $new_height = $height;
    }
    
    $new_img = imagecreatetruecolor((int)$new_width, (int)$new_height);
    if ($mime == 'image/png' || $mime == 'image/webp') {
        imagealphablending($new_img, false);
        imagesavealpha($new_img, true);
        $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
        imagefilledrectangle($new_img, 0, 0, (int)$new_width, (int)$new_height, $transparent);
    }
    
    imagecopyresampled($new_img, $img, 0, 0, 0, 0, (int)$new_width, (int)$new_height, $width, $height);
    
    $filename = uniqid('gallery_') . '.webp';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
    imagewebp($new_img, $upload_dir . $filename, 85);
    
    imagedestroy($img);
    imagedestroy($new_img);
    
    return 'assets/blog/' . $filename;
}

// --- CRUD Actions ---
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $posts = file_exists($posts_json) ? json_decode(file_get_contents($posts_json), true) : [];
    if (!is_array($posts)) $posts = [];
    
    // Save SEO settings
    if ($_POST['action'] === 'save_seo') {
        $seo_data = [
            'global_title' => $_POST['global_title'],
            'global_description' => $_POST['global_description'],
            'geo_placename' => $_POST['geo_placename'],
            'geo_position' => $_POST['geo_position'],
            'og_image' => $_POST['og_image']
        ];
        file_put_contents($seo_json, json_encode($seo_data, JSON_PRETTY_PRINT));
        header("Location: adminpanel?msg=Ustawienia+SEO+zapisane");
        exit;
    }

    // Save Subpage SEO
    if ($_POST['action'] === 'save_subpage_seo') {
        $page_id = $_POST['page_id'];
        $pages_seo_file = $data_dir . '/pages_seo.json';
        $pages_seo = file_exists($pages_seo_file) ? json_decode(file_get_contents($pages_seo_file), true) : [];
        if ($page_id && isset($pages_seo[$page_id])) {
            $pages_seo[$page_id]['title'] = $_POST['page_title'];
            $pages_seo[$page_id]['desc'] = $_POST['page_desc'];
            file_put_contents($pages_seo_file, json_encode($pages_seo, JSON_PRETTY_PRINT));
            header("Location: adminpanel?msg=SEO+Podstrony+zapisane");
            exit;
        }
    }

    // Save Graphics SEO
    if ($_POST['action'] === 'save_graphics_seo') {
        $graphics_seo_file = $data_dir . '/graphics_seo.json';
        $graphics_seo = file_exists($graphics_seo_file) ? json_decode(file_get_contents($graphics_seo_file), true) : [];
        if (!is_array($graphics_seo)) $graphics_seo = [];
        
        $alts = $_POST['gfx_alt'] ?? [];
        $titles = $_POST['gfx_title'] ?? [];
        
        foreach ($alts as $filepath => $alt_text) {
            $alt_text = trim($alt_text);
            $title_text = trim($titles[$filepath] ?? '');
            
            if (!isset($graphics_seo[$filepath])) {
                $graphics_seo[$filepath] = [];
            }
            $graphics_seo[$filepath]['alt'] = $alt_text;
            $graphics_seo[$filepath]['title'] = $title_text;
            
            // Clean up empty records to save space
            if (empty($alt_text) && empty($title_text)) {
                unset($graphics_seo[$filepath]);
            }
        }
        
        file_put_contents($graphics_seo_file, json_encode($graphics_seo, JSON_PRETTY_PRINT));
        header("Location: adminpanel?msg=SEO+Grafik+zapisane");
        exit;
    }

    // Save NextEvent
    $next_event_json = __DIR__ . '/LegacyNextEvent.json';
    if ($_POST['action'] === 'save_nextevent') {
        $event_data = [
            'active' => isset($_POST['event_active']) ? true : false,
            'title' => $_POST['event_title'],
            'subtitle' => $_POST['event_subtitle'],
            'date' => $_POST['event_date'],
            'link' => $_POST['event_link']
        ];
        file_put_contents($next_event_json, json_encode($event_data, JSON_PRETTY_PRINT));
        header("Location: adminpanel?msg=Wydarzenie+NextEvent+zapisane");
        exit;
    }
    
    if ($_POST['action'] === 'add' || $_POST['action'] === 'edit') {
        $id = $_POST['id'] ?? uniqid();
        $title = trim($_POST['title']);
        $content = $_POST['content']; 
        $excerpt = strip_tags($content);
        $excerpt = mb_strlen($excerpt) > 150 ? mb_substr($excerpt, 0, 150) . '...' : $excerpt;
        
        $post = [
            'id' => $id,
            'title' => $title,
            'slug' => slugify($title) . '-' . substr($id, 0, 4),
            'content' => $content,
            'excerpt' => $excerpt,
            'date' => !empty($_POST['date']) ? $_POST['date'] : date('Y-m-d H:i:s'),
            'geo_placename' => !empty($_POST['geo_placename']) ? trim($_POST['geo_placename']) : 'Bolków',
            'geo_position' => !empty($_POST['geo_position']) ? trim($_POST['geo_position']) : '50.92, 16.10',
            'image' => '',
            'gallery' => []
        ];
        
        if ($_POST['action'] === 'edit') {
            foreach ($posts as &$p) {
                if ($p['id'] === $id) {
                    $post['image'] = $p['image'] ?? '';
                    $post['slug'] = $p['slug'] ?? $post['slug'];
                    $post['gallery'] = $p['gallery'] ?? [];
                    break;
                }
            }
        }
        
        // Handle gallery deletions
        if (isset($_POST['delete_gallery']) && is_array($_POST['delete_gallery'])) {
            $post['gallery'] = array_filter($post['gallery'], function($img) {
                return !in_array($img, $_POST['delete_gallery']);
            });
            $post['gallery'] = array_values($post['gallery']);
        }
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploaded_image = processImage($_FILES['image'], $upload_dir);
            if ($uploaded_image) {
                $post['image'] = $uploaded_image;
            }
        }
        
        // Process new gallery uploads
        if (isset($_FILES['gallery_images'])) {
            $file_count = count($_FILES['gallery_images']['name']);
            for ($i = 0; $i < $file_count; $i++) {
                if ($_FILES['gallery_images']['error'][$i] === UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['gallery_images']['tmp_name'][$i];
                    $mime = $_FILES['gallery_images']['type'][$i];
                    $processed = processGalleryImage($tmp_name, $mime, $upload_dir);
                    if ($processed) {
                        $post['gallery'][] = $processed;
                    }
                }
            }
        }
        
        if ($_POST['action'] === 'edit') {
            foreach ($posts as $k => $p) {
                if ($p['id'] === $id) {
                    $posts[$k] = $post;
                    break;
                }
            }
        } else {
            array_unshift($posts, $post);
        }
        
        file_put_contents($posts_json, json_encode($posts, JSON_PRETTY_PRINT));
        header("Location: adminpanel?msg=Zapisano");
        exit;
    }
    
    if ($_POST['action'] === 'delete') {
        $id = $_POST['id'];
        $posts = array_filter($posts, function($p) use ($id) { return $p['id'] !== $id; });
        file_put_contents($posts_json, json_encode(array_values($posts), JSON_PRETTY_PRINT));
        header("Location: adminpanel?msg=Usunięto");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - LegacyEvents Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background: #0a0a12; color: #fff; margin:0; padding:20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .login-box { max-width: 400px; margin: 100px auto; background: #1a1a24; padding: 30px; border-radius: 10px; border: 1px solid #333; }
        input[type="text"], input[type="password"], input[type="file"] { width: 100%; padding: 10px; margin: 10px 0; background: #0a0a12; border: 1px solid #444; color: #fff; border-radius: 5px; box-sizing: border-box;}
        button { background: #8a2be2; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; font-weight: bold; }
        button:hover { background: #9b4dca; }
        .post-item { background: #1a1a24; margin-bottom: 15px; padding: 15px; border-radius: 8px; border: 1px solid #333; display: flex; justify-content: space-between; align-items: center; }
        .post-item img { width: 120px; height: auto; border-radius: 5px; margin-right: 15px; }
        .editor-container { background: #fff; color: #000; margin-bottom: 20px; border-radius: 5px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid #333; padding-bottom: 15px; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .modal { display: none; position: fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8); padding:50px; box-sizing: border-box; overflow-y: auto; z-index: 999;}
        .modal-content { background: #1a1a24; padding: 30px; max-width: 800px; margin: 0 auto; border-radius: 10px; border: 1px solid #444;}
        .gallery-preview { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .gallery-preview-item { position: relative; width: 100px; height: 100px; border-radius: 5px; overflow: hidden; border: 1px solid #444;}
        .gallery-preview-item img { width: 100%; height: 100%; object-fit: cover; }
        .gallery-preview-item label { position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(231, 76, 60, 0.9); color: white; text-align: center; font-size: 0.8rem; padding: 2px 0; cursor: pointer; }
    </style>
</head>
<body>
<div class="container">
    <?php if (!$is_logged_in): ?>
        <div class="login-box">
            <h2>Logowanie do panelu</h2>
            <form method="POST">
                <input type="password" name="password" placeholder="Hasło" required>
                <button type="submit" name="login">Zaloguj</button>
            </form>
        </div>
    <?php else: ?>
        <div class="admin-header">
            <h2>Zarządzanie Stroną</h2>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <button onclick="document.getElementById('nextEventModal').style.display='block'" style="background:#f39c12; margin:0;">Zarządzaj NextEvent</button>
                <button onclick="document.getElementById('subSeoModal').style.display='block'" style="background:#8e44ad; margin:0;">SEO Podstron</button>
                <button onclick="document.getElementById('seoModal').style.display='block'" style="background:var(--primary-color); margin:0;">Globalne SEO/GEO</button>
                <button onclick="document.getElementById('graphicsSeoModal').style.display='block'" style="background:#27ae60; margin:0;">SEO Grafik</button>
                <a href="?logout=1" style="color:#fff; text-decoration:none; margin-left: 15px;">Wyloguj</a>
            </div>
        </div>
        
        <?php 
        // Detekcja przekroczenia limitu post_max_size
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 0) {
            echo '<p style="color:#e74c3c; background: rgba(231,76,60,0.1); padding:10px; border-radius:5px;">Błąd: Przekroczono limit serwera dla wielkości jednorazowo wgrywanych plików (waga wszystkich zdjęć naraz jest zbyt duża). Spróbuj wgrać mniejszą ilość zdjęć na raz.</p>';
        }
        
        if(isset($_GET['msg'])) echo '<p style="color:#2ecc71; background: rgba(46,204,113,0.1); padding:10px; border-radius:5px;">'.htmlspecialchars($_GET['msg']).'</p>'; 
        ?>
        
        <div style="margin-bottom: 20px;">
            <h3>Wpisy Blogowe</h3>
            <button onclick="openModal('add')">Dodaj Nowy Wpis</button>
        </div>
        
        <h3 style="margin-top: 40px;">Lista postów</h3>
        <?php 
        $posts = file_exists($posts_json) ? json_decode(file_get_contents($posts_json), true) : [];
        if (empty($posts)) echo '<p>Brak wpisów.</p>';
        foreach ((array)$posts as $p): ?>
            <div class="post-item">
                <div style="display:flex; align-items:center;">
                    <?php if(!empty($p['image'])) echo '<img src="'.htmlspecialchars($p['image']).'" alt="img">'; ?>
                    <div>
                        <h4><?= htmlspecialchars($p['title']) ?></h4>
                        <small><?= $p['date'] ?></small>
                    </div>
                </div>
                <div>
                    <button onclick="openModal('edit', '<?= $p['id'] ?>')">Edytuj</button>
                    <form method="POST" style="display:inline;" onsubmit="return confirm('Napewno usunąć?');">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <button type="submit" class="btn-danger">Usuń</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Modal -->
        <div id="editorModal" class="modal">
            <div class="modal-content">
                <h3 id="modalTitle">Dodaj/Edytuj Wpis</h3>
                <form id="postForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="id" id="formId" value="">
                    
                    <label>Tytuł:</label>
                    <input type="text" name="title" id="formTitle" required>
                    
                    <div style="display:flex; gap:15px; margin-top:10px;">
                        <div style="flex:1;">
                            <label>Data publikacji:</label>
                            <input type="text" name="date" id="formDate" placeholder="YYYY-MM-DD HH:MM:SS">
                        </div>
                        <div style="flex:1;">
                            <label>GEO Nazwa (np. Bolków):</label>
                            <input type="text" name="geo_placename" id="formGeoName" placeholder="Opcjonalnie (domyślnie Bolków)">
                        </div>
                        <div style="flex:1;">
                            <label>GEO Koordynaty (np. 50.92, 16.10):</label>
                            <input type="text" name="geo_position" id="formGeoPos" placeholder="Opcjonalnie">
                        </div>
                    </div>
                    
                    <label style="margin-top:15px; display:block;">Zdjęcie / Miniatura (zostanie automatycznie docięte do 16:9):</label>
                    <input type="file" name="image" accept="image/*" id="formImage">
                    
                    <label>Treść wpisu:</label>
                    <div class="editor-container">
                        <div id="quillEditor" style="height: 300px;"></div>
                    </div>
                    <textarea name="content" id="formContent" style="display:none;"></textarea>
                    
                    <div style="margin-top:20px; padding-top:20px; border-top:1px solid #333;">
                        <label>Zdjęcia do galerii pod postem (można zaznaczyć wiele):</label>
                        <input type="file" name="gallery_images[]" accept="image/*" multiple id="formGallery">
                        <div id="existingGallery" class="gallery-preview"></div>
                    </div>
                    
                    <div style="margin-top: 30px;">
                        <button type="submit" onclick="submitForm(event)">Zapisz Wpis</button>
                        <button type="button" class="btn-danger" onclick="document.getElementById('editorModal').style.display='none'">Anuluj</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Modal Global SEO -->
        <div id="seoModal" class="modal">
            <div class="modal-content">
                <h3>Globalne Ustawienia SEO & GEO</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="save_seo">
                    <?php $seo_config = file_exists($seo_json) ? json_decode(file_get_contents($seo_json), true) : []; ?>
                    
                    <label>Domyślny Tytuł Strony (Meta Title):</label>
                    <input type="text" name="global_title" value="<?= htmlspecialchars($seo_config['global_title'] ?? '') ?>" required>
                    
                    <label>Domyślny Opis Strony (Meta Description):</label>
                    <textarea name="global_description" style="width:100%; height:100px; background:#222; border:1px solid #444; color:#fff; padding:10px; margin-bottom:15px;"><?= htmlspecialchars($seo_config['global_description'] ?? '') ?></textarea>
                    
                    <label>Globalna Nazwa GEO:</label>
                    <input type="text" name="geo_placename" value="<?= htmlspecialchars($seo_config['geo_placename'] ?? '') ?>">
                    
                    <label>Globalne Koordynaty GEO:</label>
                    <input type="text" name="geo_position" value="<?= htmlspecialchars($seo_config['geo_position'] ?? '') ?>">
                    
                    <label>Globalne Zdjęcie OpenGraph (URL):</label>
                    <input type="text" name="og_image" value="<?= htmlspecialchars($seo_config['og_image'] ?? '') ?>">
                    
                    <div style="margin-top: 20px;">
                        <button type="submit">Zapisz Globalne SEO</button>
                        <button type="button" class="btn-danger" onclick="document.getElementById('seoModal').style.display='none'">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Subpage SEO -->
        <div id="subSeoModal" class="modal">
            <div class="modal-content">
                <h3>Indywidualne SEO Podstron</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="save_subpage_seo">
                    <?php 
                    $pages_seo_file = __DIR__ . '/data/pages_seo.json';
                    $pages_seo = [];
                    if (file_exists($pages_seo_file)) {
                        $json_content = file_get_contents($pages_seo_file);
                        $decoded = json_decode($json_content, true);
                        if (is_array($decoded)) {
                            $pages_seo = $decoded;
                        } else {
                            // Awaryjne logowanie jeśli JSON jest uszkodzony
                            error_log("Błąd dekodowania JSON: " . json_last_error_msg());
                        }
                    }
                    ?>
                    <label>Wybierz podstronę do edycji:</label>
                    <?php if (empty($pages_seo)): ?>
                        <div style="background: rgba(231,76,60,0.2); border: 1px solid #e74c3c; color: #fff; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                            <strong>Błąd krytyczny z plikiem bazy!</strong><br>
                            Ścieżka: <?= $pages_seo_file ?><br>
                            Czy istnieje na serwerze: <?= file_exists($pages_seo_file) ? 'TAK' : 'NIE' ?><br>
                            Błąd JSON: <?= json_last_error_msg() ?>
                        </div>
                    <?php endif; ?>
                    <select name="page_id" id="subpageSelect" onchange="updateSubpageSeoForm()" style="width:100%; padding:10px; margin-bottom:15px; background:#222; color:#fff; border:1px solid #444; border-radius:5px;">
                        <option value="">-- Wybierz --</option>
                        <?php foreach($pages_seo as $file => $data): ?>
                            <option value="<?= htmlspecialchars($file) ?>"><?= htmlspecialchars($file) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div id="subpageSeoFields" style="display:none;">
                        <label>Tytuł (Title):</label>
                        <input type="text" name="page_title" id="subpageTitle" required>
                        
                        <label>Opis (Description):</label>
                        <textarea name="page_desc" id="subpageDesc" style="width:100%; height:100px; background:#222; border:1px solid #444; color:#fff; padding:10px; margin-bottom:15px;" required></textarea>
                        
                        <div style="margin-top: 20px;">
                            <button type="submit">Zapisz SEO dla tej strony</button>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <button type="button" class="btn-danger" onclick="document.getElementById('subSeoModal').style.display='none'">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal NextEvent -->
        <div id="nextEventModal" class="modal">
            <div class="modal-content">
                <h3>Zarządzanie Nadchodzącym Wydarzeniem</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="save_nextevent">
                    <?php 
                    $next_event_file = __DIR__ . '/LegacyNextEvent.json';
                    $ne = file_exists($next_event_file) ? json_decode(file_get_contents($next_event_file), true) : [];
                    $isActive = isset($ne['active']) && $ne['active'] ? 'checked' : '';
                    ?>
                    
                    <label style="display:flex; align-items:center; gap:10px; cursor:pointer; margin-bottom: 20px; font-weight:bold;">
                        <input type="checkbox" name="event_active" value="1" <?= $isActive ?> style="width:20px; height:20px; margin:0;">
                        Aktywuj Wydarzenie na Stronie Głównej
                    </label>
                    
                    <label>Nazwa / Tytuł:</label>
                    <input type="text" name="event_title" value="<?= htmlspecialchars($ne['title'] ?? '') ?>">
                    
                    <label>Sub-tytuł:</label>
                    <input type="text" name="event_subtitle" value="<?= htmlspecialchars($ne['subtitle'] ?? 'Już wkrótce zobaczymy się na...') ?>">
                    
                    <label>Data wydarzenia:</label>
                    <input type="text" name="event_date" value="<?= htmlspecialchars($ne['date'] ?? '') ?>">
                    
                    <label>Link docelowy (URL):</label>
                    <input type="text" name="event_link" value="<?= htmlspecialchars($ne['link'] ?? '#') ?>">
                    
                    <div style="margin-top: 20px;">
                        <button type="submit">Zapisz Wydarzenie</button>
                        <button type="button" class="btn-danger" onclick="document.getElementById('nextEventModal').style.display='none'">Zamknij</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Graphics SEO -->
        <div id="graphicsSeoModal" class="modal">
            <div class="modal-content" style="max-width: 1000px;">
                <h3>Optymalizacja SEO / GEO Grafik (ALT & TITLE)</h3>
                <p style="color:var(--text-muted); margin-bottom:20px;">Wpisz opisy, które odczyta Google. Warto dodawać słowa kluczowe (np. "Wynajem nagłośnienia") i lokalizacje GEO (np. "Wrocław", "Jelenia Góra"). Puste opisy nie zostaną nadpisane na stronie.</p>
                
                <form method="POST">
                    <input type="hidden" name="action" value="save_graphics_seo">
                    
                    <div style="max-height: 60vh; overflow-y: auto; padding-right:10px;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                            <?php
                            $graphics_seo_file = $data_dir . '/graphics_seo.json';
                            $graphics_seo = file_exists($graphics_seo_file) ? json_decode(file_get_contents($graphics_seo_file), true) : [];
                            if (!is_array($graphics_seo)) $graphics_seo = [];
                            
                            $event_photos = glob('assets/EventPhotos/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                            $blog_photos = glob('assets/blog/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
                            $all_images = array_merge(is_array($event_photos) ? $event_photos : [], is_array($blog_photos) ? $blog_photos : []);
                            if (!empty($all_images)): 
                                foreach ($all_images as $img_path):
                                    $encoded_path = htmlspecialchars($img_path);
                                    $alt = $graphics_seo[$img_path]['alt'] ?? '';
                                    $title = $graphics_seo[$img_path]['title'] ?? '';
                                    $img_src = 'image.php?src=' . urlencode(str_replace('assets/', '', $img_path)) . '&w=300&h=200&crop=1';
                            ?>
                                <div style="background: #222; border: 1px solid #444; border-radius: 8px; overflow: hidden; display:flex; flex-direction:column;">
                                    <div style="height:150px; background: #111;">
                                        <img src="<?= $img_src ?>" alt="thumb" style="width:100%; height:100%; object-fit:cover;">
                                    </div>
                                    <div style="padding: 10px; display:flex; flex-direction:column; gap:10px;">
                                        <div>
                                            <label style="font-size:0.8rem; color:#aaa; margin-bottom:2px;">Tekst Alternatywny (ALT):</label>
                                            <input type="text" name="gfx_alt[<?= $encoded_path ?>]" value="<?= htmlspecialchars($alt) ?>" placeholder="np. Wynajem oświetlenia" style="width:100%; padding:5px; font-size:0.9rem;">
                                        </div>
                                        <div>
                                            <label style="font-size:0.8rem; color:#aaa; margin-bottom:2px;">Tytuł GEO (TITLE - opcjonalnie):</label>
                                            <input type="text" name="gfx_title[<?= $encoded_path ?>]" value="<?= htmlspecialchars($title) ?>" placeholder="np. Legnica" style="width:100%; padding:5px; font-size:0.9rem;">
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                endforeach; 
                            else: 
                                echo '<p>Brak zdjęć w galeriach EventPhotos i blog.</p>';
                            endif; 
                            ?>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px; display:flex; gap:10px; align-items:center;">
                        <button type="submit" style="background:#27ae60;">Zapisz SEO Wszystkich Grafik</button>
                        <button type="button" class="btn-danger" onclick="document.getElementById('graphicsSeoModal').style.display='none'">Zamknij okno</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            var pagesSeoData = <?= json_encode($pages_seo ?? []) ?>;
            function updateSubpageSeoForm() {
                var select = document.getElementById('subpageSelect');
                var fields = document.getElementById('subpageSeoFields');
                var title = document.getElementById('subpageTitle');
                var desc = document.getElementById('subpageDesc');
                var file = select.value;
                if(file && pagesSeoData[file]) {
                    fields.style.display = 'block';
                    title.value = pagesSeoData[file].title;
                    desc.value = pagesSeoData[file].desc;
                } else {
                    fields.style.display = 'none';
                }
            }

            var quill = new Quill('#quillEditor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            var postsData = <?= json_encode($posts) ?>;

            function openModal(action, id = null) {
                document.getElementById('editorModal').style.display = 'block';
                document.getElementById('formAction').value = action;
                document.getElementById('modalTitle').innerText = action === 'add' ? 'Dodaj Nowy Wpis' : 'Edytuj Wpis';
                
                if (action === 'edit') {
                    var post = postsData.find(p => p.id === id);
                    if(post) {
                        document.getElementById('formId').value = post.id;
                        document.getElementById('formTitle').value = post.title;
                        document.getElementById('formDate').value = post.date || '';
                        document.getElementById('formGeoName').value = post.geo_placename || 'Bolków';
                        document.getElementById('formGeoPos').value = post.geo_position || '50.92, 16.10';
                        quill.root.innerHTML = post.content;
                        document.getElementById('formImage').required = false;
                        
                        var galleryHtml = '';
                        if(post.gallery && post.gallery.length > 0) {
                            post.gallery.forEach(function(img) {
                                galleryHtml += '<div class="gallery-preview-item">';
                                galleryHtml += '<img src="'+img+'" alt="gallery image">';
                                galleryHtml += '<label><input type="checkbox" name="delete_gallery[]" value="'+img+'"> Usuń</label>';
                                galleryHtml += '</div>';
                            });
                        }
                        document.getElementById('existingGallery').innerHTML = galleryHtml;
                    }
                } else {
                    document.getElementById('formId').value = '';
                    document.getElementById('formTitle').value = '';
                    document.getElementById('formDate').value = new Date().toISOString().slice(0, 19).replace('T', ' ');
                    document.getElementById('formGeoName').value = 'Bolków';
                    document.getElementById('formGeoPos').value = '50.92, 16.10';
                    quill.root.innerHTML = '';
                    document.getElementById('formImage').required = true;
                    document.getElementById('existingGallery').innerHTML = '';
                }
            }

            function submitForm(e) {
                document.getElementById('formContent').value = quill.root.innerHTML;
            }
        </script>
    <?php endif; ?>
</div>
</body>
</html>
