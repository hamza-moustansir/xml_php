<?php

function appendXmlData($xmlFile, $firstname, $middlename, $surname, $gender, $birthdate, $cni, $cne, $adresse, $ville, $postale, $mobile, $email, $apoge, $moyen, $annee, $type, $specialite, $moyenne, $classement, $totale, $moyennee, $classemente, $totalee, $choix, $choixe, $choixee)
{

    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        $lastId = getLastCandidateId();

        $newId = $lastId + 1;
        $root = $xml->documentElement;
        if (!$root) {
            $root = $xml->createElement('ests');
            $xml->appendChild($root);
        }

        $candidate = $xml->createElement('candidate');
        $tag0 = $xml->createElement('id', $newId);
        $candidate->appendChild($tag0);

        $tag1 = $xml->createElement('prenom', $firstname);
        $candidate->appendChild($tag1);

        $tag2 = $xml->createElement('midlle', $middlename);
        $candidate->appendChild($tag2);

        $tag3 = $xml->createElement('nom', $surname);
        $candidate->appendChild($tag3);

        $tag4 = $xml->createElement('sex', $gender);
        $candidate->appendChild($tag4);

        $tag5 = $xml->createElement('date', $birthdate);
        $candidate->appendChild($tag5);

        $tag6 = $xml->createElement('cni', $cni);
        $candidate->appendChild($tag6);

        $tag7 = $xml->createElement('cne', $cne);
        $candidate->appendChild($tag7);

        $tag8 = $xml->createElement('adresse', $adresse);
        $candidate->appendChild($tag8);

        $tag9 = $xml->createElement('ville', $ville);
        $candidate->appendChild($tag9);

        $tag10 = $xml->createElement('postale', $postale);
        $candidate->appendChild($tag10);

        $tag11 = $xml->createElement('mobile', $mobile);
        $candidate->appendChild($tag11);

        $tag12 = $xml->createElement('email', $email);
        $candidate->appendChild($tag12);

        $tag13 = $xml->createElement('apoge', $apoge);
        $candidate->appendChild($tag13);

        $tag14 = $xml->createElement('moyen_bac', $moyen);
        $candidate->appendChild($tag14);

        $tag15 = $xml->createElement('annee_bac', $annee);
        $candidate->appendChild($tag15);

        $tag16 = $xml->createElement('type_diplome', $type);
        $candidate->appendChild($tag16);

        $tag17 = $xml->createElement('specialite_diplome', $specialite);
        $candidate->appendChild($tag17);

        $tag18 = $xml->createElement('moyenne_diplome', $moyenne);
        $candidate->appendChild($tag18);

        $tag19 = $xml->createElement('classement', $classement);
        $candidate->appendChild($tag19);

        $tag20 = $xml->createElement('totale', $totale);
        $candidate->appendChild($tag20);

        $tag21 = $xml->createElement('moyennee_diplome', $moyennee);
        $candidate->appendChild($tag21);

        $tag22 = $xml->createElement('classemente', $classemente);
        $candidate->appendChild($tag22);

        $tag23 = $xml->createElement('totalee', $totalee);
        $candidate->appendChild($tag23);

        $tag24 = $xml->createElement('choix_1', $choix);
        $candidate->appendChild($tag24);

        $tag25 = $xml->createElement('choix_2', $choixe);
        $candidate->appendChild($tag25);

        $tag26 = $xml->createElement('choix_3', $choixee);
        $candidate->appendChild($tag26);

        $status = $xml->createElement('status', 'en cours');
        $candidate->appendChild($status);

        $root->appendChild($candidate);

        $xml->save($xmlFile);

        saveLastCandidateId($newId);

        echo "candidate added successfully!";
        echo "<script>window.location.href='';</script>";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}
function getLastCandidateId()
{
    $idFile = 'last_candidate_id.txt';

    if (file_exists($idFile) && is_readable($idFile)) {
        $lastId = intval(file_get_contents($idFile));

        if ($lastId !== 0) {
            return $lastId;
        }
    }

    return 0;
}
function saveLastCandidateId($newId)
{
    $idFile = 'last_candidate_id.txt';

    file_put_contents($idFile, $newId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = 'input.xml';

    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $middlename = isset($_POST['middlename']) ? $_POST['middlename'] : '';
    $surname = isset($_POST['surname']) ? $_POST['surname'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $cni = isset($_POST['cni']) ? $_POST['cni'] : '';
    $cne = isset($_POST['cne']) ? $_POST['cne'] : '';
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
    $ville = isset($_POST['ville']) ? $_POST['ville'] : '';
    $postale = isset($_POST['postale']) ? $_POST['postale'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $apoge = isset($_POST['apoge']) ? $_POST['apoge'] : '';

    $moyen = isset($_POST['moyen']) ? $_POST['moyen'] : '';
    $annee = isset($_POST['annee']) ? $_POST['annee'] : '';

    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $specialite = isset($_POST['specialite']) ? $_POST['specialite'] : '';
    $moyenne = isset($_POST['moyenne']) ? $_POST['moyenne'] : '';
    $classement = isset($_POST['classement']) ? $_POST['classement'] : '';
    $totale = isset($_POST['totale']) ? $_POST['totale'] : '';

    $moyennee = isset($_POST['moyennee']) ? $_POST['moyennee'] : '';
    $classemente = isset($_POST['classemente']) ? $_POST['classemente'] : '';
    $totalee = isset($_POST['totalee']) ? $_POST['totalee'] : '';

    $choix = isset($_POST['choix']) ? $_POST['choix'] : '';
    $choixe = isset($_POST['choixe']) ? $_POST['choixe'] : '';
    $choixee = isset($_POST['choixee']) ? $_POST['choixee'] : '';

    appendXmlData($xmlFile, $firstname, $middlename, $surname, $gender, $birthdate, $cni, $cne, $adresse, $ville, $postale, $mobile, $email, $apoge, $moyen, $annee, $type, $specialite, $moyenne, $classement, $totale, $moyennee, $classemente, $totalee, $choix, $choixe, $choixee);

    header('Location: message.php');
    exit();
} else {
    echo " .";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Data Form</title>
    <style>
        /* .logoutbutton {
            text-align: right;
        }
        body {
    font-family: Arial, sans-serif;
    background-color: whitesmoke;
    margin: 0;
    padding: 0;
    background-image: radial-gradient(at 101.6% 93.1%,  0px, transparent 50%), radial-gradient(at 75.4% 58.9%, #f0f0f0 0px, transparent 50%), radial-gradient(at 42.9% 77.8%, #E8486C 0px, transparent 50%), radial-gradient(at 60.2% 48.4%, #FF8157 0px, transparent 50%), radial-gradient(at 60.2% 15.4%, #FFBD51 0px, transparent 50%), radial-gradient(at 78.9% 26.7%, #F9F871 0px, transparent 50%);

    
}

.logoutbutto:hover {
    text-align: right;
    padding: 20px;
    color: #ff0000;
}

.logoutbutton input {
    font-size: 16px;
    padding: 10px 20px;
    background-color: #ff0000;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

h1 {
    color: #333333;
    text-align: center;
    padding: 20px 0;
}

form {
    width: 80%;
    margin: 0 auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 10px;
}

input[type="text"],
input[type="tel"],
input[type="email"],
input[type="date"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 5px;
}

input[type="radio"] {
    margin-right: 5px;
}

input[type="submit"] {
    font-size: 16px;
    padding: 10px 20px;
    background-color: #008CBA;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
} */
        body {
            font-family: Arial, sans-serif;
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .logoutbutton {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1a252f;
            border-radius: 4px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            background-color: #3e5871;
            color: #ecf0f1;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type='button'] {
            background-color: #3498db;
            color: #ecf0f1;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type='button']:hover {
            background-color: #217dbb;
        }
    </style>
</head>

<body>
    <div class="logoutbutton">
        <input type='button' value='logout' onclick=" window.location.href='logout.php'" />
    </div>

    <center>
        <h1><b>Nouvelle inscription</b></h1>
    </center>
    <blockquote>

        <form action=" form.php" method="post">
            <table cellspacing="10" border="0">
                <tr>
                    <td>
                        <h4><b>Information General</b></h4>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2"><label>Your Name</label></td>
                    <td>
                        <label>*First Name</label>
                    </td>
                    <td><label>Middle Name</label></td>
                    <td><label>*Surname</label></td>
                </tr>
                <tr>

                    <td>
                        <input type="text" name="firstname" id="firstname" required>
                    </td>
                    <td><input type="text" name="middlename" id="middlename"></td>
                    <td><input type="text" name="surname" id="surname" required></td>
                </tr>

                <tr>
                    <td><label>*Gender</label></td>
                    <td><input type="radio" name="gender" id="male" value="male">
                        <label>Male</label>
                        <input type="radio" name="gender" id="female" value="female">
                        <label>Female</label>
                    </td>
                </tr>
                <tr>
                    <td><label>*Birth Date</label></td>
                    <td colspan="3"><input type="date" name="birthdate" id="birthdate" size="50px"></td>
                </tr>
                <tr>
                    <td><label>*CNI</label></td>
                    <td colspan="3"><input type="text" name="cni" id="cni" size="20px"></td>
                </tr>
                <tr>
                    <td><label>*CNE</label></td>
                    <td colspan="3"><input type="text" name="cne" id="cne" size="20px"></td>
                </tr>
                <tr>
                    <td><label>*Adresse</label></td>
                    <td colspan="3"><input type="text" name="adresse" id="adresse" size="40px"></td>
                </tr>
                <tr>
                    <td><label>*Ville</label></td>
                    <td colspan="3"><select name="ville" id="ville">
                            <option>Choisir une ville</option>
                            <option>Beni Mellal</option>
                            <option>Safi</option>
                            <option>Casablanca</option>
                            <option>Fes</option>
                            <option>Rabat</option>
                            <option>Marrakech</option>
                            <option>Tanger</option>
                            <option>Meknes</option>
                            <option>Oujda</option>
                            <option>Kenitra</option>
                            <option>Agadir</option>
                            <option>Tetouan</option>
                            <option>Temara</option>
                            <option>Mohammedia</option>
                            <option>El Jadida</option>
                            <option>Aït Melloul</option>
                            <option>Nador</option>
                            <option>Settat</option>
                            <option>Khemisset</option>
                            <option>Guelmim</option>
                            <option>Khenifra</option>
                            <option>Berkane</option>
                            <option>Taourirt</option>
                            <option>Fquih Ben Salah</option>
                            <option>Oued Zem</option>
                            <option>El Kelaa Des Sraghna</option>
                            <option>Sidi Slimane</option>
                            <option>Errachidia</option>
                            <option>Guercif</option>
                            <option>Ouarzazate</option>
                            <option>Tiznit</option>

                        </select></td>
                </tr>
                <tr>
                    <td><label>*Code Postal</label></td>
                    <td colspan="3"><input type="text" name="postale" id="postale" size="10px"></td>
                </tr>

                <tr>
                    <td rowspan="2"><label>Contact</label></td>
                    <td><label>* Mobile Phone</label></td>
                    <td><label>* Email Address</label></td>
                </tr>
                <tr>
                    <td><input type="tel" name="mobile" id="mobile" size="20px" placeholder="06********"></td>
                    <td><input type="email" name="email" id="email" placeholder="example.gmail.com"></td>
                </tr>
                <tr>
                    <td><label>*Numero Apogee</label></td>
                    <td colspan="3"><input type="text" name="apoge" id="apoge" size="10px"></td>
                </tr>
                <tr>
                    <td>
                        <h4><b>Information curseur(Partie1)</b></h4>
                    </td>
                </tr>
                <tr>
                    <td><label>* Moyenne</label></td>
                    <td colspan="2"><input type="text" name="moyen" id="moyen" size="10px" placeholder="00,00"></td>
                </tr>
                <tr>
                    <td><label>* Annee</label></td>
                    <td colspan="2"><select name="annee" id="annee">
                            <option>choisir une annee</option>
                            <option>2021</option>
                            <option>2020</option>
                            <option>2019</option>
                        </select></td>
                </tr>
                <tr>
                    <td>
                        <h4><b>Information curseur(Partie2)</b></h4>
                    </td>
                </tr>
                <tr>
                    <td><label>*type</label></td>
                    <td><select name="type" id="type">
                            <option>choisir le type de diplome</option>
                            <option>DUT</option>
                            <option>DEUG</option>
                            <option>BTS</option>
                            <option>DTS</option>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td><label>*Specialité</label></td>
                    <td colspan="2"><input type="text" name="specialite" id="specialite" size="30px"></td>
                </tr>
                <tr>
                    <td rowspan="2"><label>Premiere Annee</label></td>
                    <td>
                        <label>*Moyenne</label>
                    </td>
                    <td><label>*Classement</label></td>
                    <td><label>*nombre totale des etudiants </label></td>
                </tr>
                <tr>

                    <td>
                        <input type="text" name="moyenne" id="moyenne" required>
                    </td>
                    <td><input type="text" name="classement" id="classement" required></td>
                    <td><input type="text" name="totale" id="totale" required></td>
                </tr>
                <tr>
                    <td rowspan="2"><label>douxieme Annee</label></td>
                    <td>
                        <label>*Moyenne</label>
                    </td>
                    <td><label>*Classement</label></td>
                    <td><label>*nombre totale des etudiants </label></td>
                </tr>
                <tr>

                    <td>
                        <input type="text" name="moyennee" id="moyennee" required>
                    </td>
                    <td><input type="text" name="classemente" id="classemente" required></td>
                    <td><input type="text" name="totalee" id="totalee" required></td>
                </tr>


                <tr>
                    <td>
                        <h4><b>Choix</b></h4>
                    </td>
                </tr>

                <tr>
                    <td><label>* 1 choix</label></td>
                    <td colspan="2"><select name="choix" id="choix">
                            <option>choisir une choix</option>
                            <option>MÉCATRONIQUE</option>
                            <option>MÉTROLOGIE, QUALITÉ, SÉCURITÉ ET ENVIRONNEMENT</option>
                            <option>Ingénierie des Systèmes d’information et Réseaux</option>
                            <option>GESTION COMPTABLE ET FINANCIÈRE</option>
                        </select></td>
                </tr>
                <tr>
                    <td><label>* 2 choix</label></td>
                    <td colspan="2"><select name="choixe" id="choixe">
                            <option>choisir une choix</option>
                            <option>MÉCATRONIQUE</option>
                            <option>MÉTROLOGIE, QUALITÉ, SÉCURITÉ ET ENVIRONNEMENT</option>
                            <option>Ingénierie des Systèmes d’information et Réseaux</option>
                            <option>GESTION COMPTABLE ET FINANCIÈRE</option>
                        </select></td>
                </tr>
                <tr>
                    <td><label>* 3 choix</label></td>
                    <td colspan="2"><select name="choixee" id="choixee">
                            <option>choisir une choix</option>
                            <option>MÉCATRONIQUE</option>
                            <option>MÉTROLOGIE, QUALITÉ, SÉCURITÉ ET ENVIRONNEMENT</option>
                            <option>Ingénierie des Systèmes d’information et Réseaux</option>
                            <option>GESTION COMPTABLE ET FINANCIÈRE</option>
                        </select></td>
                </tr>
                <tr>
                    <td><input type="submit" value="SUBMIT"></td>
                </tr>
            </table>
        </form>
    </blockquote>

</body>

</html>