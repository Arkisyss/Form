<?php
// fonction de lettre nuiqueement
function validLetterOnly($input){
    if(preg_match("/^[A-Za-z]+$/", $input)){
        return true;    // valide
    }else{
        return false;   // not valide
    }
}
// fonction numéro
function validNumberOnly($input){
    if(preg_match("/^[0-9]+$/", $input)){
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
function sanitizeIpunt($input){
    $inputSanitized = filter_var($input, FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS);

    return $inputSanitized;
}
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Récupérer les données saisies
    $bdate = sanitizeIpunt($_POST["bdate"]);
    if (empty($bdate)){
        header("Location: fail.html");
        exit;
    }
// ---
    $time_event = sanitizeIpunt($_POST["event"]);
    $parsed_time = strtotime($time_event);
    if ($parsed_time === false || date("H:i", $parsed_time) !== $time_event){
       header("Location: fail.html");
        exit;
    }
// ---
    $artist = sanitizeIpunt($_POST["artist"]);
    if ($artist !== "1" && $artist !== "2" && $artist !== "3" && $artist !== "4"){
        header("Location: fail.html");
        exit;
    }
// ---
    $description = sanitizeIpunt($_POST["description"]);
    if (validAdress($description)){
        //
    }else{
        echo "Le champ description contien des caractères invalide";
        exit;
    }
// ---
    $promo = sanitizeIpunt($_POST["promo"]);
    if (validLetterOnly($promo)){
        if (strlen($promo) > 10){
            echo "Le champ promotion name est trop long";
            exit;
        }
    }else{
        echo "Le champ promoter's name contien des caractères invalide";
        exit;
    }
// ---
    $venue_name = sanitizeIpunt($_POST["venue_name"]);
    if (validLetterOnly($venue_name)){
        if (strlen($venue_name) > 20){
            echo "Le champ name est trop long";
            exit;
        }
    }else{
        echo "Le champ venue name contien des caractères invalide";
        exit;
    }
// ---
    $address_1 = sanitizeIpunt($_POST["venue_address_1"]);
    if (validAdress($address_1)){
        if (strlen($address_1) > 20){
            echo "Le champ adress1 est trop long";
            exit;
        }
    }else{
        echo "Adresse invalide";
        exit;
    }
// ---
    $address_2 = sanitizeIpunt($_POST["venue_address_2"]);
    if (validAdress($address_2)){
        if (strlen($address_2) > 20){
            echo "Le champ adress2 est trop long";
            exit;
        }
    }else{
        echo "Adresse invalide";
        exit;
    }
// ---
    $city = sanitizeIpunt($_POST["city"]);
    if (validLetterOnly($city)){
        if (strlen($city) > 21){
            echo "Le champ city est trop long";
            exit;
        } 
    }else{
        echo "Le champ city contien des caractères invalide";
        exit;
    }
// ---
    $region = sanitizeIpunt($_POST["region"]);
    if (validLetterOnly($region)){
        if (strlen($region) > 21){
            echo "Le champ region est trop long";
            exit;
        }
    }else{
        echo "Le champ region contien des caractères invalide";
        exit;
    }
// ---
    $postal = sanitizeIpunt($_POST["postal"]);
    if (validNumberOnly($postal)){
        if (strlen($postal) > 5){
            echo "Le champ postal est trop long";
            exit;
        }
    }else{
        echo "Le champ Postal contien des caractères invalide";
        exit;
    }

// ---
    $country = sanitizeIpunt($_POST["country"]);
    if ($country !== "1" && $country !== "2" && $country !== "3" && $country !== "4" && $country !== "5"){
        header("Location: fail.html");
        exit;
    }
// ---
    $capacity = sanitizeIpunt($_POST["capacity"]);
    if (validNumberOnly($capacity)){
        if (strlen($capacity) > 10){
            echo "Le champ capacity est trop long";
            exit;
        }
    }else{
        echo "Le champ Postal contien des caractères invalide";
        exit;
    }
// ---
    $attendance = sanitizeIpunt($_POST["attendance"]);
    if (validNumberOnly($attendance)){
        if (strlen($attendance) > 10){
            echo "Le champ attendance est trop long";
            exit;
        }
    }else{
        echo "Le champ Expected Attendance contien des caractères invalide";
        exit;
    }
// ---
    $performance = sanitizeIpunt($_POST["performance"]);
    if ($performance !== "1" && $performance !== "2"){
        header("Location: fail.html");
        exit;
    }
// ---
    $time_set = sanitizeIpunt($_POST["time"]);
    if (validNumberOnly($time_set)){
        if (strlen($time_set) > 5){
            echo "Le champ time set est trop long";
            exit;
        }
    }else{
        echo "Le champ Set time contien des caractères invalide";
        exit;
    }
// ---
    $firstname = sanitizeIpunt($_POST["contact_firstname"]);
    if (validLetterOnly($firstname)){
        if (strlen($firstname) > 15){
            echo "Le champ firstname est trop long";
            exit;
        }
    }else{
        echo "Le champ Contact person contien des caractères invalide";
        exit;
    }
// ---
    $lastname = sanitizeIpunt($_POST["contact_lastname"]);
    if (validLetterOnly($lastname)){
        if (strlen($lastname) > 15){
            echo "Le champ lastname est trop long";
            exit;
        }
    }else{
        echo "Le champ Contact person contien des caractères invalide";
        exit;
    }
// ---
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (validEmailOnly($email)){
        if (strlen($email) > 27){
            echo "Le champ email est trop long";
            exit;
        }
    }else{
        echo "Email non valide";
        exit;
    }
// ---
    $number_contact = sanitizeIpunt($_POST["number"]);
    if (validNumberOnly($number_contact)){
        if (strlen($number_contact) > 10){
            echo "Le champ number est trop long";
            exit;
        }
    }else{
        echo "Le champ Contact number contien des caractères invalide";
        exit;
    }
// ---
    $recorded = sanitizeIpunt($_POST["recorded"]);
    if ($recorded !== "yes" && $recorded !== "no"){
        header("Location: fail.html");
        exit;
    }
// ---
    $file = $_FILES["fileToUpload"];

    // verification si pdf
    if ($file["type"] !== "application/pdf"){
        echo "Le fichier doit être en format PDF";
        exit;
    }
    // Vérification de l'extension du fichier
    $filename = $file["name"];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if ($extension !== "pdf") {
        echo "Le fichier doit avoir l'extension PDF.";
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
        ?>
    </div>
</body>
</html>
