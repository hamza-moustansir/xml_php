<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPassword = $_POST['new_password'];

    $xml = simplexml_load_file('input.xml');

    foreach ($xml->user as $user) {
        if ((string)$user->username === $newUsername) {
            $registrationError = "Username already exists. Choose a different one.";
            break;
        }
    }

    if (!isset($registrationError)) {
        $newUser = $xml->addChild('user');
        $newUser->addChild('username', $newUsername);
        $newUser->addChild('email', $newEmail);
        $newUser->addChild('password', $newPassword);

        $xml->asXML('input.xml');

        header("Location: login.php");
        exit();
    }
}
?>

<?php if (isset($registrationError)) : ?>
    <p style="color: red;"><?php echo $registrationError; ?></p>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Data Form</title>

    <style>
        @import @import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: whitesmoke;
            background-position: left;
            background: no-repeat url("https://cdn-06.9rayti.com/rsrc/cache/widen_750/uploads/2018/06/Préinscription-EST-Safi-2018.png");
            background-image: radial-gradient(at 101.6% 93.1%, 0px, transparent 50%), radial-gradient(at 75.4% 58.9%, #f0f0f0 0px, transparent 50%), radial-gradient(at 42.9% 77.8%, #E8486C 0px, transparent 50%), radial-gradient(at 60.2% 48.4%, #FF8157 0px, transparent 50%), radial-gradient(at 60.2% 15.4%, #FFBD51 0px, transparent 50%), radial-gradient(at 78.9% 26.7%, #F9F871 0px, transparent 50%);
            /* background-size: cover; */
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-size: 18rem;
            background-repeat: wordwrap;
            background-position-x: center;
            background-position-y: top;
        }

        /* LOGIN CONTAINER  */

        .container {
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 500px;
            max-width: 90%;
            margin-top: 8.5rem;
        }

        /* HEADER  */

        .header {
            /* background-color: #F5F9FF; */
            border-radius: 1px solid #f0f0f0;
            padding: 20px 40px 0;
            text-align: center;
            font-family: 'Comfortaa', cursive;
            font-size: 1.3rem;
            animation: title 1s ease 0s 1 normal forwards;
        }

        @keyframes title {
            0% {
                letter-spacing: 10px;
                color: #f5f9ff;
            }

            100% {
                letter-spacing: 1px;
                color: #2b5175;
            }
        }

        /* FORM  */

        .form {
            padding: 30px 40px 20px;
        }

        .form-control {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control label {
            display: inline-block;
            margin-bottom: 5px;
            color: #2b5175;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .form-control input {
            border: transparent;
            background: transparent;
            outline: 2px dotted #f0f0f0;
            border-radius: 4px;
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            font-size: 0.8rem;
            font-family: inherit;
            transition: all 0.4s ease-in;
        }

        .form-control input::placeholder {
            opacity: 0.5;
            color: #1e293b;
            font-weight: 600;
        }

        input:focus {
            border: transparent;
            outline: 2px dotted #2B5175;
        }

        .form-control.success input {
            /* border-color: #2ecc71; */
            outline: 2px dotted #2ecc71;
        }

        .form-control.error input {
            /* border-color: #e74c3c; */
            outline: 2px dotted #8b2e31;
        }

        .form-control i {
            position: absolute;
            top: 33px;
            right: 10px;
            visibility: hidden;
        }

        .form-control.success i.fa-check-circle {
            visibility: visible;
            color: #2ecc71;
        }

        .form-control.error i.fa-exclamation-circle {
            visibility: visible;
            color: #e74c3c;
        }

        .form-control small {
            position: absolute;
            bottom: 0;
            left: 0;
            visibility: hidden;
        }

        .form-control.error small {
            visibility: visible;
            color: #8b2e31;
            font-weight: 600;
        }

        /* SUBMIT BUTTON  */

        .form button {
            display: block;
            background: #512479;
            background-size: 200% auto;
            color: #fff;
            width: 100%;
            padding: 15px 45px;
            margin: 30px 0 10px;
            font-size: 16px;
            font-family: 'Comfortaa', cursive;
            letter-spacing: 2px;
            text-align: center;
            text-transform: uppercase;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.5s linear;
        }

        .form button:hover {
            background: #2A0053;
            color: #fff;
            text-decoration: none;
        }

        /* MESSAGE AFTER SUBMITTING  */

        .message {
            padding: 30px;
            font-size: 2rem;
            font-weight: 600;
            color: #2b5175;
            text-align: center;
            text-transform: uppercase;
            animation: fade-in 1.5s ease-in-out forwards alternate;
            -webkit-animation: fade-in 1.5s ease-in-out forwards alternate;
        }

        .hidden {
            display: none;
        }

        @keyframes fade-in {
            from {
                transform: rotate(0deg) scale(0) skew(0deg) translateY(30px);
            }

            to {
                transform: rotate(0deg) scale(1) skew(0deg) translateY(0);
            }
        }

        @-webkit-keyframes fade-in {
            from {
                -webkit-transform: rotate(0deg) scale(0) skew(0deg) translateY(30px);
            }

            to {
                -webkit-transform: rotate(0deg) scale(1) skew(0deg) translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Create Account</h2>
        </div>

        <form class="form" id="form" action="registre.php" method="post">
            <div class="form-control">
                <label for="">Username</label>
                <input type="text" placeholder="username" id="username" name="new_username" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="">Email</label>
                <input type="email" placeholder="info@email.com" id="email" name="new_email">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="">Password</label>
                <input type="password" placeholder="password" id="password" name="new_password" required>
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <div class="form-control">
                <label for="">Confirm Password</label>
                <input type="password" placeholder="confirm password" id="confirmpassword">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation-circle"></i>
                <small>Error message</small>
            </div>
            <button>Submit</button>
        </form>
        <div class="message hidden">
            <p>Submitted! 🎉</p>
        </div>
    </div>
</body>

</html>