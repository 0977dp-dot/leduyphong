<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Quyền truy cập bị từ chối</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #f59e0b; /* Amber/Orange */
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            --card-bg: rgba(30, 41, 59, 0.7);
            --card-border: rgba(245, 158, 11, 0.2);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }
        /* Background decor */
        .decor-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: 1;
            opacity: 0.3;
        }
        .decor-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            left: -100px;
        }
        .decor-2 {
            width: 300px;
            height: 300px;
            background: #ef4444;
            bottom: -50px;
            right: -50px;
        }
        .error-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 50px 40px;
            text-align: center;
            max-width: 500px;
            width: 100%;
            z-index: 10;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            animation: fadeInUp 0.8s ease-out;
        }
        .icon-container {
            width: 100px;
            height: 100px;
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            color: var(--primary);
            font-size: 48px;
            animation: pulse 2s infinite;
        }
        .error-code {
            font-size: 80px;
            font-weight: 800;
            margin: 0;
            line-height: 1;
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -2px;
        }
        .error-title {
            font-size: 24px;
            font-weight: 700;
            margin: 20px 0 10px;
        }
        .error-desc {
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 35px;
        }
        .btn-home {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #0f172a;
            font-weight: 600;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 25px rgba(245, 158, 11, 0.3);
            filter: brightness(1.1);
        }
        .btn-home:active {
            transform: translateY(0);
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 20px 10px rgba(245, 158, 11, 0);
            }
        }
    </style>
</head>
<body>
    <div class="decor-circle decor-1"></div>
    <div class="decor-circle decor-2"></div>
    <div class="error-card">
        <div class="icon-container">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <h1 class="error-code">403</h1>
        <h2 class="error-title">Truy cập bị cấm</h2>
        <p class="error-desc">
            {{ $exception->getMessage() ?: 'Bạn không có quyền truy cập vào trang này.' }}
        </p>
        <a href="{{ url('/') }}" class="btn-home">
            <i class="bi bi-arrow-left"></i> Quay lại trang chủ
        </a>
    </div>
</body>
</html>