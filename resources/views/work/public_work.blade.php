<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Publicar trabajo | AnuarioIDGS</title>
</head>

<body>
    @if ($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div style="color: green">
            {{ session('success') }}
        </div>
    @endif
    <h1>Publicacion de Trabajo</h1>
    <form action="{{ route('guardar.trabajo') }}" method="post">
        @csrf
        {{-- Principio de publicación --}}
        <input type="hidden" name="fk_usuario" value="1">
        <label for="Nombre de empresa">Nombre de la empresa:</label>
        <input type="text" name="nombre_empresa">

        <label for="Correo Electronico">Correo Electronico</label>
        <input type="text" name="correo">

        <label for="Contacto">Telefono de la empresa</label>
        <input type="text" name="telefono">

        {{-- Detalles del trabajo --}}
        <label for="Puesto">Puesto:</label>
        <input type="text" name="puesto">

        <label for="Descripción de puesto">Descripción del puesto:</label>
        <input type="text" name="descripcion">

        <label for="Direccion">Dirección:</label>
        <input type="text" name="direccion">

        <label for="Empleo">Tipo de empleo:</label>
        <input type="text" name="tipo_empleo">

        <label for="Requisito">Requisitos:</label>
        <input type="text" name="requisito">

        <label for="Salario">Salario:</label>
        <input type="number" name="salario" step="0.01" min="0">
        <button type="submit">Publicar</button>
    </form>
</body>

</html>
