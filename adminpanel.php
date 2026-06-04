<?php
ini_set('memory_limit', '1024M');
ini_set('max_execution_time', '300');
session_start();

$admin_json = __DIR__ . '/data/admin.json';
$attempts_json = __DIR__ . '/data/login_attempts.json';
$posts_json = __DIR__ . '/data/posts.json';
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
    
    if ($_POST['action'] === 'add' || $_POST['action'] === 'edit') {
        $id = $_POST['action'] === 'edit' ? $_POST['id'] : uniqid();
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
            'date' => date('Y-m-d H:i:s'),
            'image' => '',
            'gallery' => []
        ];
        
        if ($_POST['action'] === 'edit') {
            foreach ($posts as &$p) {
                if ($p['id'] === $id) {
                    $post['image'] = $p['image'] ?? '';
                    $post['date'] = $p['date'] ?? date('Y-m-d H:i:s');
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
            <h2>Zarządzanie Blogiem</h2>
            <a href="?logout=1" style="color:#fff; text-decoration:none;">Wyloguj</a>
        </div>
        
        <?php 
        // Detekcja przekroczenia limitu post_max_size
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 0) {
            echo '<p style="color:#e74c3c; background: rgba(231,76,60,0.1); padding:10px; border-radius:5px;">Błąd: Przekroczono limit serwera dla wielkości jednorazowo wgrywanych plików (waga wszystkich zdjęć naraz jest zbyt duża). Spróbuj wgrać mniejszą ilość zdjęć na raz.</p>';
        }
        
        if(isset($_GET['msg'])) echo '<p style="color:#2ecc71; background: rgba(46,204,113,0.1); padding:10px; border-radius:5px;">'.htmlspecialchars($_GET['msg']).'</p>'; 
        ?>

        <button onclick="openModal('add')">Dodaj Nowy Wpis</button>
        
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
                    
                    <label>Zdjęcie / Miniatura (zostanie automatycznie docięte do 16:9):</label>
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
                        <button type="submit" onclick="submitForm(event)">Zapisz</button>
                        <button type="button" class="btn-danger" onclick="document.getElementById('editorModal').style.display='none'">Anuluj</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
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
