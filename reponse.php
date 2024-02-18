<?php
$xmlFile = 'input.xml';

function updateXmlData($xmlFile, $id, $newData)
{
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        $candidates = $xml->getElementsByTagName("candidate");

        foreach ($candidates as $candidate) {
            $candidateId = $candidate->getElementsByTagName("id")->item(0)->nodeValue;

            if ($candidateId == $id) {
                foreach ($newData as $field => $value) {
                    $candidateField = $candidate->getElementsByTagName($field)->item(0);
                    if ($candidateField !== null) {
                        $candidateField->nodeValue = $value;
                    } else {
                        $subElement = $candidate->getElementsByTagName('*')->item(0);
                        if ($subElement !== null) {
                            $subElementField = $subElement->getElementsByTagName($field)->item(0);
                            if ($subElementField !== null) {
                                $subElementField->nodeValue = $value;
                            }
                        }
                    }
                }

                $xml->save($xmlFile);

                echo "Data updated successfully!";
                return;
            }
        }
        echo "Candidate not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}

function getElementValue($parent, $tagName)
{
    $element = $parent->getElementsByTagName($tagName)->item(0);
    return $element ? $element->nodeValue : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $newData = array(
        'status' => isset($_POST['status']) ? $_POST['status'] : '',
    );

    updateXmlData($xmlFile, $id, $newData);
    header('Location: input.xml');
    exit();
} else {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Data Form</title>
    <style>
        .loginform {
            position: absolute;
            background: #fff;
            width: 400px;
            height: 250px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 5px;
            border: 1px solid #6e6cfc;
            padding: 10px;
            box-shadow: 0 12px 20px -10px #6e6cfc;
            text-align: center;
            border-radius: 10px;
        }

        h3 {

            font-family: "Roboto", "Arial", sans-serif;
            font-size: 2.5em;
            font-weight: normal;
            padding: 10px 40px;
            display: inline-block;
            margin: 0;
            line-height: 1;
            letter-spacing: 0;
            color: #6e6cfc;
        }

        select {
            margin-top: 10px;
            text-align: center;
            width: 60%;
            height: 35px;
            border-radius: 10px;
            border: none;
            outline: none;
        }

        select:hover {
            box-shadow: 2px 2px 10px #6e6cfc;
        }

        input:not(.logout) {
            margin-top: 10px;
            text-align: center;
            width: 60%;
            height: 35px;
            border-radius: 10px;
            border: none;
            outline: none;
        }

        input:hover {
            box-shadow: 2px 2px 10px #6e6cfc;
        }

        input:active {
            box-shadow: 2px 2px 20px #6e6cfc;
        }

        input[type=submit] {
            margin-top: 30px;
            width: 40%;
            height: 35px;
            border-radius: 10px;
            background: #6e6cfc;
            border: 1px solid #6e6cfc;
            outline: none;
            color: #fff;
            font-size: 20px;
        }

        .logoutbutton {
            text-align: right;
        }
    </style>

</head>

<body>
    <div class="logoutbutton">
        <input type='button' value='logout' class="logout" onclick="window.location.href='logout.php'" />
    </div>

    <div class="loginform">
        <h3>UPDATE STATUS</h3>
        <form action="reponse.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="status">Choose status:</label>
            <select name="status" id="status" class="form-select">
                <option selected disabled>Select status</option>
                <option value="accepte">Accepte</option>
                <option value="refuser">Refuser</option>
            </select>

            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>