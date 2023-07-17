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
        //
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">DESCRIPTION contien des caractères invalide</div>';
        exit;
    }
// ---
    $promo = sanitizeInput($_POST["promo"]);
    if (validLetterOnly($promo)){
        if (strlen($promo) > 10){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">PROMOTION est trop long</div>';
            exit;
        } 
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">PROMOTION contien des caractères invalide</div>';
        exit;
    }
// ---
    $venue_name = sanitizeInput($_POST["venue_name"]);
    if (validLetterOnly($venue_name)){
        if (strlen($venue_name) > 20){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">NAME est trop long</div>';
            exit;
        } 
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">NAME contien des caractères invalide</div>';
        exit;
    }
// ---
    $address_1 = sanitizeInput($_POST["venue_address_1"]);
    if (validAdress($address_1)){
        if (strlen($address_1) > 20){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">STREET ADRESS est trop long. 20 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">STREET ADRESS contient des caractères interdit</div>';
        exit;
    }
// ---
    $address_2 = sanitizeInput($_POST["venue_address_2"]);
    if (validAdress($address_2)){
        if (strlen($address_2) > 20){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">STREET ADRESS line 2 est trop long. 20 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">STREET ADRESS line 2 contient des caractères interdit </div>';
        exit;
    }
// ---
    $city = sanitizeInput($_POST["city"]);
    if (validLetterOnly($city)){
        if (strlen($city) > 20){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">CITY est trop long. 20 caractères maximum</div>';
            exit;
        } 
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">CITY contient des caractères interdit </div>';
        exit;
    }
// ---
    $region = sanitizeInput($_POST["region"]);
    if (validLetterOnly($region)){
        if (strlen($region) > 20){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">REGION est trop long. 20 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">REGION contient des caractères interdit </div>';
        exit;
    }
// ---
    $postal = sanitizeInput($_POST["postal"]);
    if (empty($postal)){
        echo "Le champ postal est vide. Veuillez le remplir.";
        exit;
    }

    if (validNumberOnly($postal)){
        if (strlen($postal) > 5){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">POSTAL est trop long. 5 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">POSTAL contient des caractères interdit </div>';
        exit;
    }

// ---
    $country = sanitizeInput($_POST["country"]);
    if (empty($country)){
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">"COUNTRY est vide"</div>';
        exit;
    } elseif ($country !== "1" && $country !== "2" && $country !== "3" && $country !== "4" && $country !== "5"){
        header("Location: fail.html");
        exit;
    }
// ---
    $capacity = sanitizeInput($_POST["capacity"]);
    if (validNumberOnly($capacity)){
        if (strlen($capacity) > 10){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">CAPACITY est trop long</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">CAPACITY contien des caractères invalide</div>';
        exit;
    }
// ---
    $attendance = sanitizeInput($_POST["attendance"]);
    if (validNumberOnly($attendance)){
        if (strlen($attendance) > 10){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">ATTENDANCE est trop long. 10 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">ATTENDANCE contient des caractères interdit </div>';
        exit;
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
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">SET_TIME est trop long. 5 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">SET_TIME contient des caractères interdit </div>';
        exit;
    }
// ---
    $firstname = sanitizeInput($_POST["contact_firstname"]);
    if (validLetterOnly($firstname)){
        if (strlen($firstname) > 15){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT PERSON > Firstname est trop long. 15 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT PERSON > Firstname contient des caractères interdit </div>';
        exit;
    }
// ---
    $lastname = sanitizeInput($_POST["contact_lastname"]);
    if (validLetterOnly($lastname)){
        if (strlen($lastname) > 15){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT PERSON > Lastname est trop long. 15 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT PERSON > Lastname contient des caractères interdit </div>';
        exit;
    }
// ---
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (validEmailOnly($email)){
        if (strlen($email) > 27){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT EMAIL est trop long. 27 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT EMAIL contient des caractères interdit </div>';
        exit;
    }
// ---
    $number_contact = sanitizeInput($_POST["number"]);
    if (validNumberOnly($number_contact)){
        if (strlen($number_contact) > 12){
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT NUMBER est trop long. 12 caractères maximum</div>';
            exit;
        }
    }else{
        echo '<div style="background-color: #a82877; color: white; padding: 10px;">CONTACT NUMBER contient des caractères interdit </div>';
        exit;
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
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">Le fichier doit être en format PDF</div>';
            exit;
        }
        // Vérification de l'extension du fichier
        $filename = $file["name"];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension !== "pdf") {
            echo '<div style="background-color: #a82877; color: white; padding: 10px;">Le fichier doit être en format PDF</div>';
            exit;
        }
        // vérification si pas faux pdf
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo, $file["tmp_name"]);
        finfo_close($fileInfo);

        if ($mimeType !== "application/pdf") {
            header("Location: fail.html");
            exit;
        }
    }
}
?>

<!-- HTML return-->
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
        echo "<p>Fichier envoyé : " . htmlspecialchars($file) . "</p>";
        ?>
    </div>
</body>
</html>
