<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory ATK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6f5de7 0%, #5a4fcf 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #6f5de7 0%, #5a4fcf 100%);
            color: #fff;
            padding: 30px;
            text-align: center;
        }
        .login-header i {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .login-header h4 {
            margin: 0;
            font-weight: 600;
        }
        .login-header p {
            margin: 5px 0 0;
            opacity: 0.8;
            font-size: 0.9rem;
        }
        .login-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus {
            border-color: #6f5de7;
            box-shadow: 0 0 0 3px rgba(111, 93, 231, 0.1);
        }
        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px 0 0 8px;
        }
        .btn-login {
            background: linear-gradient(135deg, #6f5de7 0%, #5a4fcf 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(90, 79, 207, 0.4);
            color: #fff;
        }
        .form-check-input:checked {
            background-color: #6f5de7;
            border-color: #6f5de7;
        }
        .demo-accounts {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 0.85rem;
        }
        .demo-accounts h6 {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 10px;
        }
        .demo-accounts table {
            width: 100%;
        }
        .demo-accounts td {
            padding: 3px 0;
        }
        .demo-accounts .role {
            font-weight: 600;
            color: #5a4fcf;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-box-seam"></i>
            <h4>Inventory ATK</h4>
            <p>Sistem Manajemen Inventori</p>
        </div>
        <div class="login-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email') }}" placeholder="Masukkan email" required autofocus>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Masukkan password" required>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>

            <div class="demo-accounts">
                <h6><i class="bi bi-info-circle me-1"></i>Demo Accounts:</h6>
                <table>
                    <tr>
                        <td class="role">Admin:</td>
                        <td>admin@atk.com / password</td>
                    </tr>
                    <tr>
                        <td class="role">Staf Gudang:</td>
                        <td>gudang@atk.com / password</td>
                    </tr>
                    <tr>
                        <td class="role">Kasir:</td>
                        <td>kasir@atk.com / password</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
