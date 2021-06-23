<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Conversion Site - Home</title>
  </head>
  <body>

    <?php
      require 'function.php';

      $input = "";
      $result = "";
      $converted = "";

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $selection = $_POST['selection'];
        $input = $_POST['value'];

        $readData = read();
        $arr1 = json_decode($readData);

        for($i = 0; $i < count($arr1); $i++) {
          $decode = $arr1[$i];
          if ($decode->from === $selection) {
            $result = $input*$decode->value;
            $converted = $decode->to;
            break;
          }
          if ($decode->to === $selection) {
            $result = $input/$decode->value;
            $converted = $decode->from;
            break;
          }
        }

        session_start();
        $_SESSION['selection'] = $selection;
        if(!isset($_SESSION['history'])) {
          $_SESSION["history"] = "from " . $selection . " to " . $converted . "," . $input . "," . $result;
        }
        else {
          $_SESSION["history"] = $_SESSION["history"] . "," . "from " . $selection . " to " . $converted . "," . $input .  "," . $result;
        }
      }
    ?>

    <h3 style="color: red;">Page 1 [Home]</h3>
    <?php require 'main.html'; ?>
    <h4 style="color: red;">Converter: </h4>
    <br>

<p>Distance Converter</p>
      <form class="" action="distance converter.php" method="post">
        <label for="">Select a Conversion Option</label><br>
        <select class="" name="Distance" required>
          <option option selected hidden>Choose an Option</option>
          <option value="Meter to Centimeter">Meter to Centimeter</option>
          <option value="Centimeter to Meter">Centimeter to Meter</option>
          <option value="Kilometre to Meter">Kilometre to Meter</option>
          <option value="Meter to Kilometre">Meter to Kilometre</option>
          <option value="Mile to Kilometre">Mile to Kilometre</option>
          <option value="Kilometre to Mile">Kilometre to Mile</option>
          <option value="Foot to Inch">Foot to Inch</option>
          <option value="Inch to Foot">Inch to Foot</option>
          <option value="Inch to Centimeter">Inch to Centimeter</option>
          <option value="Centimeter to Inch">Centimeter to Inch</option>
          

        </select>
        <input id="amount" type="text" name="amount" value="" placeholder="Enter a Value" required><br>
        <h3>
          <?php

            if (isset($_POST['convert'])) {
              $amount=$_POST['amount'];
              $option=$_POST['Distance'];

              if ($option=='Meter to Centimeter') {
                  $result=$amount*100;
                  echo $amount." Meter = ".$result." Centimeter";
              }
              if ($option=='Centimeter to Meter') {
                $result=$amount/100;
                echo $amount." Centimeter = ".$result." Meter";
              }
              if ($option=='Kilometre to Meter') {
                $result=$amount*1000;
                echo $amount." Kilometre = ".$result." Meter";
              }
              if ($option=='Meter to Kilometre') {
                $result=$amount/1000;
                echo $amount." Meter = ".$result." Kilometre";
              }
              if ($option=='Mile to Kilometre') {
                $result=$amount*1.60934;
                echo $amount." Mile = ".$result." Kilometre";
              }
              if ($option=='Kilometre to Mile') {
                $result=$amount/1.60934;
                echo $amount." Kilometre = ".$result." Mile";
              }
              
              if ($option=='Foot to Inch') {
                $result=$amount*12;
                echo $amount." Foot = ".$result." Inch";
              }
              if ($option=='Inch to Foot') {
                $result=$amount/12;
                echo $amount." Inch = ".$result." Foot";
              }
              if ($option=='Inch to Centimeter') {
                $result=$amount*2.54;
                echo $amount." Inch = ".$result." Centimeter";
              }
              if ($option=='Centimeter to Inch') {
                $result=$amount/2.54;
                echo $amount." Centimeter = ".$result." Inch";
              }
              

            }else {
              echo "Choose a Conversion Option";
            }


           ?>
        </h3>

        <input id="convert" type="submit" name="convert" value="Convert">

      </form>

    </div>


    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" autocomplete="off" method="POST">

      <select name="selection">

      <?php
        $readData = read();
        $arr1 = json_decode($readData);
        session_start();

        for($i = 0; $i < count($arr1); $i++) {
          $decode = $arr1[$i];
          $str1 = $str2 = "";

          if(isset($_SESSION["selection"])) {
            if($decode->from === $_SESSION['selection']) {
              $str1 = "selected";
            }
            if($decode->to === $_SESSION['selection']) {
              $str2 = "selected";
            }
          }
          else {
            $str1 = $decode->from;
          }

          echo "<option value=" . $decode->from . " " . $str1 . ">" . $decode->from . " to " . $decode->to . "</option>";
          echo "<option value=" . $decode->to . " " . $str2 . ">" . $decode->to . " to " . $decode->from . "</option>";
        }
      ?>



      </select>
      <br><br>
      <label for="value">Value: </label>
      <input type="number" name="value" value="<?php echo $input; ?>">
      <br><br>
      <button type="submit">Convert</button>
    </form>
    <br>
    <label for="result">Result: </label>
    <input type="number" name="result" value="<?php echo $result; ?>" disabled>

<input type="submit" name="submit"> &nbsp;&nbsp;

  </body>
</html>