<?php
$imageDir = 'images';
$images = [];

if (!is_dir($imageDir)) {
    error_log("Image directory not found: $imageDir");
    die("We're experiencing technical difficulties. Please try again later.");
}

$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$files = scandir($imageDir);

foreach ($files as $file) {
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array(strtolower($extension), $allowedExtensions)) {
        $images[] = $imageDir . '/' . $file;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBA Arena</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            background-color: #000;
            background-size: contain; 
            background-position: center 60%; 
            background-repeat: no-repeat;
            transition: background-image 2s ease-in-out;
            overflow: hidden;
        }

        header, footer {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }

        header h1, footer p {
            margin: 0;
            color: #ffcc00;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 20px;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffcc00;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #fff;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: #ffcc00;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #444;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .hero {
            text-align: center;
            padding: 150px 20px;
            background: rgba(0, 0, 0, 0.6);
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero h1 {
            font-size: 64px;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 4px;
        }

        .hero p {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .btn {
            background-color: #ff5722;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #e64a19;
            transform: scale(1.1);
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 40px 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 80%;
            max-width: 600px;
            margin-bottom: 40px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            opacity: 1;
        }

        .card h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .card p {
            font-size: 18px;
            color: #666;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var images = <?php echo json_encode($images); ?>;
            var body = document.body;
            var currentImageIndex = 0;

            function changeBackground() {
                body.style.backgroundImage = "url('" + images[currentImageIndex] + "')";
                currentImageIndex = (currentImageIndex + 1) % images.length;
            }

            setInterval(changeBackground, 2000); 
            changeBackground(); 
        });
    </script>
</head>
<body>
    <header>
        <h1>NBA Arena</h1>
        <nav>
            <ul>
                <li><a href="nba.php">Home</a></li>
                <li class="dropdown">
                    <a href="about.php">About</a>
                    <div class="dropdown-content">
                        <a href="teams.php">Teams</a>
                        <a href="nextpage.php">Arenas</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="hero">
        <h1>Welcome to NBA Arena!</h1>
        <p>Explore the NBA arenas and find your favorite team's home court!</p>
        <p>Click on the arenas below to learn more about them.</p>
    </div>
</body>
</html>
