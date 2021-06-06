<!DOCTYPE html>
<html lang="en"></html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Title</title>
    <style>
      .error {color: #FF0000;}
    </style>
  </head>
  <body>

  <?php
      $nameErr = $emailErr = "";
      $name = $email = $likesHipHop = $likesRock = $likesPop = $occupation = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<img src='kappa.jpg' alt='Girl in a jacket' width='500' height='600'>";
      
       
        if (empty($_POST["name"])) {
          $nameErr = "name is required";
        } else {
          $name = test_input($_POST["name"]);
         
        }
      
        if (empty($_POST["email"])) {
          $emailErr = "email is required";
        } else if(filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)){
          $email = test_input($_POST["email"]);
        } else {
          $email = test_input($_POST["email"]);
          $emailErr = "Invalid email format"; 
        }

        if (isset($_POST["likesHipHop"])) {
          $likesHipHop = test_input($_POST["likesHipHop"]);
        }

        if (isset($_POST["likesRock"])) {
          $likesRock = test_input($_POST["likesRock"]);
        }

        if (isset($_POST["likesPop"])) {
          $likesPop = test_input($_POST["likesPop"]);
        }

        $occupation = test_input($_POST["occupation"]);

        if ($nameErr === "" && $emailErr === "") {
          try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            
            $conn = new PDO("mysql:host=$servername", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->query("use myDB");

            $stmt = $conn->prepare("INSERT INTO Data (name, email, likesHipHop, likesRock, likesPop, occupation) 
            VALUES (:name, :email, :likesHipHop, :likesRock, :likesPop, :occupation)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':likesHipHop', $likesHipHop);
            $stmt->bindParam(':likesRock', $likesRock);
            $stmt->bindParam(':likesPop', $likesPop);
            $stmt->bindParam(':occupation', $occupation);

            $stmt->execute();
    
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
        }

      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>

    

     

      <h1>Συμπληρώστε παρακαλώ τα παρακάτω στοιχεία</h1>
    <br>
    
    <br>
    <hr>
    <br>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      name: <input type="text" name="name" value="<?php echo $name;?>"> <span class="error">* <?php echo $nameErr;?></span><br>
     
       
   
      <h2>Tι είδος/η μουσικής ακούτε?</h2>
      <input type="Checkbox" name="likesHipHop" value="yes" <?php echo isset($_POST['likesHipHop']) ? 'checked' : ''; ?>>hip hop
      <br>
      <input type="Checkbox" name="likesRock" value="yes" <?php echo isset($_POST['likesRock']) ? 'checked' : ''; ?>>rock
      <br>
      <input type="Checkbox" name="likesPop" value="yes" <?php echo isset($_POST['likesPop']) ? 'checked' : ''; ?>>pop
      <br>
      
      <br>
      <label for="category">Σε ποια από τις παρακάτω κατηγορίες ανήκετε?</label>
      <br>
      <select name="occupation" id="">
      <option value="μαθήτης" <?php echo (isset($_POST['occupation']) && $_POST['occupation'] === 'μαθήτης') ? 'selected' : ''; ?>>μαθήτης</option>
        <option value="φοιτητής" <?php echo (isset($_POST['occupation']) && $_POST['occupation'] === 'φοιτητής') ? 'selected' : ''; ?>>φοιτητής</option>
        <option value="εργαζόμενος" <?php echo (isset($_POST['occupation']) && $_POST['occupation'] === 'εργαζόμενος') ? 'selected' : ''; ?>>εργαζόμενος </option>
        <option value="άνεργος" <?php echo (isset($_POST['occupation']) && $_POST['occupation'] === 'άνεργος') ? 'selected' : ''; ?>>άνεργος</option>
      </select>
      <br>
      <br>
      <label for="fname">email επικοινωνίας:</label>
       <input type="text" name="email" value="<?php echo $email;?>"> <span class="error">* <?php echo $emailErr;?></span><br>
       <button>Submit</button>
        
        
    </form>  
    <form action="./createDB.php">
      <button>Create DB</button>
    </form>
    <form action="./showDB.php">
      <button>Show DB</button>
    </form>

  </body>
</html>