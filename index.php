<?php
$con = new mysqli("localhost", "root", "", "dinodata");
if ($con->connect_error) {
  die("connection failed :" . $con->connect_error);
} else {
  $get = $con->prepare("SELECT * FROM jumpgame ORDER BY highscore DESC LIMIT 5");

  $get->execute();
  $result = $get->get_result();

  $ranking = 0;


  if ($result->num_rows > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);

  }
}

$con->close();
$get->close();


?>








<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
  <title>SPACE JAM</title>
</head>

<body>
  <div class="game">
    <div class="login-form" id="login-form" >
      <input type="checkbox" id="show">
      <label for="show" class="show-btn">START</label>
      <div class="container">
        <label for="show" class="close-btn fas fa-times" title="close"></label>
        <div class="text">
          SPACE JAM
        </div>
        <section id="section">
          <div class="data">
            <label>Enter Your Name</label>
            
            <input type="text" id="userName" name="userName" required>
            <label id ="check"></label>

          </div>
          <div class="btn">
            <div class="inner"></div>
            <button onclick="hideLogin()" type="submit" name="submit">Start</button>
          </div>
          <div class="leaderboard">
            <table>
              <tr>
                <th>Ranking</th>
                <th>Name</th>
                <th>Score</th>
              </tr>
              <?php
              foreach ($rows as $row) {
                $ranking++;

                echo "<tr>
            <td>{$ranking}</td>
            <td>{$row['username']}</td>
            <td>{$row['highscore']}</td>                
            </tr>";

              }
              $ranking = 0;
              ?>
            </table>
          </div>
        </section>
      </div>
    </div>
    <div class="game-info" id="game-info">
      <div id="username"></div>
      <div id="h_score"></div>


      <div id="score">0</div>

    </div>
    <div id="objects">
      <div id="obj"></div>
      <div id="obs"></div>
      <!-- <div id="ground"></div> -->
    </div>
    <div class="game-over" id="game-over">
      <div class="text-over">
        <h1>Game Over</h1>
        
        <p id="finalscore">Oh no, you lost the game! Better luck next time.</p>
        <button onclick="hideGame()" type="submit">Play Again</button>
        <div class="leaderboard">
          <table>
            <tr>
              <th>Ranking</th>
              <th>Name</th>
              <th>Score</th>
            </tr>
            <?php
            foreach ($rows as $row) {
              $ranking++;

              echo "<tr>
            <td>{$ranking}</td>
            <td>{$row['username']}</td>
            <td>{$row['highscore']}</td>                
            </tr>";

            }
            $ranking = 0;
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>


  <script src="scripts.js"></script>
</body>

</html>