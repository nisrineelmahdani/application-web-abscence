<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "projectweb";

// Connection
$connexion = new mysqli($servername, $username, $password, $database);

if ($connexion->connect_error) {
    die("Échec de la connexion : " . $connexion->connect_error);
}

// Check if professor's credentials are provided
if (isset($_POST['firstnameprof']) && isset($_POST['lastnameprof']) && isset($_POST['ID'])) {
    $np = $_POST["firstnameprof"];
    $lp = $_POST["lastnameprof"];
    $id = $_POST["ID"];
    
    // Check professor's credentials
    if ($np == "mehdi" && $lp == "erraji" && $id == 111) {
        $ab = "SELECT firstname, lastname, stts FROM student";
        $resultat_absences = $connexion->query($ab);
        
        if ($resultat_absences && $resultat_absences->num_rows > 0) {
            // Begin HTML output
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Absences des Étudiants</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        color: #333;
                    }
                    h1 {
                        text-align: center;
                        color: #444;
                    }
                    table {
                        border-collapse: collapse;
                        width: 80%;
                        margin: 20px auto;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 12px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                        color: #444;
                    }
                    tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
                    tr:hover {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>
            <body>
                <h1>Absences des Étudiants</h1>
                <table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Statut</th>
                    </tr>
                    <?php
                    // Fetch and display absences
                    while ($row = $resultat_absences->fetch_assoc()) {
                        echo "<tr><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td><td>" . $row['stts'] . "</td></tr>";
                    }
                    ?>
                </table>
            </body>
            </html>
            <?php
        } else {
            // Aucune absence trouvée
            echo "Aucune absence trouvée.";
        }
    } else {
        // Identifiant incorrect
        echo "Identifiant incorrect";
    }
} else {
    // Handle case where not all required fields are provided
    echo "Tous les champs requis ne sont pas fournis.";
}

$connexion->close();
?>


