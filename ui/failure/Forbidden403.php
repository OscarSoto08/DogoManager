<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - PawWalk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #f8fbff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2c3e50;
        }

        .container {
            text-align: center;
            max-width: 500px;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dog-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            background: #64b5f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .error-code {
            font-size: 5rem;
            font-weight: 300;
            color: #42a5f5;
            margin-bottom: 1rem;
            letter-spacing: -2px;
        }

        .error-title {
            font-size: 2rem;
            font-weight: 600;
            color: #1976d2;
            margin-bottom: 1rem;
        }

        .error-message {
            font-size: 1.1rem;
            color: #546e7a;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #42a5f5;
            color: white;
        }

        .btn-primary:hover {
            background: #1976d2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66, 165, 245, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #42a5f5;
            border: 2px solid #42a5f5;
        }

        .btn-secondary:hover {
            background: #42a5f5;
            color: white;
            transform: translateY(-2px);
        }

        .paw-prints {
            position: absolute;
            top: 20%;
            left: 10%;
            opacity: 0.1;
            font-size: 2rem;
            color: #42a5f5;
            animation: float 3s ease-in-out infinite;
        }

        .paw-prints:nth-child(2) {
            top: 70%;
            right: 10%;
            left: auto;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @media (max-width: 600px) {
            .container {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            .error-code {
                font-size: 4rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="paw-prints">🐾</div>
    <div class="paw-prints">🐾</div>
    
    <div class="container">
        <div class="dog-icon">
            🐕
        </div>
        
        <div class="error-code">403</div>
        
        <h1 class="error-title">Woof! Access Denied</h1>
        
        <p class="error-message">
            Sorry, but you don't have permission to access this area. 
            It looks like this park is off-limits for now. 
            Please check your credentials or contact your pack leader for access.
        </p>
        
        <div class="action-buttons">
            <a href="./" class="btn btn-primary">Go Home</a>
        </div>
    </div>

    <script>
        // Add some interactive elements
        document.querySelector('.dog-icon').addEventListener('click', function() {
            this.style.animation = 'none';
            setTimeout(() => {
                this.style.animation = 'bounce 2s infinite';
            }, 100);
        });

        // Add paw print click effect
        document.querySelectorAll('.paw-prints').forEach(paw => {
            paw.addEventListener('click', function() {
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        });
    </script>
</body>
</html>