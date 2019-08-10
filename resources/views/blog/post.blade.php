<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title></title>
    <style>
        p {
            font-family: 'Times New Roman', Times, serif;
            font-size:20px;
        }
        img {
            width:80%;
            margin-left:10%
        }

    </style>
</head>
<body>
    <div class="container">
    <p>Salam</p>
{!! $post->content_html !!}
</div>
</body>
</html>
