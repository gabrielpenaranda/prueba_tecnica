<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User and Company Data</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .image-container {
            margin-bottom: 30px;
        }

        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #eee;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="image-container">
        <img src="{{ public_path($userImage) }}" alt="User Image">
    </div>

    <div class="image-container">
        <img src="{{ public_path($companyImage) }}" alt="Company Image">
    </div>
</body>

</html>