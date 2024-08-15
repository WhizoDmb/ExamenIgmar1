
    <div class="container mt-4">
        <h2>Detalles de la Evaluación</h2>

        <h3>Evaluación ID: {{ $data->id }}</h3>
        <p><strong>Usuario:</strong> {{ $data->user->name }}</p>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th colspan="3">Operacion</th>
                    <th>Respuesta Correcta</th>
                    <th>Tu respuesta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->operaciones as $operacion)
                    <tr>
                        <td>{{ $operacion->op1 }}</td>
                        <td>{{ $operacion->tipo }}</td>
                        <td>{{ $operacion->op2 }}</td>
                        <td><center>{{ $operacion->respuesta_correcta }}</center></td>
                        <td><center>{{ $operacion->respuesta_usuario }}</center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
