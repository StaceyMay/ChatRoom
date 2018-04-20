<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="ChatRoom.css">
  <title>ChatRoom</title>
  <script src="jquery-3.3.1.js"></script>
  <script src="ChatBox.js"></script>
</head>

<body>
  <?php
  $cookie_name = "user";
  if(!isset($_COOKIE[$cookie_name])) {
    $url = "https://uinames.com/api/"
    $obj = json_decode(file_get_contents($url), true);
    $cookie_value = $obj['name'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
  }
  ?>
  <?php
  $handle = fopen("/tmp/userLog.txt", 'a+');
  fwrite($handle, "User:". $cookie_value. $_POST[posting]. "\n");
  fclose($handle);
  ?>
  <div class="chatBox">
    <div class="textBox">
    <?php
    $handle = fopen("/tmp/userLog.txt", 'r');
    while(($line = fgets($handle)) !== false){
    echo $line. "<br/>";
    }
    fclose($handle);
    ?>
    </div>
  </div>
  <div action="/ChatRoom.php" class="userBox">
    <form method="post">
    <textarea name="posting"></textarea>
    <input type="submit" value="Submit"/>
  </form>
  </div>

</body>

</html>

