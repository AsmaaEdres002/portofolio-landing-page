<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch projects from the database
$sql = "SELECT projname, projdetails, imageurl FROM projectdata";
$result = $conn->query($sql);

if ($result === false) {
    // Handle query error
    die("Query failed: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Portfolio</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 0;
      }
      #projects {
      display: grid;
      grid-template-columns: 1fr;
      grid-gap: 20px;
   }

      a {
         color: white;
         margin: 20px;
      }

      .topdiv {
         background-color: #333;
         color: #fff;
         text-align: center;
         width:100%
      }

      .maindiv {
         margin: 50px;
         background-color: #fff;
         padding: 20px;
         border-radius: 8px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         opacity: 0;
         transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
         cursor: pointer;
      }
      
      h1 {
         color: white;
      }

      p {
         color: #666;
      }

      nav {
         background: black;
         text-align: left;
         padding: 10px;
         width: 100%;
      }

      .profile {
         width: 90%;
         max-height: 300px;
         max-width: 150px;
         border: solid;
         border-width: 2px;
         border-color: white;
         border-radius: 5px;
      }
      .projdiv{
         margin:50px;
         width: 700px;
         height: 500px;
      }
      img{
         width: 100%
      }
   </style>
</head>
<body>

   <div class="topdiv">
      <img class="profile" src="myimage.png">
      <h1>Asmaa Edres</h1>
      <p>Web Developer</p>
      <nav>
         <a href="#about">About</a>
         <a href="#projects">Projects</a>
         <a href="#contacts">Contact</a>
      </nav>
   </div>

   <div class="maindiv" id="about">
      <h2>About Me</h2>
      <p>
         Welcome to my portfolio! I'm a passionate web developer with a focus on creating engaging and user-friendly websites.
      </p>
   </div>

   <div class="maindiv" id="projects">
      <h2>Projects</h2>
      <?php
      if ($result->num_rows > 0) {
         // Output project data
         while ($row = $result->fetch_assoc()) {
            echo "<div> ";
            echo "<h2>{$row['projname']}</h2>";
            echo "<section><img src='{$row['imageurl']}' alt='Project Image'></section>";
            echo "<p>{$row['projdetails']}</p>";
            echo"</div>";
         }
      } else {
         echo "No projects found.";
      }

      // Close connection
      $conn->close();
      ?>
   </div>

   <div class="maindiv" id="contacts">
      <h2>Contact</h2>
      <p>
         Interested in working together? Feel free to contact me!
      </p>
   </div>

   <script>
   // Function to handle fading in elements
   function fadeInElements() {
      var elements = document.querySelectorAll('.maindiv');
      elements.forEach(function (element) {
         if (element.style.opacity !== '1') {
            element.style.opacity = '1';
         }
      });
   }

   // Delay the appearance of the projects section after 2 seconds
   setTimeout(function () {
      var projects = document.querySelectorAll('.maindiv');

      projects.forEach(function (project) {
         project.classList.add('visible');
      });

      // Trigger the fade-in effect after the delay
      fadeInElements();
   }, 500); // 2000 milliseconds = 2 seconds

</script>

</body>
</html>
