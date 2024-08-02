<?php
$dbname = "s2322011";
$host = "localhost";
$username = "s2322011";
$password = ""; // Secure method to store and retrieve passwords

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

try {
    $sql = "SELECT team, arena, city, established FROM teams";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Query failed: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

$imageDir = 'images';

if (!is_dir($imageDir)) {
    error_log("Image directory not found: $imageDir");
    die("We're experiencing technical difficulties. Please try again later.");
}

$images = array_diff(scandir($imageDir), array('.', '..'));

$manualMapping = [
    'atlanta_hawks' => 'Atlanta_Hawks_logo.svg.png',
    'sacramento_kings' => 'SacramentoKings.svg.png'
];

$teamsWithImages = [];
foreach ($teams as $team) {
    $teamName = strtolower(str_replace(' ', '_', $team['team']));
    $foundImage = $manualMapping[$teamName] ?? null;

    if (!$foundImage) {
        foreach ($images as $image) {
            if (stripos($image, $teamName) !== false) {
                $foundImage = $image;
                break;
            }
        }
    }

    $teamsWithImages[] = [
        'image' => $foundImage,
        'team' => $team['team'],
        'city' => $team['city'],
        'arena' => $team['arena'],
        'established' => $team['established']
    ];
}

try {
    $sql = "SELECT team, url FROM nba_arena";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $urls = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Query failed: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}

$urlsMap = [];
foreach ($urls as $url) {
    $urlsMap[$url['team']] = $url['url'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Teams</title>
</head>
<body>
    <h1>NBA Teams</h1>
    <nav>
        <a href="nba.php" class="home-button">Home</a>
    </nav>
    <ul class="team-list">
        <?php foreach ($teamsWithImages as $item): ?>
            <li class="team-item" data-url="<?= htmlspecialchars($urlsMap[$item['team']] ?? '#') ?>">
                <?php if ($item['image']): ?>
                    <img src="<?= htmlspecialchars("{$imageDir}/{$item['image']}") ?>" 
                        alt="<?= htmlspecialchars("{$item['team']} logo") ?>" 
                        width="100" height="100">
                <?php else: ?>
                    <div style="width: 100px; height: 100px; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center;">
                        No Image
                    </div>
                <?php endif; ?>
                <div class="team-info">
                    <h2><?= htmlspecialchars($item['team']) ?></h2>
                    <p><?= htmlspecialchars($item['city']) ?></p>
                    <p>Arena: <?= htmlspecialchars($item['arena']) ?></p>
                    <p>Established: <?= htmlspecialchars($item['established']) ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <script>
        document.querySelectorAll('.team-item').forEach(item => {
            item.addEventListener('click', () => {
                const url = item.getAttribute('data-url');
                if (url && url !== '#') {
                    window.open(url, '_blank');
                }
            });
        });
    </script>
</body>
</html>
