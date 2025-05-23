<?php
session_start();
// VERIFICA SE HÁ COOKIE DE NAVEGAÇÃO DOS ACESSOS
$email = isset($_COOKIE["email"]) ? $_COOKIE["email"] : "";
$password = isset($_COOKIE["password"]) ? $_COOKIE["password"] : "";
$remember = isset($_COOKIE["remember"]) ? "checked" : "";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #23272b;
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            color: #f5f5f5;
            padding-top: 60px;
        }
        .login-card {
            background: #2c2f34;
            border-radius: 8px;
            box-shadow: 0 6px 32px #0008;
            padding: 2.5rem 2.5rem;
            width: 100%;
            max-width: 480px;
            color:rgb(209, 206, 206);
        }
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.7rem;
            text-align: center;
            color: #fff;
        }
        .form-control {
            background: #34373b;
            color: #f5f5f5;
            border: 1px solid #b0b0b0;
            border-radius: 8px;
            font-size: 1.05rem;
        }
        .form-control:focus {
            background: #23272b;
            color: #fff;
            box-shadow: 0 0 0 2px #b0b0b055;
        }
        .btn-primary {
            background-color: #b0b0b0;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.15rem;
            margin-top: 1rem;
            transition: background 0.2s;
            color: #23272b;
        }
        .btn-primary:hover {
            background-color: #e0e0e0;
            color: #23272b;
        }
        .form-check-label {
            color: #f5f5f5;
        }
        ::placeholder { color: #e0e0e0 !important; }
    </style>
</head>
<body>
    <?php include "mensagens.php"; ?>
    <div class="login-card">
        <div class="login-title">Login</div>
        <form method="post" action="validar-login.php" autocomplete="on">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input value="<?php echo $email; ?>" type="email" class="form-control" id="email" name="email" placeholder="Enter email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input value="<?php echo $password; ?>" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input <?php echo $remember; ?> type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
    </div>
</body>
</html>
