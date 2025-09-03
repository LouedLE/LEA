<?php
$config = include 'config.php';

function db(): PDO {
    static $pdo;
    global $config;
    if ($pdo) return $pdo;
    $dsn = 'mysql:host='.$config['db_host'].';charset=utf8mb4';
    $pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $dbName = preg_replace('/[^a-zA-Z0-9_]+/','',$config['db_name']);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbName`");
    $pdo->exec("CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(160) NOT NULL,
        excerpt TEXT NOT NULL,
        price VARCHAR(60) NOT NULL,
        position INT NOT NULL DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        author VARCHAR(120) NOT NULL,
        rating TINYINT NOT NULL,
        content TEXT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $pdo->exec("CREATE TABLE IF NOT EXISTS quotes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(120) NOT NULL,
        email VARCHAR(190) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $pdo->exec("CREATE TABLE IF NOT EXISTS faq_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(190) NOT NULL,
    question TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new','read','done') NOT NULL DEFAULT 'new'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $count = $pdo->query("SELECT COUNT(*) c FROM services")->fetch()['c'] ?? 0;
    if ((int)$count === 0) {
        $stmt = $pdo->prepare("INSERT INTO services (title, excerpt, price, position) VALUES (?,?,?,?)");
        $stmt->execute(['Site vitrine essentiel','Une page propre et responsive.','499€',1]);
        $stmt->execute(['Vitrine + (3-5 pages)','Services, À propos, Contact.','990€',2]);
        $stmt->execute(['Pack SEO de base','Balises, sitemap, perfs essentielles.','149€',3]);
    }
    return $pdo;
}
function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$page = $_GET['page'] ?? 'home';
$flash = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($page === 'contact') {
        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $message = trim((string)($_POST['message'] ?? ''));
        if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && $message) {
            $st = db()->prepare("INSERT INTO quotes (name,email,message) VALUES (?,?,?)");
            $st->execute([$name,$email,$message]);
            $flash = "Merci, votre demande a bien été envoyée.";
        } else {
            $flash = "Veuillez compléter tous les champs correctement.";
        }
    }

    if ($page === 'faq') {
      $email = trim((string)($_POST['email'] ?? ''));
      $question = trim((string)($_POST['question'] ?? ''));
      if (filter_var($email, FILTER_VALIDATE_EMAIL) && $question) {
        $st = db()->prepare("INSERT INTO faq_questions (email, question) VALUES (?, ?)");
        $st->execute([$email, $question]);
        $flash = "Merci ! Votre question a bien été envoyée.";
      } else {
        $flash = "Veuillez saisir un email valide et une question.";
        }
    }

    if ($page === 'reviews') {
        $author = trim((string)($_POST['author'] ?? ''));
        $rating = (int)($_POST['rating'] ?? 0);
        $content = trim((string)($_POST['content'] ?? ''));
        if ($author && $rating>=1 && $rating<=5 && $content) {
            $st = db()->prepare("INSERT INTO reviews (author,rating,content) VALUES (?,?,?)");
            $st->execute([$author,$rating,$content]);
            $flash = "Merci pour votre avis !";
        } else {
            $flash = "Champs invalides.";
        }
    }
}

$services = db()->query("SELECT * FROM services ORDER BY position ASC, id DESC")->fetchAll();
$reviews  = db()->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 20")->fetchAll();
?><!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LEA Web Creation</title>
  <link rel="stylesheet" href="style.css">
  <script defer src="app.js"></script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-7W38J2B6RB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  // Consentement par défaut (à adapter si tu ajoutes une bannière)
  gtag('consent', 'default', {
    'ad_storage': 'denied',
    'analytics_storage': 'granted'
  });

  gtag('config', 'G-7W38J2B6RB', {
    'anonymize_ip': true // utile côté RGPD
  });
</script>


</head>
<body>
<header class="site-header">
  <div class="container">
    <a href="?page=home" class="logo">
  <a href="?page=home" class="logo">
  <img src="assets/logo.png" alt="LEA Web Creation" class="logo-img">
  <span class="logo-text">LEA WEB CREATION</span></a>
    <nav>
      <a href="?page=services">Services</a>
      <a href="?page=product">Produit</a>
      <a href="?page=contact">Devis</a>
      <a href="?page=reviews">Avis</a>
      <a href="?page=portfolio">Réalisations</a>
      <a href="?page=faq">FAQ</a>
      <a href="?page=about">À propos</a>
      <button class="theme-toggle" type="button" aria-label="Changer de thème">
      <span class="sun">☀️</span>
      <span class="moon">🌙</span>
</button>

    </nav>
  </div>
</header>

<main class="container">
<?php if ($flash): ?><div class="alert"><?= h($flash) ?></div><?php endif; ?>

<?php if ($page === 'home'): ?>
  <section class="hero" data-reveal>
    <h1>Des sites au design soigné, prêts en un rien de temps.</h1>
    <p>Un rendu premium, des chargements rapides, un SEO propre — sans complexité.</p>
    <a class="btn" href="?page=contact">Demander un devis</a>
    <div class="hero-art">
    <!-- Calque 1 (lent) -->
    <div class="px-layer px-l1"></div>
    <!-- Calque 2 (moyen) -->
    <div class="px-layer px-l2"></div>
    <!-- Calque 3 (rapide) -->
    <div class="px-layer px-l3"></div>
    <img src="assets/images/hero.png" alt="Présentation LEA Web Creation" class="hero-img"></div>
    <a class="btn" href="?page=contact" onclick="gtag('event','select_content',{content_type:'cta',item_id:'hero_devis'});">Demander un devis</a>
  </section>

  <section class="section">
    <h2>Nos services</h2>
    <div class="grid">
      <?php
      $iconMap = ['bolt','display','lock','speed','rocket','wand','shield'];
      $i = 0;
      foreach ($services as $s):
        $icon = $iconMap[$i % count($iconMap)]; $i++;
      ?>
        <div class="card" data-reveal>
        <img class="icon" src="assets/icons/<?= $icon ?>.svg" alt="" aria-hidden="true">
        <h3><?= h($s['title']) ?></h3>
        <p><?= h($s['excerpt']) ?></p>
        <p class="muted">À partir de <?= h($s['price']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section">
    <h2>Derniers avis</h2>
    <div class="grid">
      <?php foreach ($reviews as $r): ?>
        <div class="card" data-reveal>
  <div class="review-head">
    <img class="avatar" src="assets/images/avatars/default.png" alt="Avatar">
    <p class="muted">— <?= h($r['author']) ?> · <?= (int)$r['rating'] ?>/5</p>
  </div>
  <p>"<?= h($r['content']) ?>"</p>
</div>

      <?php endforeach; ?>
    </div>
  </section>

<?php elseif ($page === 'services'): ?>
  <h1>Services</h1>
  <div class="grid">
    <?php
      $iconMap = ['bolt','display','lock','speed','rocket','wand','shield'];
      $i = 0;
      foreach ($services as $s):
        $icon = $iconMap[$i % count($iconMap)]; $i++;
    ?>
      <div class="card" data-reveal>
        <img class="icon" src="assets/icons/<?= $icon ?>.svg" alt="" aria-hidden="true">
        <h3><?= h($s['title']) ?></h3>
        <p><?= h($s['excerpt']) ?></p>
        <p class="muted">À partir de <?= h($s['price']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

<?php elseif ($page === 'contact'): ?>
  <h1>Contact / Devis</h1>
  <form method="post" class="form" data-reveal>
    <label>Nom
      <input name="name" required>
    </label>
    <label>Email
      <input name="email" type="email" required>
    </label>
    <label>Votre besoin
      <textarea name="message" rows="6" required></textarea>
    </label>
    <button class="btn">Envoyer</button>
  </form>

  <!-- dans index.php, après l'ouverture du <form> de contact -->
<form method="post" class="form" data-reveal onsubmit="gtag('event','generate_lead',{event_category:'contact',event_label:'devis'});">

<?php elseif ($page === 'reviews'): ?>
  <h1>Vos avis</h1>
  <form method="post" class="form" data-reveal>
    <label>Votre nom
      <input name="author" required>
    </label>
    <label>Note
      <select name="rating" required>
        <?php for($i=1;$i<=5;$i++): ?>
          <option value="<?= $i ?>"><?= $i ?></option>
        <?php endfor; ?>
      </select>
    </label>
    <label>Commentaire
      <textarea name="content" rows="5" required></textarea>
    </label>
    <button class="btn">Publier</button>
  </form>

  <h2 class="section">Derniers avis</h2>
  <div class="grid">
    <?php foreach ($reviews as $r): ?>
      <div class="card" data-reveal>
        <p>"<?= h($r['content']) ?>"</p>
        <p class="muted">— <?= h($r['author']) ?> · <?= (int)$r['rating'] ?>/5</p>
      </div>
    <?php endforeach; ?>
  </div>


<?php elseif ($page === 'product'): ?>
  <!-- Full-bleed scrollytelling -->
  <div class="fullbleed">
    <section class="panel" data-reveal>
      <div class="container">
        <div>
          <div class="kicker">Présentation</div>
          <h2>Un site qui donne envie dès le premier regard.</h2>
          <p>Un thème épuré, des visuels larges, une mise en page fluide. Vous présentez l’essentiel, sans friction.</p>
        </div>
        <div><img class="mock-xl-img" src="assets/images/product-1.png" alt="Exemple de site vitrine 1">
</div>
      </div>
    </section>

    <section class="panel alt" data-reveal>
      <div class="container">
        <div><img class="mock-xl-img" src="assets/images/product-2.png" alt="Exemple de site vitrine 2">
</div>
        <div>
          <div class="kicker">Performance</div>
          <h2>Rapide. Vraiment rapide.</h2>
          <p>Chargements éclairs, images optimisées, code simple. Vos visiteurs restent, Google apprécie.</p>
        </div>
      </div>
    </section>

    <section class="panel" data-reveal>
      <div class="container">
        <div>
          <div class="kicker">Sécurité</div>
          <h2>Construite proprement, pensée pour durer.</h2>
          <p>Des formulaires sécurisés, une base solide. Et quand vous grandirez, on ajoute les briques.</p>
        </div>
        <div><img class="mock-xl-img" src="assets/images/product-3.png" alt="Exemple de site vitrine 3">
</div>
      </div>
    </section>
  </div>

<?php elseif ($page === 'portfolio'): ?>
  <h1>Nos réalisations</h1>
  <div class="grid">
    <div class="card" data-reveal>
      <h3>Refonte d’un site vitrine</h3>
      <img src="assets/images/portfolio-1.jpg" alt="Projet 1" class="service-thumb">
      <p>Avant / Après : un site modernisé, responsive et rapide.</p>
    </div>
    <div class="card" data-reveal>
      <h3>Boutique en ligne</h3>
      <img src="assets/images/portfolio-2.jpg" alt="Projet 2" class="service-thumb">
      <p>Une e-boutique simple et efficace pour une petite marque.</p>
    </div>
  </div>

<?php elseif ($page === 'faq'): ?>
  <h1>Foire aux questions</h1>
  <div class="card" data-reveal>
    <h3>Quels sont vos délais ?</h3>
    <p>Un site vitrine simple est livré en 2 à 3 semaines.</p>
  </div>
  <div class="card" data-reveal>
    <h3>Quels sont vos tarifs ?</h3>
    <p>Nos offres démarrent à 499€, adaptées selon vos besoins.</p>
  </div>
  <div class="card" data-reveal>
    <h3>Proposez-vous un suivi ?</h3>
    <p>Oui, nous proposons un accompagnement et une maintenance annuelle.</p>

    <h2 class="section">Poser une question</h2>
<form method="post" class="form" data-reveal>
  <label>Email
    <input type="email" name="email" required>
  </label>
  <label>Votre question
    <textarea name="question" rows="5" required></textarea>
  </label>
  <button class="btn">Envoyer</button>
</form>

  </div>

<?php elseif ($page === 'about'): ?>
  <h1>À propos</h1>
  <img src="assets/images/about.png" alt="Portrait" class="contact-illu">
  <p>Je suis passionné(e) par le web design et le développement.  
     Avec LEA Web Creation, ma mission est de créer des sites modernes, rapides et accessibles à toutes les entreprises.  
     Mon objectif : transformer vos idées en expériences numériques élégantes.</p>

<?php else: ?>
  <h1>Page non trouvée</h1>
<?php endif; ?>
</main>

<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-col">
      <h4>LEA Web Creation</h4>
      <a href="?page=home">Accueil</a>
      <a href="?page=services">Services</a>
      <a href="?page=product">Produit</a>
      <a href="?page=contact">Devis</a>
    </div>
    <div class="footer-col">
      <h4>Offres</h4>
      <a href="?page=services">Site vitrine</a>
      <a href="?page=services">Pack SEO</a>
      <a href="?page=services">Conseil</a>
    </div>
    <div class="footer-col">
      <h4>Ressources</h4>
      <a href="?page=reviews">Avis clients</a>
      <a href="?page=contact">Support</a>
    </div>
    <div class="footer-col">
      <h4>Légal</h4>
      <a href="#">Mentions légales</a>
      <a href="#">Politique de confidentialité</a>
    </div>
  </div>
  <div class="container small">© <?= date('Y') ?> LEA Web Creation — Tous droits réservés.</div>
</footer>
</body>
</html>
