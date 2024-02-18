<?php

function deleteStudentById($xmlFile, $idToDelete)
{
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        $ests = $xml->getElementsByTagName("candidate");
        foreach ($ests as $candidate) {
            $studentId = $candidate->getElementsByTagName("id")->item(0)->nodeValue;

            if ($studentId == $idToDelete) {
                $xml->documentElement->removeChild($candidate);

                $xml->save($xmlFile);

                echo "candidate with ID $idToDelete deleted successfully!";
                return;
            }
        }


        echo "Student with ID $idToDelete not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}

if (isset($_GET['id'])) {
    $xmlFile = 'input.xml';
    $idToDelete = intval($_GET['id']);

    deleteStudentById($xmlFile, $idToDelete);
    header('Location: input.xml');
    exit();
} else {
    echo "Error: Student ID not provided.";
}
