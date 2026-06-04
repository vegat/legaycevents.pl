<?php require_once 'header.php'; ?>

<main class="page-wrapper">
    <section class="subpage-hero">
        <h1 class="subpage-title">Blog <span class="magical-text">LegacyEvents</span></h1>
        <p class="subpage-subtitle">Kuluarowe historie zza sceny, inspiracje branżowe, poradniki dla organizatorów i
            aktualności ze świata magii.</p>
    </section>

    <section class="content-section">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 40px;">
            <?php
            $posts_json = __DIR__ . '/data/posts.json';
            $posts = file_exists($posts_json) ? json_decode(file_get_contents($posts_json), true) : [];
            
            if (empty($posts)) {
                echo '<p style="text-align:center; grid-column: 1 / -1;">Brak wpisów na blogu.</p>';
            }

            foreach ((array)$posts as $post) {
                $img = !empty($post['image']) ? $post['image'] : 'assets/Logo/legacyevents_transparent.png'; 
                $date_formatted = date('d.m.Y', strtotime($post['date']));

                echo '<article style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; transition: transform 0.3s; display:flex; flex-direction:column;" onmouseover="this.style.transform=\'translateY(-5px)\'; this.style.borderColor=\'var(--primary-color)\'" onmouseout="this.style.transform=\'translateY(0)\'; this.style.borderColor=\'var(--border-color)\'">';
                echo '<a href="post?slug=' . htmlspecialchars($post['slug']) . '" style="text-decoration:none; color:inherit; display:flex; flex-direction:column; flex-grow:1;">';
                
                echo '<div style="height: 200px; overflow: hidden;">';
                echo '<img src="' . htmlspecialchars($img) . '" alt="Blog Image" style="width: 100%; height: 100%; object-fit: cover;">';
                echo '</div>';
                
                echo '<div style="padding: 25px; display:flex; flex-direction:column; flex-grow:1;">';
                echo '<span style="color: var(--primary-color); font-size: 0.9rem; font-weight: 600;">' . $date_formatted . '</span>';
                echo '<h3 style="font-family: var(--font-heading); color: #fff; font-size: 1.4rem; margin: 10px 0;">' . htmlspecialchars($post['title']) . '</h3>';
                echo '<p style="color: var(--text-muted); line-height: 1.6; margin-bottom: 20px; flex-grow:1;">' . htmlspecialchars($post['excerpt']) . '</p>';
                echo '<span style="color: #fff; font-weight: 600; text-decoration: underline; text-decoration-color: var(--primary-color); margin-top:auto;">Czytaj więcej</span>';
                echo '</div>';
                
                echo '</a>';
                echo '</article>';
            }
            ?>
        </div>
    </section>
</main>

<?php require_once 'footer.php'; ?>