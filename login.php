<?php
session_start();

if (isset($_SESSION['email'])) {
    header("Location: input.xml");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml = simplexml_load_file('input.xml');

    foreach ($xml->user as $user) {
        $email = (string)$user->email;
        $password = (string)$user->password;

        if ($_POST['email'] === $email && $_POST['password'] === $password) {
            $_SESSION['email'] = $email;
            header("Location: form.php");
            exit();
        }
    }
    $error = "Nom d'utilisateur ou mot de passe incorrect.";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml = simplexml_load_file('input.xml');

    foreach ($xml->admin as $admin) {
        $email = (string)$admin->email;
        $password = (string)$admin->password;

        if (
            $_POST['email'] === $email && $_POST['password'] === $password
        ) {
            $_SESSION['email'] = $email;
            header("Location: input.xml");
            exit();
        }
    }
    $error = "Nom d'utilisateur ou mot de passe incorrect.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <style>
        :root {
            --white: #ffffff;
            --activatedCharcoal: #25252f;
            --activatedCharcoalFocus: rgba(var(--activatedCharcoal), 0.2);
            --activatedCharcoalBg: rgba(var(--activatedCharcoal), 0.1);
            --purpleHero: #651edb;
            --purpleHeroHover: #5118af;
            --purpleHeroActive: #3d1283;
            --purpleHeroFocus: rgba(var(--purpleHero), 0.2);
            --radiusDefault: 4px;
            --radiusMedium: 8px;
            --radiusLarge: 16px;
            --animateDefault: 0.22s;
            --animateMedium: 0.4s;
        }

        * {
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fafcfe;
            color: var(--activatedCharcoal);
            font-family: "Inter", sans-serif;
            font-size: 1rem;
        }

        input,
        button {
            height: 44px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 24px;

            .form-control {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            . label {}

            .helper {
                font-size: 0.875rem;
            }
        }

        input[type="email"],
        input[type="password"] {
            display: block;
            width: 100%;
            padding: 8px;
            background: var(--white);
            border-radius: var(--radiusDefault);
            border: 1px solid #ccc;
            transition: var(--animateDefault) ease;
            outline: none;

            &:hover {
                border-color: var(--purpleHero);
            }

            &:focus {
                border-color: var(--activatedCharcoal);
                box-shadow: 0px 0px 0px 4px rgba(#5118af, 0.2), inset 0px 0px 0px 1px #5118af;
            }
        }

        button {
            background-color: var(--purpleHero);
            color: white;
            padding: 12px 24px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: var(--radiusDefault);
            transition: var(--animateDefault) ease;
            font-weight: 700;
            letter-spacing: 0.25px;
            height: 3rem;

            @media screen and (min-width: 960px) {
                font-size: 1.125rem;
            }

            &:hover {
                background-color: var(--purpleHeroHover);
            }

            &:active {
                background-color: var(--purpleHeroActive);
            }
        }

        a {
            &:not(.button) {
                color: var(--text-link);

                &:hover {
                    text-decoration: none;
                }
            }
        }

        .flex-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;

            @media screen and (min-width: 960px) {
                flex-direction: row;
            }
        }

        .left-column {
            flex-grow: 0;
            align-items: center;
            justify-content: center;
            position: relative;
            color: white;

            @media screen and (min-width: 940px) {
                min-width: 100px;
                flex: 0 0 30%;
                align-items: start;
                justify-content: start;
                background: no-repeat url("https://cdn-06.9rayti.com/rsrc/cache/widen_750/uploads/2018/06/Préinscription-EST-Safi-2018.png");
                background-position: 50%;
                background-size: cover;
                overflow: hidden;
                display: grid;
                animation-fill-mode: forwards;
            }

            .overlay {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: start;
                align-items: center;
                text-align: center;
                gap: 16px;
                // z-index: 0;
                padding: 4rem;

                @media screen and (min-width: 960px) {
                    // background: rgba(white, 0.1);
                    // backdrop-filter: blur(4px);
                    // gap: 32px;
                    // padding: 48px;
                    // border-bottom: 1px solid rgba(#25252f,0.1);
                }
            }

            .logo {
                // z-index: 100;
                fill: #000;
                font-weight: 500;
                z-index: 10;

                @media screen and (min-width: 960px) {
                    fill: #fff;
                    filter: drop-shadow(0 0 16px rgba(0, 0, 0, 0.52));
                }
            }

            .blurb {
                font-size: 1rem;
                line-height: 1.3;
                color: var(--activatedCharcoal);
                max-width: 400px;
                z-index: 10;

                @media screen and (min-width: 960px) {
                    font-size: 1.25rem;
                    line-height: 1.5;
                    color: unset;
                    text-shadow: 0 0 12px rgba(black, 0.6);
                }
            }
        }

        .left-column {
            @media screen and (min-width: 960px) {
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                    background: linear-gradient(180deg,
                            rgba(0, 0, 0, 0.6) 0%,
                            rgba(0, 0, 0, 0.6) 40%,
                            rgba(0, 0, 0, 0) 100%);
                    height: 30vh;
                    z-index: 1;
                }
            }
        }

        .right-column {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: center;
            flex-grow: 1;
            overflow-y: auto;
            padding: 0px 16px;

            @media screen and (min-width: 960px) {
                // padding: 112px 48px 48px;
                justify-content: center;
            }

            .content {
                width: 100%;
                max-width: 400px;
                display: flex;
                flex-direction: column;
                gap: 16px;

                h1 {
                    font-weight: 800;
                    font-size: 2.25rem;
                    letter-spacing: -0.5px;
                }

                .card {
                    @media screen and (min-width: 960px) {
                        padding-left: 24px;
                        padding-right: 24px;
                        background: white;
                        box-shadow: 0 12px 32px rgba(black, 0.08);
                        border-radius: var(--radiusMedium);
                    }

                    .header,
                    .body {
                        padding-top: 24px;
                        padding-bottom: 24px;
                    }

                    .header {
                        span {
                            font-weight: 700;
                            font-size: 1.5rem;
                        }
                    }
                }

                .create-account:hover {
                    background-color: var(--purpleHeroHover);
                }

                .create-account {
                    text-align: center;
                    padding: 0.5rem 1rem;
                    border-radius: var(--radiusMedium);
                    display: flex;
                    flex-direction: column;
                    background-color: var(--purpleHero);
                    color: white;
                    padding: 12px 24px;
                    margin: 8px 0;
                    border: none;
                    cursor: pointer;
                    width: 91%;
                    border-radius: var(--radiusDefault);
                    transition: var(--animateDefault) ease;
                    font-weight: 700;
                    letter-spacing: 0.25px;
                    height: 3rem;
                    margin-left: 1.2rem;

                }
            }
        }
    </style>

</head>

<body>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>








    <div class="flex-container">
        <div class="left-column">
            <div class="overlay">
                <svg class="logo" width="175" height="40" viewBox="0 0 175 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_512_22)">
                        <path d="M170.394 7.66415L174.568 11.8668C174.714 11.9829 174.822 12.1396 174.878 12.3171C174.963 13.3515 174.18 13.4081 173.38 13.4659C173.034 13.4909 172.685 13.5162 172.402 13.621C170.998 14.0009 169.746 14.8033 168.815 15.9193C167.883 17.0353 167.318 18.4109 167.195 19.8593C167.105 20.0266 166.969 20.1643 166.802 20.2558C166.636 20.3474 166.447 20.3888 166.257 20.3753C166.037 20.3558 165.831 20.2595 165.675 20.1032L164.305 18.7238C164.315 18.8182 164.315 18.9117 164.315 18.9869V19.8968C164.315 19.9543 164.317 20.0097 164.31 20.065C164.301 20.127 164.28 20.1888 164.231 20.2532V20.3377C164.231 20.3808 164.236 20.4209 164.241 20.4616C164.251 20.5449 164.262 20.6307 164.231 20.7505C164.201 20.8622 164.198 20.9925 164.194 21.1088C164.193 21.1779 164.191 21.2421 164.184 21.2945C164.174 21.3672 164.174 21.4448 164.168 21.5223C164.162 21.5949 164.15 21.6674 164.118 21.7354C164.074 21.8306 164.059 21.9215 164.055 22.0139C164.052 22.0581 164.052 22.1026 164.052 22.1482L163.996 22.439L161.867 32.5891L161.698 33.3489L161.632 34.4559L160.694 39.2495L160.544 40H84.6248L84.2589 39.6341L84.1932 39.9531H76.0694L71.5478 35.4034L71.9793 33.3489H69.4277L67.8424 31.7448C65.8749 33.1775 63.4934 33.9285 61.06 33.8837C58.4442 33.9866 55.8941 33.0488 53.9681 31.2758L51.5009 28.7899L50.9662 31.2851C50.9006 31.6416 50.8161 31.9794 50.7223 32.3077L50.6379 32.6173L50.4972 33.0675C50.4856 33.1066 50.4699 33.1444 50.4503 33.1801C50.3106 33.5937 50.1446 33.9979 49.9531 34.3902C49.9581 34.4054 49.9581 34.4219 49.9531 34.4371C49.9285 34.4891 49.9003 34.5392 49.8686 34.5872C49.727 34.8675 49.5705 35.1399 49.3996 35.4034C49.3679 35.4513 49.3397 35.5015 49.3152 35.5535L49.212 35.666C48.9827 35.9949 48.732 36.3082 48.4615 36.6041C48.3873 36.6783 48.3131 36.748 48.2377 36.8164C48.1607 36.8864 48.0825 36.9551 48.0018 37.0262L47.7955 37.2232C47.6654 37.3313 47.5323 37.4356 47.3964 37.5361C47.2843 37.619 47.1703 37.6992 47.0544 37.7767C45.1211 38.9222 42.891 39.4674 40.6473 39.3433C37.5516 39.3433 35.075 38.4427 33.5084 36.8668L29.0994 32.4296C27.3383 33.4262 25.3442 33.9377 23.3208 33.9118C20.7129 33.9925 18.1782 33.042 16.2664 31.2664L13.7993 28.7805L13.0019 32.6173L12.8424 33.3771H4.54036L0 28.7992L0.234521 27.6923L5.22515 3.72418L5.37521 2.97372H13.7054L13.9212 3.18013V2.97372H70.0469L70.2533 3.18013V2.97372H78.3771L82.9174 7.55158L82.6923 8.64913L82.4484 9.8499H84.7842L85.1501 10.2158C86.1779 9.61344 87.3453 9.29005 88.5366 9.27769C89.4126 9.26039 90.2825 9.42678 91.0903 9.76608C91.8982 10.1054 92.626 10.61 93.227 11.2476L93.105 11.1069L95.3095 13.3302C96.651 10.8068 99.6622 9.27769 103.752 9.27769C106.923 9.27769 109.259 10.0844 110.675 11.5478L112.27 13.152L112.805 10.5722L112.964 9.82173H121.097L123.424 12.1576L123.752 10.5816L123.912 9.83112H139.916L140.347 10.2627C141.431 9.62306 142.672 9.29818 143.931 9.32458C144.688 9.29503 145.442 9.43365 146.14 9.73047C146.837 10.0273 147.46 10.475 147.964 11.0413C147.938 11.0118 147.913 10.9823 147.888 10.9533C147.843 10.8995 147.798 10.847 147.75 10.7984L148.565 11.6135C149.275 10.8782 150.129 10.2959 151.072 9.90235C152.016 9.50877 153.03 9.3121 154.052 9.32458C154.595 9.2912 155.137 9.3374 155.663 9.46033L154.775 8.56473C154.654 8.43528 154.572 8.27421 154.539 8.10021C154.506 7.92621 154.523 7.74631 154.587 7.58147C154.652 7.41657 154.762 7.27343 154.905 7.16854C155.048 7.06365 155.217 7.00129 155.394 6.98875H156.107C156.299 6.97043 156.49 6.94226 156.679 6.9043C157.676 6.69474 158.614 6.26624 159.425 5.6497C160.237 5.03323 160.901 4.24418 161.37 3.33959C161.411 3.26962 161.448 3.19765 161.482 3.12384V3.07695C161.805 2.38215 162.001 1.63581 162.064 0.872416C162.08 0.635203 162.187 0.413106 162.361 0.251186C162.535 0.0892079 162.764 -0.00056984 163.002 2.72188e-06H163.077C163.219 0.0135152 163.357 0.0594347 163.479 0.134211C163.601 0.209045 163.704 0.310732 163.781 0.431543C164.456 1.08821 168.208 4.90617 168.208 4.90617C168.521 5.24238 168.498 5.67885 168.474 6.12046C168.459 6.39352 168.444 6.66858 168.508 6.92308C168.679 6.95371 168.852 6.9769 169.024 6.99259C169.19 7.00753 169.356 7.01566 169.522 7.01687C169.716 7.02093 169.905 7.0854 170.061 7.2014C170.217 7.31735 170.334 7.4791 170.394 7.66415Z" fill="black" />
                        <path d="M42.9361 10.7505H48.8648L45.544 26.5009C44.9343 29.484 43.771 31.1914 42.0074 32.4015C40.2236 33.4366 38.1753 33.9258 36.1163 33.8086C32.1951 33.8086 28.4333 32.167 28.0581 28.1801H34.0243C34.2119 29.1182 35.075 29.6529 36.3883 29.6529C38.1613 29.6529 38.9774 28.5835 39.3433 26.9043L39.6997 25.1688H39.5684C39.0449 25.7443 38.4099 26.2073 37.702 26.5298C36.994 26.8523 36.228 27.0276 35.4502 27.045C31.9981 27.045 29.2588 24.2964 29.3151 20.272C29.3902 15.5816 32.4483 10.2533 37.5797 10.2533C38.5521 10.1878 39.5229 10.4021 40.3774 10.8709C41.2319 11.3396 41.9342 12.0433 42.4014 12.8987H42.5046L42.9361 10.7505ZM37.8423 22.6454C40.1219 22.6454 41.3883 20.0188 41.4258 17.758C41.4258 16.2477 40.8348 14.6998 39.09 14.6998C36.7072 14.6998 35.4971 17.3546 35.4596 19.6341C35.4596 21.1726 36.0506 22.6454 37.7954 22.6454M104.4 23.152C104.4 24.1557 103.536 24.5591 102.401 24.5591C100.525 24.5591 99.8967 23.621 99.8873 22.3077H93.9868C93.8836 27.2045 98.2551 28.4146 102.139 28.4146C107.101 28.4146 110.319 26.2664 110.385 21.9794C110.385 18.5553 107.467 17.5141 104.597 16.848C102.392 16.3415 101.426 15.9756 101.435 15.1407C101.445 14.3058 102.43 13.9681 103.396 13.9681C104.606 13.9681 105.431 14.3996 105.516 15.5066H111.248C111.182 11.4165 107.495 10.2158 103.743 10.2158C99.1838 10.2158 95.6284 12.2889 95.5721 16.2101C95.5721 19.2964 97.6547 20.4315 100.797 21.2383C102.814 21.773 104.418 21.9418 104.4 23.152ZM148.236 13.2927H148.133C147.878 12.3689 147.314 11.5602 146.536 11.0005C145.758 10.4409 144.812 10.164 143.855 10.2158C141.304 10.2158 139.747 11.4822 138.274 13.3959H138.171L138.715 10.7505H132.748L129.174 27.8424H135.413L137.289 18.621C137.72 16.6135 138.743 15.2064 140.291 15.2064C141.839 15.2064 142.045 16.4446 141.726 17.955L139.662 27.8424H145.9L147.777 18.621C148.208 16.4822 149.231 15.2064 150.778 15.2064C152.326 15.2064 152.533 16.379 152.214 17.955L150.15 27.8424H156.388L158.621 17.6829C159.559 13.3959 158.124 10.1782 154.006 10.1782C152.86 10.1735 151.732 10.4561 150.724 11.0002C149.716 11.5443 148.861 12.3325 148.236 13.2927ZM1.14441 27.8424H7.58906L12.5703 3.87427H6.13503L1.14441 27.8424ZM20.544 10.2439C24.8967 10.2439 29.0525 12.6266 28.9868 18.0206C28.9305 23.9212 24.9155 28.3396 18.7804 28.3396C14.559 28.3396 10.3377 25.9944 10.4127 20.6285C10.5159 14.8687 14.4746 10.2439 20.544 10.2439ZM18.9587 24.1557C21.7073 24.1557 22.711 20.1688 22.711 17.8236C22.711 16.1445 22.1951 14.5028 20.3845 14.5028C17.6641 14.5028 16.7354 18.7242 16.7354 20.9006C16.7354 22.6454 17.2232 24.1557 18.9962 24.1557M14.7185 3.87427L13.7804 8.66789H67.8986L68.8367 3.87427H14.7185ZM58.2457 10.2439C62.5984 10.2439 66.7541 12.6266 66.6885 18.0206C66.6322 23.9212 62.6078 28.3396 56.4727 28.3396C52.2513 28.3396 48.0299 25.9944 48.1144 20.6285C48.2457 14.8687 52.2044 10.2439 58.2457 10.2439ZM56.6885 24.1557C59.4371 24.1557 60.4408 20.1688 60.4408 17.8236C60.4408 16.1445 59.9155 14.5028 58.105 14.5028C55.3939 14.5028 54.4558 18.7242 54.4558 20.9006C54.4558 22.6454 54.9436 24.1557 56.726 24.1557M71.0506 3.87427L70.1125 8.66789H76.3414L77.2795 3.87427H71.0506ZM66.06 27.8424H72.2982L75.8723 10.7505H69.5965L66.06 27.8424ZM85.9661 28.4146C84.9733 28.4851 83.9804 28.2776 83.0988 27.8153C82.2173 27.353 81.482 26.6542 80.9755 25.7974H80.8723L78.9962 34.4465H72.6828L77.7485 10.7505H83.6772L83.2082 13.03C83.8273 12.188 84.6293 11.4973 85.5538 11.0098C86.4783 10.5224 87.5013 10.2509 88.5459 10.2158C92.2982 10.2158 94.5027 13.4334 94.4371 17.6173C94.3526 22.8799 91.6228 28.4146 85.9286 28.4146H85.9661ZM85.7222 15.0563C83.3114 15.0563 81.8292 18.1426 81.7917 20.516C81.7917 22.167 82.3733 24.0056 84.3526 24.0056C86.9324 24.0056 87.9924 20.591 88.0205 18.3114C88.0205 16.7636 87.5703 15.0563 85.7222 15.0563ZM121.792 25.1501H121.895L121.351 27.8612H127.279L130.854 10.7692H124.625L122.636 20.3189C122.233 22.2983 121.013 23.3396 119.475 23.3396C117.936 23.3396 117.598 21.8949 117.908 20.3846L119.925 10.7692H113.696L111.491 21.3227C110.553 25.9193 112.692 28.3959 116.276 28.3959C117.401 28.3849 118.504 28.0774 119.472 27.5042C120.44 26.931 121.241 26.1125 121.792 25.1313V25.1501ZM155.253 34.531L156.191 29.7373H82.2138L81.2757 34.531H155.253Z" fill="white" />
                        <path d="M161.96 15.4409C161.899 15.4362 161.839 15.4193 161.784 15.3912C161.728 15.3632 161.679 15.3245 161.639 15.2774C161.599 15.2303 161.569 15.1758 161.55 15.1169C161.531 15.058 161.524 14.996 161.529 14.9343C161.607 14.0989 161.508 13.2563 161.238 12.4619C160.968 11.6675 160.533 10.939 159.961 10.3244C159.39 9.70973 158.695 9.22271 157.923 8.89521C157.15 8.56772 156.317 8.40714 155.478 8.424C155.354 8.424 155.235 8.37459 155.147 8.28662C155.059 8.19866 155.009 8.07935 155.009 7.95495C155.009 7.83055 155.059 7.71126 155.147 7.6233C155.235 7.53533 155.354 7.48591 155.478 7.48591C155.703 7.50045 155.929 7.50045 156.154 7.48591C157.82 7.3084 159.372 6.55561 160.543 5.35708C161.715 4.15855 162.431 2.58925 162.57 0.919306C162.58 0.801523 162.633 0.691657 162.72 0.611654C162.807 0.531652 162.921 0.487416 163.039 0.487795C163.101 0.49253 163.161 0.509418 163.216 0.537479C163.271 0.56554 163.32 0.604223 163.36 0.651304C163.401 0.698386 163.431 0.752932 163.45 0.811808C163.469 0.870684 163.476 0.93272 163.471 0.994355C163.393 1.82902 163.492 2.67077 163.761 3.46455C164.031 4.25832 164.465 4.98625 165.035 5.60075C165.606 6.21524 166.299 6.70246 167.07 7.03055C167.842 7.35864 168.674 7.5202 169.512 7.50467C169.636 7.50467 169.756 7.5541 169.844 7.64206C169.932 7.73002 169.981 7.84932 169.981 7.97372C169.981 8.09812 169.932 8.21743 169.844 8.30539C169.756 8.39335 169.636 8.44276 169.512 8.44276C167.73 8.4722 166.021 9.15874 164.714 10.3707C163.407 11.5826 162.593 13.2345 162.43 15.0094C162.42 15.1272 162.367 15.2371 162.28 15.3171C162.193 15.3971 162.079 15.4413 161.96 15.4409Z" fill="white" />
                    </g>
                    <defs>
                        <clipPath id="clip0_512_22">

                        </clipPath>
                    </defs>
                </svg>
            </div>
        </div>
        <div class="right-column">
            <div class="content">
                <h1>Welcome to ESTS</h1>
                <div class="card">
                    <div class="header">
                        <span>Log in</span>
                    </div>
                    <div class="body">
                        <form action="" method="POST">
                            <div class="form-control">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required />
                            </div>
                            <div class="form-control">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" required />

                            </div>
                            <div class="form-control">
                                <button type="submit" value="Submit">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="create-account">
                    <p><a href="registre.php" type="Submit" value="Submit">Create an account</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>