<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #003366, #66CCFF);
            color: #333;
        }
        header {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px 0;
            text-align: center;
            color: white;
        }
        header h1 {
            font-size: 2.5em;
            margin: 0;
            font-family: 'Courier New', monospace;
        }
        main {
            margin: 30px auto;
            padding: 20px;
            max-width: 800px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            font-size: 1.1em;
        }
        nav {
            text-align: center;
            margin-top: 20px;
        }
        nav a {
            text-decoration: none;
            color: white;
            background-color: #0066CC;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1em;
            box-shadow: 0 4px 8px rgba(0, 102, 204, 0.4);
            transition: all 0.3s ease;
        }
        nav a:hover {
            background-color: #004d99;
            box-shadow: 0 6px 12px rgba(0, 102, 204, 0.6);
            transform: translateY(-2px);
        }
        footer {
            text-align: center;
            padding: 15px 0;
            background-color: rgba(255, 255, 255, 0.9);
            color: #333;
            border-top: 1px solid #ddd;
            font-size: 0.9em;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>About This Website</h1>
    </header>
    <main>
        <p>This website is about the final assignment of 時空間データベース.</p>
        <p>It is a simple website that displays information about NBA teams and their arenas.</p>
        <p>It is built using PHP, HTML, and CSS.</p>
        <p>It uses a PostgreSQL database to store information about NBA teams and their arenas.</p>
        <p>It uses PDO to connect to the database and fetch the information.</p>
        <p>In the NBA Teams page, you can see a list of NBA teams and their arenas.</p>
        <p>Clicking on a team will take you to the NBA Arena page, where you can see more information about the team's arena.</p>
        <p>That's it! I hope you enjoy using this website!</p>
    </main>
    <nav>
        <a href="nba.php" class="home-button">Home</a>
    </nav>
    <footer>
        <p>&copy; 2024 NG JACK SEN</p>
    </footer>
</body>
</html>
;