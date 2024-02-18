<?php
$xmlFile = 'input.xml';

function getCandidateDataById($xmlFile, $id)
{
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);
        $candidates = $xml->getElementsByTagName("candidate");

        foreach ($candidates as $candidate) {
            $candidateId = $candidate->getElementsByTagName("id")->item(0)->nodeValue;

            if ($candidateId == $id) {
                $data = array(
                    'prenom' => getElementValue($candidate, 'prenom'),
                    'midlle' => getElementValue($candidate, 'midlle'),
                    'nom' => getElementValue($candidate, 'nom'),
                    'sex' => getElementValue($candidate, 'sex'),
                    'date' => getElementValue($candidate, 'date'),
                    'cni' => getElementValue($candidate, 'cni'),
                    'cne' => getElementValue($candidate, 'cne'),
                    'adresse' => getElementValue($candidate, 'adresse'),
                    'ville' => getElementValue($candidate, 'ville'),
                    'postale' => getElementValue($candidate, 'postale'),
                    'mobile' => getElementValue($candidate, 'mobile'),
                    'email' => getElementValue($candidate, 'email'),
                    'apoge' => getElementValue($candidate, 'apoge'),
                    'moyen_bac' => getElementValue($candidate, 'moyen_bac'),
                    'annee_bac' => getElementValue($candidate, 'annee_bac'),
                    'type_diplome' => getElementValue($candidate, 'type_diplome'),
                    'specialite_diplome' => getElementValue($candidate, 'specialite_diplome'),
                    'moyenne_diplome' => getElementValue($candidate, 'moyenne_diplome'),
                    'classement' => getElementValue($candidate, 'classement'),
                    'totale' => getElementValue($candidate, 'totale'),
                    'moyennee_diplome' => getElementValue($candidate, 'moyennee_diplome'),
                    'classemente' => getElementValue($candidate, 'classemente'),
                    'totalee' => getElementValue($candidate, 'totalee'),
                    'choix_1' => getElementValue($candidate, 'choix_1'),
                    'choix_2' => getElementValue($candidate, 'choix_2'),
                    'choix_3' => getElementValue($candidate, 'choix_3'),
                );

                return $data;
            }
        }
    }

    return null;
}

function getElementValue($parent, $tagName)
{
    $element = $parent->getElementsByTagName($tagName)->item(0);
    return $element ? $element->nodeValue : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $formData = getCandidateDataById($xmlFile, $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations du Candidat</title>
    <style>
        .logoutbutton {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="logoutbutton">
        <input type='button' value='logout' onclick="window.location.href='logout.php'" />
    </div>
    <center>
        <h1><b>Informations du Candidat</b></h1>
    </center>
    <?php if (!empty($formData)) : ?>
        <blockquote>
            <caption><b></b></caption>
            <table cellspacing="10" border="1">
                <?php foreach ($formData as $key => $value) : ?>
                    <tr>
                        <td><b><?php echo ucfirst($key); ?></b></td>
                        <td><?php echo $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </blockquote>
    <?php else : ?>
        <p>Candidat non trouvé.</p>
    <?php endif; ?>
</body>

</html>