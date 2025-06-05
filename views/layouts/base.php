<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Sistema NIS' ?></title>
    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
            background-color: #f7f7f7;
        }

        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        input[type="text"] {
            padding: 0.5rem;
            width: 100%;
            margin-bottom: 1rem;
        }

        button {
            padding: 0.5rem 1rem;
            background-color: #4caf50;
            border: none;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .mensagem {
            margin-top: 1rem;
            padding: 1rem;
            background: #e0f7e9;
            border-left: 5px solid #4caf50;
        }
        .modal {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.5);
            display: flex; justify-content: center; align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 90%;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1><?= $title ?? 'Sistema NIS' ?></h1>
        <?php include $view ?>
    </div>
</body>
</html>
