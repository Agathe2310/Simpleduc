<?php

class Mail
{

    //put your code here
    public function __construct()
    {
    }

    public function envoyerMailer($destinataire, $sujet, $message, $piecejointe)
    {
        require_once 'confMail.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
        $mail->Host = 'smtp.office365.com'; // Spécifier le serveur SMTP
        $mail->SMTPAuth = true; // Activer authentication SMTP
        $mail->Username = $conf['email']; // Votre adresse email d'envoi
        $mail->Password = $conf['mdp']; // Le mot de passe de cette adresse email
        $mail->SMTPSecure = 'tls'; // Accepter SSL
        $mail->Port = 587;
        $mail->setFrom($conf['email'], 'Site PHP'); // Personnaliser l'envoyeur
        $mail->addAddress($destinataire);
        if (!empty($piecejointe)) {
            $mail->addAttachment($piecejointe); // Ajouter un attachement
        }
        $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non
        $mail->Subject = $sujet;
        $mail->Body = $message;

        if (!$mail->send()) {
            echo 'Erreur, message non envoyé.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Le message a bien été envoyé !';
        }
    }
}

function getConfirmationCompte($db, $IDConf)
{
    $query = $db->prepare("SELECT IDPersonne, dateConf FROM ConfirmationCompte WHERE IDConfirmation = :IDConf");
    $query->execute([
        'IDConf' => $IDConf
    ]);

    $confCompte = $query->fetch();

    return $confCompte;
}

function addConfirmationCompte($db, $idUser)
{
    $IDConf = intval(rand(100000, 999999));



    if (getConfirmationCompte($db, $IDConf) == false) {
        $query = $db->prepare("INSERT INTO ConfirmationCompte (IDConfirmation, IDPersonne, dateConf) VALUES (:IDConf, :IDPersonne, Now())");
        $query->execute([
            'IDPersonne' => $idUser,
            'IDConf' => $IDConf
        ]);
        return $IDConf;
    }

    return null;
}

function confirmerCompte($db, $id)
{
    $query = $db->prepare("UPDATE Personne 
                            SET CompteVerifie = 1
                            WHERE IDPersonne = :IDPersonne ");
    $query->execute([
        'IDPersonne' => $id
    ]);

    $query = $db->prepare("DELETE FROM ConfirmationCompte 
                            WHERE IDPersonne = :IDPersonne ");
    $query->execute([
        'IDPersonne' => $id
    ]);
}

function delConfirmation($db, $id) {
    $query = $db->prepare("DELETE FROM ConfirmationCompte 
                            WHERE IDPersonne = :IDPersonne ");
    $query->execute([
        'IDPersonne' => $id
    ]);
}

function verifyDateConfirmation($dateConf)
{
    $now = new DateTime(date('Y-m-d H:i:s'));
    $dateConf = new DateTime(date($dateConf));
    $now ->modify("-24 hours");

    //Si apres avoir enlevé 24 heures, c'était il y a toujours plus de 24 heures, return false
    if ($now > $dateConf) return false;
    return true;
}

function getDateBySQL()
{
    $date = getdate();
    return strval($date['year']) . strval($date['month']) . strval($date['day']);
}

function envoyerVerification($db, $twig, $idUser, $email) {
    $mail2 = new Mail();

                    //Création vérif
                    $idRegister = addConfirmationCompte($db, $idUser);

                    //Envoyer mail
                    if ($idRegister != null) {
                        $mail2->envoyerMailer(
                            $email,
                            "Confirmer le compte PHP",
                            $twig->render("mail/register_message.html.twig", [
                                'email' => $email,
                                'idRegister' => $idRegister
                            ]),
                            null
                        );
                    }

}