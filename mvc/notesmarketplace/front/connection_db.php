<?php
$servername = "localhost";
$username = "root";
$pass = "";
$db = "notesmarketplace";

// Create connection
$conn =mysqli_connect($servername, $username, $pass ,$db);

// Check connection
if($conn){
?>    
    <script>
        alert("Connection successful");
    </script>    
<?php
}
else{
    echo"connection failed";
}
?>