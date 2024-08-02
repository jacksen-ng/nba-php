<?php
$dbname = "s2322011";
$host = "localhost";
$username = "s2322011";
$password = "";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Fetch all rows from nba_arena table
$sql = "SELECT * FROM nba_arena";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$arenas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arena</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            background: linear-gradient(135deg, #1d2b64, #f8cdda);
            overflow: hidden;
        }

        h1 {
            text-align: center;
            font-size: 48px;
            margin-top: 20px;
            color: #ffcc00;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        #map {
            height: 600px;
            width: 90%;
            margin: 40px auto;
            border: 2px solid #ffcc00;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 15px;
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #e64a19;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <h1>Welcome to NBA Arena!</h1>
    <div id="map"></div>
    <button onclick="location.href='nba.php'">Back to Home</button>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([37.0902, -95.7129], 4);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var arenas = <?php echo json_encode($arenas); ?>;

        arenas.forEach(function(arena) {
            var marker = L.marker([arena.lat, arena.lon]).addTo(map);
            marker.bindPopup("<b>" + arena.arena + "</b><br>" + arena.team);
            
            marker.on('click', function() {
                window.open(arena.url, '_blank');
            });
        });
</script>

</body>
</html>

