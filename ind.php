
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body, html {
        margin: 0;
    padding: 0;
    height: 100%;
    background: linear-gradient( rgb(9, 43, 103), rgb(192, 225, 249));
}
    #studentform{
    position: absolute;
    top: 53%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgb(9, 43, 103);
    color: rgb(255, 255, 255);
    width:400px;
    height: 370px;
    text-align: center;
    margin-left: 20%;
    border-radius: 15%;
    padding: 1.0rem;
    display: block;
    text-align: justify;
    font-size: 17px;
    box-shadow: 10px 10px;
}
    
#top{
    position: sticky;
    background-color: rgb(255, 255, 255);
    height: 17%;

}
#image{
   
    padding: 0%;
    height: 110%;
    width: 30%;
}
.im{
    height: 40%;
    width: 10%;
    display:inline-block;
}
#imgs{
position: absolute;
left:75%;
top: 0%;
margin-top: 3%;

}
#imgs a{
    text-decoration: none;
    color: black;
}
 #imgs a:hover{
 letter-spacing: 0.1rem;
 color: rgb(0, 0, 164);
}

 /* #formsContainer {
    display: flex; 
} */
#profFormDiv{
    background-color: rgb(9, 43, 103);
    color: rgb(255, 255, 255);
    margin-top: 4%;
    margin-left: 20%;
    width:400px;
    height: 370px;
   text-align: justify;
   padding: 1rem;
   border-radius: 15%;
   font-size:17px;
    padding: 1.5rem;
    box-shadow: 10px 10px;
}
#studentform, #profFormDiv {
    flex: 1;
    margin-right: px; /* Add space between the two forms */
}
h1{ font-style: inherit;
    text-align: center;
    text-decoration:underline;
}

#formsContainer{
text-align: center;width:auto;margin:0 auto
}
#profSubmitBtn{
    text-align: center;
    border-radius: 10%, solid;
    font-size: large;
    background-color: rgb(9, 43, 103);
    color: white;
    cursor: pointer;
}
#submitbtn{
    text-align: center;
    border-radius: 10%, solid;
    font-size: large;
    background-color: rgb(9, 43, 103);
    color: white;
    cursor: pointer;
}
#submitbtn:hover{
    color: rgb(201, 219, 234);
}
#profSubmitBtn:hover{
    color: rgb(201, 219, 234);
}
input[type="text"] {
    background: linear-gradient(rgb(234, 242, 254), rgb(192, 225, 249));
    border-radius: 5px;
    color: #979797;
    height: 20px;
    padding-left: 10px;
}
input[type="password"] {
    background: linear-gradient(rgb(234, 242, 254), rgb(192, 225, 249));
    border-radius: 5px;
    color: #979797;
    height: 20px;
    padding-left: 10px;
}
input[type="button"], input[type="submit"], input[type=reset] {
  
 border: none;
 
  
 
text-decoration: underline;
  cursor: pointer;
}


</style>
</head>
<html>
<body>
  




<div id="top">
    <img id="image" src="estessaouira.couleur-1200x900-cropped.png" alt=" ecole superieure de technologie">
    <div id="imgs">
      <img class="im" src="email.png" alt="our email"> <a href="mailto:este@uca.ac.ma">Contact us</a>
      <img  class="im" src="call.png" alt="our phone "> <a href=" tel:(+212) 5 24 79 20 64,">Call us</a>
      <img   class="im" src="social-media.png" alt="Fb page"> <a href="https://www.facebook.com/ESTEssaouira05">Facebook</a>
    </div>
   </div>
   <div id="formsContainer">
    <div id="studentform">
        <h1>Student</h1>
        <form id="studentForm" action="" method="post">
           <br> <label for="">First name :</label>
            <input type="text"   name="firstname" id="name" autofocus="on"><br> <br> 
            <label for=""> Last name:</label>
            <input type="text"  name="lastname" id="lastname"><br> <br> 
            <label for="">log in password:</label>
            <input type="password" id="password" name="password" ><br> <br> 
            <label for="" id="status" style="font-size: large;">Status :</label>
            
             <input type="radio" value="Absent" name="status">
             <label for="" style="font-size: large;"> Absent</label>
             
             <input type="radio" value="present" name="status">
             <label for="" style="font-size: large;">Present</label>

             </select>
             <br>
             <br>
            <input type="submit" style="text-align: center;" value="Send" id="submitbtn"> 
           
           
        </form>
        <?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "projectweb";

// Connection
$connexion = new mysqli($servername, $username, $password, $database);

if ($connexion->connect_error) {
    die(": " . $connexion->connect_error);
} else {
    echo " "; // This message confirms successful connection
}

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password']) && isset($_POST['status'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $passwd = $_POST['password'];
    $abs = $_POST['status'];

    // Requête pour récupérer le mot de passe de l'étudiant
    $requete_passwd = "SELECT passwd FROM liste WHERE firstname='$firstname' and lastname ='$lastname'";
    $resultat_passwd = $connexion->query($requete_passwd);

    if ($resultat_passwd === false) {
        // Handle query execution error
        echo "" ;
    } else {
        if ($resultat_passwd->num_rows > 0) {
            $row = $resultat_passwd->fetch_assoc();
            $db_password = $row['passwd'];

            // Comparer le mot de passe récupéré avec celui soumis dans le formulaire
            if ($passwd === $db_password) {
                // Mot de passe correct, vous pouvez insérer l'absence dans la table des absences
                $requete = "INSERT INTO student (firstname, lastname, stts) VALUES ('$firstname', '$lastname', '$abs')";
                if ($connexion->query($requete) === TRUE) {
                    echo "";
                } else {
                    echo "Erreur lors de l'insertion de l'absence : " . $connexion->error;
                }
            } else {
                
                // Mot de passe incorrect
                echo "<p style='color:red' >Mot de passe incorrect</p>";
            }
        } else {
            // Aucun enregistrement trouvé pour le nom fourni
            echo "Aucun enregistrement trouvé pour le nom fourni";
        }
    }
    $connexion->close();
}

?>
    </div>

    <div id="profFormDiv">
        <h1>Professor</h1>
        <br>
        <form id="profForm" action="pr.php" method="post">
            <label for=""> First name :</label>
            <input type="text" name="firstnameprof" id="firstnameprof"> <br> <br> 
            <label for=""> Last name :</label>
            <input type="text" name="lastnameprof" id="lastnameprof"> <br> <br> 
            <label for="idprof"> ID :</label>
            <input type="password" name="ID" id="profId"><br> <br> 
            <input type="submit" value="Submit" id="profSubmitBtn">
            
        </form>
    </div>
    </div>
    



    </body>
    </html>