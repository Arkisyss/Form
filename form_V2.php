<?php
// fonction de lettre nuiqueement
function validLetterOnly($input){
    if (preg_match("/^[A-Za-z ]+$/", $input)){
        return true;    // valide
    }else{
        return false;   // not valide
    }
}
// fonction numéro
function validNumberOnly($input){
    if (preg_match("/^[0-9]+$/", $input)){
        return true;
    }else{
        return false;
    }
}
// fonction email
function validEmailOnly($input) {
    if (preg_match("/^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z]+$/", $input)) {
        return true;
    } else {
        return false;
    }
}
// fonction adress
function validAdress($input) {
    if (preg_match("/^[A-Za-z0-9 .°,&'^¨ù`-]+$/", $input)) {
        return true;
    } else {
        return false;
    }
}
// sanétisation
function sanitizeInput($input){
    $inputSanitized = filter_var($input, FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS);

    return $inputSanitized;
}

// Tableau des erreurs
$errors = [];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Récupérer les données saisies
    $bdate = sanitizeInput($_POST["bdate"]);
    if (empty($bdate)){
        header("Location: fail.html");
        exit;
    }
// ---
    $time_event = sanitizeInput($_POST["event"]);
    $parsed_time = strtotime($time_event);
    if ($parsed_time === false || date("H:i", $parsed_time) !== $time_event){
       header("Location: fail.html");
        exit;
    }
// ---
    $artist = sanitizeInput($_POST["artist"]);
    if ($artist !== "1" && $artist !== "2" && $artist !== "3" && $artist !== "4"){
        header("Location: fail.html");
        exit;
    }
// ---
    $description = sanitizeInput($_POST["description"]);
    if (validAdress($description)){
        //2
    }else{
        $errors[] = "Description contien des caractères non valide";
    }
// ---
    $promo = sanitizeInput($_POST["promo"]);
    if (validLetterOnly($promo)){
        if (strlen($promo) > 10){
            $errors[] = "POMOTION contien trop de lettre";
        } 
    }else{
        $errors[] = "PROMOTION contien des caractères invalide";
    }
// ---
    $venue_name = sanitizeInput($_POST["venue_name"]);
    if (validLetterOnly($venue_name)){
        if (strlen($venue_name) > 20){
            $errors[] = "NAME est trop long";
        } 
    }else{
        $errors[] = "NAME contien des caractères invalide";
    }
// ---
    $address_1 = sanitizeInput($_POST["venue_address_1"]);
    if (validAdress($address_1)){
        if (strlen($address_1) > 20){
            $errors[] = "STREET ADRESS est trop long. 20 caractères maximum";
        }
    }else{
        $errors = "STREET ADRESS contient des caractères interdit";
    }
// ---
    $address_2 = sanitizeInput($_POST["venue_address_2"]);
    if (validAdress($address_2)){
        if (strlen($address_2) > 20){
            $errors[] = "STREET ADRESS line 2 est trop long. 20 caractères maximum";
        }
    }else{
        $errors[] = "STREET ADRESS line 2 contient des caractères interdit";
    }
// ---
    $city = sanitizeInput($_POST["city"]);
    if (validLetterOnly($city)){
        if (strlen($city) > 20){
            $errors[] = "CITY est trop long. 20 caractères maximum";
        } 
    }else{
        $errors[] = "CITY contient des caractères interdit";
    }
// ---
    $region = sanitizeInput($_POST["region"]);
    if (validLetterOnly($region)){
        if (strlen($region) > 20){
            $errors[] = "REGION est trop long. 20 caractères maximum";
        }
    }else{
        $errors[] = "REGION est trop long. 20 caractères maximum";
    }
// ---
    $postal = sanitizeInput($_POST["postal"]);
    if (empty($postal)){
        $errors[] = "Le champ postal est vide. Veuillez le remplir.";
    }

    if (validNumberOnly($postal)){
        if (strlen($postal) > 5){
            $errors[] = "POSTAL est trop long. 5 caractères maximum";
        }
    }else{
        $errors[] = "POSTAL contient des caractères interdit";
    }

// ---
    $country = sanitizeInput($_POST["country"]);
    if (empty($country)){
        $errors[] = "COUNTRY est vide";
    } elseif ($country !== "1" && $country !== "2" && $country !== "3" && $country !== "4" && $country !== "5"){
        header("Location: fail.html");
        exit;
    }
// ---
    $capacity = sanitizeInput($_POST["capacity"]);
    if (validNumberOnly($capacity)){
        if (strlen($capacity) > 10){
            $errors[] = "CAPACITY est trop long";
        }
    }else{
        $errors[] = "CAPACITY contien des caractères invalide";
    }
// ---
    $attendance = sanitizeInput($_POST["attendance"]);
    if (validNumberOnly($attendance)){
        if (strlen($attendance) > 10){
            $errors[] = "ATTENDANCE est trop long. 10 caractères maximum";
        }
    }else{
        $errors[] = "ATTENDANCE contient des caractères interdit";
    }
// ---
    $performance = sanitizeInput($_POST["performance"]);
    if ($performance !== "1" && $performance !== "2"){
        header("Location: fail.html");
        exit;
    }
// ---
    $time_set = sanitizeInput($_POST["time"]);
    if (validNumberOnly($time_set)){
        if (strlen($time_set) > 5){
            $errors[] = "SET_TIME est trop long. 5 caractères maximum";
        }
    }else{
        $errors[] = "SET_TIME contient des caractères interdit";
    }
// ---
    $firstname = sanitizeInput($_POST["contact_firstname"]);
    if (validLetterOnly($firstname)){
        if (strlen($firstname) > 15){
            $errors[] = "CONTACT PERSON > Firstname est trop long. 15 caractères maximum";
        }
    }else{
        $errors[] = "CONTACT PERSON > Firstname contient des caractères interdit";
    }
// ---
    $lastname = sanitizeInput($_POST["contact_lastname"]);
    if (validLetterOnly($lastname)){
        if (strlen($lastname) > 15){
            $errors[] = "CONTACT PERSON > Lastname est trop long. 15 caractères maximum";
        }
    }else{
        $errors[] = "CONTACT PERSON > Lastname contient des caractères interdit";
    }
// ---
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (validEmailOnly($email)){
        if (strlen($email) > 27){
            $errors[] = "CONTACT EMAIL est trop long. 27 caractères maximum";
        }
    }else{
        $errors[] = "CONTACT EMAIL est trop long. 27 caractères maximum";
    }
// ---
    $number_contact = sanitizeInput($_POST["number"]);
    if (validNumberOnly($number_contact)){
        if (strlen($number_contact) > 12){
            $errors[] = "CONTACT NUMBER est trop long. 12 caractères maximum";
        }
    }else{
        $errors[] = "CONTACT NUMBER contient des caractères interdit";
    }
// ---
    $recorded = sanitizeInput($_POST["recorded"]);
    if ($recorded !== "yes" && $recorded !== "no"){
        header("Location: fail.html");
        exit;
    }
// ---
    $file = $_FILES["fileToUpload"];
    
    if ($file["error"] !== 4){
    // verification si pdf
        if ($file["type"] !== "application/pdf"){
            $errors[] = "Le fichier doit être en format PDF";
        }
        // Vérification de l'extension du fichier
        $filename = $file["name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension !== "pdf") {
            $errors[] = "Le fichier doit être en format PDF";
        }
        // vérification si pas faux pdf
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $file["tmp_name"]);
        finfo_close($fileInfo);

        if ($mimeType !== "application/pdf") {
            $errors[] = header("Location: fail.html");
            exit;
        }
    }
}

// Affichage du récapitulatif des données si le tableau des erreurs est vide
if (empty($errors)) {
    ?>
    <!-- HTML de retour -->
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Récapitulatif de vos données</title>
        <style>
            body {
                min-height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
                font-family: Roboto, Arial, sans-serif;
                font-size: 17px;
                color: #666;
                line-height: 24px;
            }

            h1 {
                font-size: 32px;
                color: #666;
                margin-bottom: 20px;
                text-align: center;
            }

            .testbox {
                max-width: 500px;
                background-color: #fff;
                border-radius: 6px;
                box-shadow: 0 0 20px 0 #a82877;
                padding: 20px;
            }

            p {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="testbox">
            <h1>Récapitulatif de vos données</h1>
            <?php
            echo "<p>Date de l'événement : " . htmlspecialchars($bdate) . "</p>";
            echo "<p>Heure de l'événement : " . htmlspecialchars($time_event) . "</p>";
            echo "<p>Artiste sélectionné : " . htmlspecialchars($artist) . "</p>";
            echo "<p>Description de l'événement : " . htmlspecialchars($description) . "</p>";
            echo "<p>Nom du promoteur : " . htmlspecialchars($promo) . "</p>";
            echo "<p>Nom du lieu : " . htmlspecialchars($venue_name) . "</p>";
            echo "<p>Adresse du lieu : " . htmlspecialchars($address_1) . " " . htmlspecialchars($address_2) . "</p>";
            echo "<p>Ville : " . htmlspecialchars($city) . "</p>";
            echo "<p>Région : " . htmlspecialchars($region) . "</p>";
            echo "<p>Code postal : " . htmlspecialchars($postal) . "</p>";
            echo "<p>Pays : " . htmlspecialchars($country) . "</p>";
            echo "<p>Capacité du lieu : " . htmlspecialchars($capacity) . "</p>";
            echo "<p>Nombre attendu : " . htmlspecialchars($attendance) . "</p>";
            echo "<p>Type de performance : " . htmlspecialchars($performance) . "</p>";
            echo "<p>Durée du spectacle : " . htmlspecialchars($time_set) . " minutes</p>";
            echo "<p>Prénom du contact : " . htmlspecialchars($firstname) . "</p>";
            echo "<p>Nom du contact : " . htmlspecialchars($lastname) . "</p>";
            echo "<p>Email du contact : " . htmlspecialchars($email) . "</p>";
            echo "<p>Numéro de téléphone du contact : " . htmlspecialchars($number_contact) . "</p>";
            echo "<p>Enregistrement de l'événement : " . htmlspecialchars($recorded) . "</p>";
            echo "<p>Fichier envoyé : " . htmlspecialchars($file["name"]) . "</p>";
            ?>
        </div>
    </body>
    </html>
    <?php
} else {
    // Affichage des erreurs de validation
    foreach ($errors as $error) {
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">' . $error . '</div>';
    }
}
?>
