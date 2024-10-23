<?php include "../inc/dbinfo.inc"; ?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的網站 - AWS Technical Essentials</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <header>
            <h1>你好，我叫林晏寬</h1>
            <section id="dynamic-data" class="jumbotron">
                <h2>EC2 動態數據</h2>
                <p>
                    <?php include('get-index-meta-data.php'); ?>
                    <hr />
                    <?php include('get-cpu-load.php'); ?>
                </p>
            </section>
        </header>

        <section id="about">
            <h2>自我介紹</h2>
            <p>我叫林晏寬，目前就讀資工三甲，MBTI:ENTJ，對程式設計和技術創新充滿熱情。我愛好打羽球、溜滑板和旅遊，並對區塊鏈和智能合約技術充滿興趣。</p>
        </section>

        <!-- 此處加入資料庫表單 -->
        <section id="employees">
            <h2>員工表單</h2>
            <?php
            /* Connect to MySQL and select the database. */
            $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

            if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

            $database = mysqli_select_db($connection, DB_DATABASE);

            /* Ensure that the EMPLOYEES table exists. */
            VerifyEmployeesTable($connection, DB_DATABASE);

            /* If input fields are populated, add a row to the EMPLOYEES table. */
            $employee_name = htmlentities($_POST['NAME']);
            $employee_address = htmlentities($_POST['ADDRESS']);

            if (strlen($employee_name) || strlen($employee_address)) {
                AddEmployee($connection, $employee_name, $employee_address);
            }
            ?>

            <!-- Input form -->
            <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
              <table border="0">
                <tr>
                  <td>NAME</td>
                  <td>ADDRESS</td>
                </tr>
                <tr>
                  <td>
                    <input type="text" name="NAME" maxlength="45" size="30" />
                  </td>
                  <td>
                    <input type="text" name="ADDRESS" maxlength="90" size="60" />
                  </td>
                  <td>
                    <input type="submit" value="Add Data" />
                  </td>
                </tr>
              </table>
            </form>

            <!-- Display table data. -->
            <table border="1" cellpadding="2" cellspacing="2">
              <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>ADDRESS</td>
              </tr>

            <?php
            $result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");

            while($query_data = mysqli_fetch_row($result)) {
              echo "<tr>";
              echo "<td>",$query_data[0], "</td>",
                   "<td>",$query_data[1], "</td>",
                   "<td>",$query_data[2], "</td>";
              echo "</tr>";
            }
            ?>

            </table>

            <!-- Clean up. -->
            <?php
              mysqli_free_result($result);
              mysqli_close($connection);
            ?>
        </section>

        <section id="projects">
            <h2>我的作品</h2>
            <div class="project">
                <h3>作品: 車牌辨識</h3>
                <img src="https://website-daniel.s3.amazonaws.com/%E8%9E%A2%E5%B9%95%E6%93%B7%E5%8F%96%E7%95%AB%E9%9D%A2+2024-09-25+213953.png" alt="車牌辨識系統">
            </div>
        </section>

        <section id="audio">
            <h2>我的音檔</h2>
            <audio controls>
                <source src="https://website-daniel.s3.amazonaws.com/%E6%96%B0%E9%8C%84%E9%9F%B3+14.m4a" type="audio/mp3">
                您的瀏覽器不支援音訊播放。
            </audio>
        </section>

        <section id="video">
            <h2>我的影片</h2>
            <video controls height="400" width="600">
                <source src="https://website-daniel.s3.amazonaws.com/748965626.641854.mp4" type="video/mp4">
                您的瀏覽器不支援影片播放。
            </video>
        </section>

        <section id="contact">
            <h2>聯絡方式</h2>
            <p>以下是我的聯絡方式:<br>Email: daniel40906@gmail.com<br>Phone: 0909771479<br>GitHub: <a href="https://github.com/daniel921213">https://github.com/daniel921213</a></p>
        </section>

        <footer>
            <p>&copy; 2024 林晏寬</p>
        </footer>

    </div>

    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>

<?php
/* Add an employee to the table. */
function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyEmployeesTable($connection, $dbName) {
  if(!TableExists("EMPLOYEES", $connection, $dbName))
  {
     $query = "CREATE TABLE EMPLOYEES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ADDRESS VARCHAR(90)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>
