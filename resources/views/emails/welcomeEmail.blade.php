<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Dear {{ $content['name'] }}</p>
    <p>{{ $content['body'] }}</p>

    <p> Let's finish meshwarna! </p>

    Please use this link to reset your password, click on reset password on the login page and follow the instructions: <br>

    <a href="{{ $content['url']  }}">Talent Nest</a>
    <br><br>
    <p>Kind Regards,<br>
    talentnest.qa team </p>

</body>

</html>