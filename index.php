<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Censo</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4e73df;
        }

        label {
            display: block;
            font-size: 13px;
            color: #4e73df;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: -5px;
            margin-left: 2px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            display: block;
            font-family: inherit;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background: #2e59d9;
        }

        .alert {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Formulario de Censo</h2>

    <?php if(isset($_GET['status'])): ?>
        <?php if($_GET['status'] == 'success'): ?>
            <div class="alert success">✅ Registro guardado correctamente.</div>
        <?php elseif($_GET['status'] == 'error'): ?>
            <div class="alert error">❌ <?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>
    <?php endif; ?>

    <form action="guardar.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre completo" required>

        <input type="number" name="edad" placeholder="Edad" min="1" required>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

        <input type="text" name="telefono" placeholder="Teléfono (10 números)" maxlength="10" required>

        <input type="text" name="direccion" placeholder="Dirección de residencia" required>

        <button type="submit">Guardar</button>
    </form>
</div>

</body>
</html>