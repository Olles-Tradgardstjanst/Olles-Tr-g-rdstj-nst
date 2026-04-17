<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Hämta data
    $name = strip_tags($_POST['name']);
    $phone = strip_tags($_POST['phone']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $address = strip_tags($_POST['address']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $info = strip_tags($_POST['additional_info']);

    $services = "";
    if (!empty($_POST['service'])) {
        $services = implode(", ", $_POST['service']);
    }

    // DIN MAIL (ändra!)
    $to = "dinmail@gmail.com";

    $subject = "Ny bokning från hemsidan";

    $message = "Ny bokning:\n\n";
    $message .= "Namn: $name\n";
    $message .= "Telefon: $phone\n";
    $message .= "E-post: $email\n";
    $message .= "Adress: $address\n\n";
    $message .= "Tjänster: $services\n\n";
    $message .= "Datum: $date\n";
    $message .= "Tid: $time\n\n";
    $message .= "Övrigt:\n$info\n";

    $headers = "From: $email";

    // Skicka mail
    if(mail($to, $subject, $message, $headers)) {
        header("Location: tack.html");
        exit();
    } else {
        echo "Något gick fel. Försök igen.";
    }
}
?>
