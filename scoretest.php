<?php
// database configuration
$host = 'localhost'; // your database host
$db = 'golf_scores'; // your database name
$user = 'username'; // your database username
$pass = 'password'; // your database password

// create connection
$conn = new mysqli($host, $user, $pass, $db);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieve form data
    $player_name = $_POST['player-name'];
    $course = $_POST['course'];
    $hole_scores = [];
    
    for ($i = 1; $i <= 18; $i++) {
        $hole_scores[$i] = $_POST["hole-$i"];
    }

    // prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO scores (player_name, course, hole_1, hole_2, hole_3, hole_4, hole_5, hole_6, hole_7, hole_8, hole_9, hole_10, hole_11, hole_12, hole_13, hole_14, hole_15, hole_16, hole_17, hole_18) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssiiiiiiiiiiiiiiiiii", $player_name, $course, 
        $hole_scores[1], $hole_scores[2], $hole_scores[3], 
        $hole_scores[4], $hole_scores[5], $hole_scores[6],
        $hole_scores[7], $hole_scores[8], $hole_scores[9],
        $hole_scores[10], $hole_scores[11], $hole_scores[12],
        $hole_scores[13], $hole_scores[14], $hole_scores[15],
        $hole_scores[16], $hole_scores[17], $hole_scores[18]);

    // execute SQL statement
    if ($stmt->execute()) {
        // redirect to success page
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <title>Scores - DJP Invitational</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            margin-bottom: 10px;
        }
        .form-group label {
            width: 20%;
            text-align: right;
            margin-right: 10px;
            margin-bottom: 5px;
        }
        .form-group .input-group {
            flex: 1;
            display: flex;
            align-items: center;
        }
        .form-group .input-group input,
        .form-group .input-group select {
            width: 45%;
            padding: 5px;
            margin-bottom: 5px;
        }
        .score-columns {
            display: flex;
            justify-content: space-between;
        }
        .score-column {
            width: 30%;
        }
        .score-column label {
            display: block;
            margin-bottom: 5px;
        }
        .score-column input {
            width: calc(100% - 30px);
            padding: 5px;
            margin-bottom: 5px;
        }
        header {
            height: 50vh;
        }
    </style>
    <script>
      function confirmSubmission() {
        return confirm("Are you sure you want to submit the scores?");
      }
    </script>
</head>
<body>
    <header>
        <div class="banner">
            <nav>
                <div class="menu-toggle" id="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <ul id="menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="schedule.html">Schedule</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="donations.html">Donations</a></li>
                    <li><a href="tournament.html">Tournament</a></li>
                    <li><a href="scores.php">Scores</a></li>
                    <li><a href="signin.html">Sign In</a></li>
                </ul>
            </nav>
            <div class="banner-content">
                <h1>Scores</h1>
            </div>
        </div>
    </header>

    <main>
        <section>
            <h2>Scorecards</h2>
            <p>Enter your scores for each hole below:</p>
            <form id="scorecard-form" method="POST" onsubmit="return confirmSubmission()">
                <div class="form-group">
                    <label for="player-name">Player Name:</label>
                    <select id="player-name" name="player-name" required>
                        <option value="">Select Player</option>
                        <option value="Aaron Dobbs">Aaron Dobbs</option>
                        <option value="Ben Kolar">Ben Kolar</option>
                        <option value="Bill Finn">Bill Finn</option>
                        <option value="Bill Long">Bill Long</option>
                        <option value="Brad Richter">Brad Richter</option>
                        <option value="Casey Masiak">Casey Masiak</option>
                        <option value="Chuck Schmeda">Chuck Schmeda</option>
                        <option value="Dano Hutchinson">Dano Hutchinson</option>
                        <option value="Dave Bickler">Dave Bickler</option>
                        <option value="Dean Nelson">Dean Nelson</option>
                        <option value="Dennis Poulakos">Dennis Poulakos</option>
                        <option value="DJ Richlen">DJ Richlen</option>
                        <option value="Dominic McCadney">Dominic McCadney</option>
                        <option value="Drew Baker">Drew Baker</option>
                        <option value="Geoff Grommik">Geoff Grommik</option>
                        <option value="George Rios">George Rios</option>
                        <option value="Jeff Filsinger">Jeff Filsinger</option>
                        <option value="Jeremiah Johnson">Jeremiah Johnson</option>
                        <option value="Jim Poulakos">Jim Poulakos</option>
                        <option value="John Poulakos">John Poulakos</option>
                        <option value="JT Schneider">JT Schneider</option>
                        <option value="Ken Dobbs">Ken Dobbs</option>
                        <option value="Kevin Diepholz">Kevin Diepholz</option>
                        <option value="Kevin Dougherty">Kevin Dougherty</option>
                        <option value="Kevin Walsh">Kevin Walsh</option>
                        <option value="Kyle Oakland">Kyle Oakland</option>
                        <option value="Kyle Spader">Kyle Spader</option>
                        <option value="Lindal Anderson">Lindal Anderson</option>
                        <option value="Logan Manchek">Logan Manchek</option>
                        <option value="Mike Ausprung">Mike Ausprung</option>
                        <option value="Mike Binder">Mike Binder</option>
                        <option value="Mike Greene">Mike Greene</option>
                        <option value="Mike Kocher">Mike Kocher</option>
                        <option value="Mike Richter">Mike Richter</option>
                        <option value="Mike Van Der Linden">Mike Van Der Linden</option>
                        <option value="Nick Hatch">Nick Hatch</option>
                        <option value="Nick Poulakos">Nick Poulakos</option>
                        <option value="Pete Markowski">Pete Markowski</option>
                        <option value="Randy Johnson">Randy Johnson</option>
                        <option value="Rhett Surman">Rhett Surman</option>
                        <option value="Rich Anderson">Rich Anderson</option>
                        <option value="Rick Hrica">Rick Hrica</option>
                        <option value="Rob Kuhnke">Rob Kuhnke</option>
                        <option value="Rob Nennig">Rob Nennig</option>
                        <option value="Roman Kelly">Roman Kelly</option>
                        <option value="Ryan Heeti">Ryan Heeti</option>
                        <option value="Sal Ismaili">Sal Ismaili</option>
                        <option value="Sean Coykendahl">Sean Coykendahl</option>
                        <option value="Steve Morzy">Steve Morzy</option>
                        <option value="Todd Kirchenberg">Todd Kirchenberg</option>
                        <option value="Tom Gorski">Tom Gorski</option>
                        <option value="Trevor Schwigel">Trevor Schwigel</option>
                        <option value="Wayne Kelly">Wayne Kelly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <select id="course" name="course" required>
                        <option value="">Select Course</option>
                        <option value="TimberStone">TimberStone</option>
                        <option value="Sage Run">Sage Run</option>
                        <option value="Sweetgrass">Sweetgrass</option>
                    </select>
                </div>
                <div class="score-columns">
                    <div class="score-column">
                        <label for="hole-1">Hole 1:</label>
                        <input type="number" id="hole-1" name="hole-1" min="1" required />
                        <label for="hole-4">Hole 4:</label>
                        <input type="number" id="hole-4" name="hole-4" min="1" required />
                        <label for="hole-7">Hole 7:</label>
                        <input type="number" id="hole-7" name="hole-7" min="1" required />
                        <label for="hole-10">Hole 10:</label>
                        <input type="number" id="hole-10" name="hole-10" min="1" required />
                        <label for="hole-13">Hole 13:</label>
                        <input type="number" id="hole-13" name="hole-13" min="1" required />
                        <label for="hole-16">Hole 16:</label>
                        <input type="number" id="hole-16" name="hole-16" min="1" required />
                    </div>
                    <div class="score-column">
                        <label for="hole-2">Hole 2:</label>
                        <input type="number" id="hole-2" name="hole-2" min="1" required />
                        <label for="hole-5">Hole 5:</label>
                        <input type="number" id="hole-5" name="hole-5" min="1" required />
                        <label for="hole-8">Hole 8:</label>
                        <input type="number" id="hole-8" name="hole-8" min="1" required />
                        <label for="hole-11">Hole 11:</label>
                        <input type="number" id="hole-11" name="hole-11" min="1" required />
                        <label for="hole-14">Hole 14:</label>
                        <input type="number" id="hole-14" name="hole-14" min="1" required />
                        <label for="hole-17">Hole 17:</label>
                        <input type="number" id="hole-17" name="hole-17" min="1" required />
                    </div>
                    <div class="score-column">
                        <label for="hole-3">Hole 3:</label>
                        <input type="number" id="hole-3" name="hole-3" min="1" required />
                        <label for="hole-6">Hole 6:</label>
                        <input type="number" id="hole-6" name="hole-6" min="1" required />
                        <label for="hole-9">Hole 9:</label>
                        <input type="number" id="hole-9" name="hole-9" min="1" required />
                        <label for="hole-12">Hole 12:</label>
                        <input type="number" id="hole-12" name="hole-12" min="1" required />
                        <label for="hole-15">Hole 15:</label>
                        <input type="number" id="hole-15" name="hole-15" min="1" required />
                        <label for="hole-18">Hole 18:</label>
                        <input type="number" id="hole-18" name="hole-18" min="1" required />
                    </div>
                </div>
                <button type="submit">Submit Scores</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 DJP Invitational Golf Tournament. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document
                .getElementById("menu-toggle")
                .addEventListener("click", function () {
                    document.getElementById("menu").classList.toggle("active");
                });
        });
    </script>
</body>
</html>
