<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #222;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        h1 {
            color: #e63946;
            margin-bottom: 16px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 24px;
        }
        a {
            background: #457b9d;
            color: #fff;
            padding: 10px 24px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        a:hover {
            background: #1d3557;
        }
    </style>
</head>
<body>
    <h1 class="logo">السوق</h1>
    <h1>هل تبحث على شئ ما</h1>
    <p>نعتذر. عنوان صفحة الإنترنت الذي أدخلته ليس لصفحة على موقعنا
</p>
    <a href="{{route('index')}}">العودة للصفحة الرئيسية</a>
</body>
</html>