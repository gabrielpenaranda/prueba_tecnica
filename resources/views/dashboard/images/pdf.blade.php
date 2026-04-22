<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Datos de Usuario y Compañia</title>
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
    <!-- Foto del Usuario posicionada por coordenadas -->
    @if(isset($userPhoto))
        <div style="position: absolute; left: 50px; top: 125px;">
            <img src="{{ public_path($userPhoto) }}" style="width: 80px; height: 80px; border: 1px solid #ddd;">
        </div>
    @endif

    <!-- Elementos posicionados por coordenadas desde el controlador -->
    @foreach($data as $item)
        <div style="
                            position: absolute; 
                            left: {{ $item['x'] }}px; 
                            top: {{ $item['y'] }}px; 
                            font-size: {{ $item['size'] ?? 12 }}px;
                        ">
            {{ $item['text'] }}
        </div>
    @endforeach


</body>

</html>