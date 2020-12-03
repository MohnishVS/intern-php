<html>

<head>
    <title>User Login</title>
</head>

<body>

    <?php
        $jwt = "";
        $username = $_COOKIE['username'];
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(['user_id' => $username]);
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwtchk = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        $jwt = $_COOKIE['jwt'];
        if (!empty($jwt) && !empty($username) && ($jwt == $jwtchk)) {
    ?>
        <h1>Welcome <?php echo $username; ?> Logged in using Token. Click here to <a href="logout2.php" tite="Logout">Logout.</h1>
    <?php
        } else echo "<h1>Please login first .</h1><a href='login2.php'>Login";
    ?>
</body>

</html>