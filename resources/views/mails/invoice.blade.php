<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF POR EMAIL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            text-align: center;
        }

        h1 {
            color: #1f2937;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
            color: #555;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #1f2937;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #334f76;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de Socios</h1>
        <p>Este es el reporte de socios enviado por correo electrónico. Haz clic en el siguiente enlace para obtener el PDF:</p>
        <a href="{{ $pdfUrl }}" target="_blank">Ver PDF</a>
        <div class="footer">
            <p>Diego Ivan Cisneros Adame TIDSM TN 6°A</p>
        </div>
    </div>
</body>
</html>
