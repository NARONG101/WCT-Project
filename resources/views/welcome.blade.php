<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        header {
            text-align: center;
            padding: 20px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .logo-icon {
            width: 50px;
            height: 50px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
        }
        
        .logo-text {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            letter-spacing: -0.5px;
        }
        
        .tagline {
            font-size: 18px;
            color: #64748b;
            max-width: 500px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }
        
        .content {
            display: flex;
            gap: 40px;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        
        .welcome-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .welcome-heading {
            font-size: 36px;
            color: #1e293b;
            margin-bottom: 15px;
            line-height: 1.2;
        }
        
        .welcome-heading span {
            color: #2563eb;
        }
        
        .welcome-text {
            color: #64748b;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .auth-buttons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .btn {
            padding: 14px 30px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-login {
            background: #f1f5f9;
            color: #1e293b;
            border: 2px solid #e2e8f0;
        }
        
        .btn-login:hover {
            background: #e2e8f0;
        }
        
        .btn-register {
            background: #2563eb;
            color: white;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
        
        .btn-register:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }
        
        .preview-section {
            flex: 1;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            padding: 30px;
            border-left: 1px solid #f1f5f9;
        }
        
        .preview-title {
            font-size: 20px;
            color: #1e293b;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .dashboard-preview {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .stock-card {
            display: flex;
            align-items: center;
            padding: 15px;
            border-radius: 10px;
            background: #f8fafc;
            transition: all 0.3s ease;
        }
        
        .stock-card:hover {
            transform: translateX(5px);
            background: #f1f5f9;
        }
        
        .stock-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #2563eb;
            margin-right: 15px;
        }
        
        .stock-info {
            flex: 1;
        }
        
        .stock-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 3px;
        }
        
        .stock-symbol {
            font-size: 13px;
            color: #64748b;
        }
        
        .stock-price {
            font-weight: 700;
            font-size: 18px;
        }
        
        .price-up {
            color: #10b981;
        }
        
        .price-down {
            color: #ef4444;
        }
        
        .features {
            display: flex;
            gap: 20px;
            text-align: center;
        }
        
        .feature {
            flex: 1;
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }
        
        .feature i {
            font-size: 32px;
            color: #2563eb;
            margin-bottom: 15px;
        }
        
        .feature h3 {
            color: #1e293b;
            margin-bottom: 10px;
        }
        
        .feature p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.5;
        }
        
        footer {
            text-align: center;
            padding: 20px 0;
            color: #94a3b8;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
            }
            
            .preview-section {
                border-left: none;
                border-top: 1px solid #f1f5f9;
            }
            
            .features {
                flex-direction: column;
            }
            
            .auth-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <div class="logo-icon">$</div>
                <div class="logo-text">StockDash</div>
            </div>
            <p class="tagline">Track your investments and monitor market trends with our intuitive stock dashboard</p>
        </header>
        
        <div class="content">
            <div class="welcome-section">
                <h1 class="welcome-heading">Welcome to <span>Stock Dashboard</span></h1>
                <p class="welcome-text">Access real-time market data, track your portfolio performance, and make informed investment decisions. Sign in or create an account to get started.</p>
                
                <div class="auth-buttons">
                    <a href="{{route('login')}}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt"></i> Log in
                    </a>
                </div>
            </div>
            
            <div class="preview-section">
                <h3 class="preview-title">Dashboard Preview</h3>
                <div class="dashboard-preview">
                    <div class="stock-card">
                        <div class="stock-icon">A</div>
                        <div class="stock-info">
                            <div class="stock-name">Apple Inc.</div>
                            <div class="stock-symbol">NASDAQ: AAPL</div>
                        </div>
                        <div class="stock-price price-up">$172.35</div>
                    </div>
                    
                    <div class="stock-card">
                        <div class="stock-icon">M</div>
                        <div class="stock-info">
                            <div class="stock-name">Microsoft</div>
                            <div class="stock-symbol">NASDAQ: MSFT</div>
                        </div>
                        <div class="stock-price price-up">$328.79</div>
                    </div>
                    
                    <div class="stock-card">
                        <div class="stock-icon">T</div>
                        <div class="stock-info">
                            <div class="stock-name">Tesla</div>
                            <div class="stock-symbol">NASDAQ: TSLA</div>
                        </div>
                        <div class="stock-price price-down">$245.18</div>
                    </div>
                    
                    <div class="stock-card">
                        <div class="stock-icon">G</div>
                        <div class="stock-info">
                            <div class="stock-name">Google</div>
                            <div class="stock-symbol">NASDAQ: GOOGL</div>
                        </div>
                        <div class="stock-price price-up">$129.45</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="features">
            <div class="feature">
                <i class="fas fa-chart-line"></i>
                <h3>Real-time Data</h3>
                <p>Access up-to-the-minute stock prices and market trends</p>
            </div>
            
            <div class="feature">
                <i class="fas fa-wallet"></i>
                <h3>Portfolio Tracking</h3>
                <p>Monitor all your investments in one centralized dashboard</p>
            </div>
            
            <div class="feature">
                <i class="fas fa-bell"></i>
                <h3>Smart Alerts</h3>
                <p>Get notified about significant price movements</p>
            </div>
        </div>
        
        <footer>
            <p>&copy; 2023 Stock Dashboard. All market data is for demonstration purposes only.</p>
        </footer>
    </div>
</body>
</html>