<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Evaluación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
        h2 {
            font-size: 24px;
        }
        h3 {
            font-size: 20px;
        }
        p {
            margin: 10px 0;
            font-size: 16px;
        }
        .info-section {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: #ffffff;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }
        .icon {
            font-size: 18px;
        }
        .checkmark {
  width: 24px;
  height: 24px;
  display: inline-block;
  position: relative;
  border-radius: 50%;
  background-color: green;
}

.checkmark:before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 6px;
  height: 12px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform-origin: center;
  transform: translate(-50%, -60%) rotate(45deg);
}

        .crossmark {
  width: 24px;
  height: 24px;
  display: inline-block;
  position: relative;
  border-radius: 50%;
  background-color: red;
}

.crossmark:before, .crossmark:after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 14px;
  height: 2px;
  background-color: white;
  transform-origin: center;
}

.crossmark:before {
  transform: translate(-50%, -50%) rotate(45deg);
}

.crossmark:after {
  transform: translate(-50%, -50%) rotate(-45deg);
}

    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Detalles de la Evaluación</h2>

        <h3>FOLIO DE LA EVALUACIÓN: {{ $data->id }}</h3>
        <p><strong>Usuario:</strong> {{ $data->user->name }}</p>

        <div class="info-section">
            <p><strong>Número de Aciertos:</strong> {{ $aciertos }}</p>
            <p><strong>Calificación:</strong> {{ number_format($calificacion, 2) }}%</p>
        </div>

        <table class="table mt-4 table-striped">
            <thead class="thead-dark">
                <tr>
                    <th colspan="3">Operación</th>
                    <th>Respuesta Correcta</th>
                    <th>Tu respuesta</th>
                    <th>Correcta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->operaciones as $operacion)
                    <tr>
                        <td>{{ $operacion->op1 }}</td>
                        <td>{{ $operacion->tipo }}</td>
                        <td>{{ $operacion->op2 }}</td>
                        <td>{{ $operacion->respuesta_correcta }}</td>
                        <td>{{ $operacion->respuesta_usuario }}</td>
                        <td class="icon">
                            @if($operacion->estatus)
                            <div class="checkmark"></div>

                            @else
                            <div class="crossmark"></div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
