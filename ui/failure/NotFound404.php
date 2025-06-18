<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - PawWalk</title>
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
            overflow-x: hidden;
        }

        .container {
            text-align: center;
            max-width: 520px;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.8s ease-out;
            position: relative;
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

        .dog-search-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            background: #64b5f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            position: relative;
            animation: wiggle 3s ease-in-out infinite;
        }

        @keyframes wiggle {
            0%, 100% {
                transform: rotate(0deg);
            }
            25% {
                transform: rotate(-5deg);
            }
            75% {
                transform: rotate(5deg);
            }
        }

        .magnifying-glass {
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 2rem;
            animation: search 2s ease-in-out infinite;
        }

        @keyframes search {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
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

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .bone {
            position: absolute;
            font-size: 1.5rem;
            color: rgba(66, 165, 245, 0.2);
            animation: float 4s ease-in-out infinite;
        }

        .bone:nth-child(1) {
            top: 15%;
            left: 15%;
            animation-delay: 0s;
        }

        .bone:nth-child(2) {
            top: 25%;
            right: 20%;
            animation-delay: 2s;
        }

        .bone:nth-child(3) {
            bottom: 30%;
            left: 20%;
            animation-delay: 1s;
        }

        .bone:nth-child(4) {
            bottom: 20%;
            right: 15%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-15px) rotate(5deg);
            }
        }

        .paw-trail {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.2rem;
            color: rgba(66, 165, 245, 0.3);
            animation: trail 5s linear infinite;
        }

        @keyframes trail {
            0% {
                top: -50px;
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                top: calc(100% + 50px);
                opacity: 0;
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
    <div class="floating-elements">
        <div class="bone">🦴</div>
        <div class="bone">🦴</div>
        <div class="bone">🦴</div>
        <div class="bone">🦴</div>
        <div class="paw-trail">🐾</div>
    </div>
    
    <div class="container">
        <div class="dog-search-icon">
            🐕‍🦺
            <div class="magnifying-glass">🔍</div>
        </div>
        
        <div class="error-code">404</div>
        
        <h1 class="error-title">Oops! Lost Dog Alert</h1>
        
        <p class="error-message">
            It looks like this page went for a walk and didn't come back! 
            Our search and rescue team couldn't find what you're looking for. 
            Let's help you find your way back to safety.
        </p>
        

        
        <div class="action-buttons">
            <a href="./" class="btn btn-primary">Go Home</a>
        </div>
    </div>

    <script>
        function createPawTrail() {
            const trail = document.createElement('div');
            trail.className = 'paw-trail';
            trail.textContent = '🐾';
            trail.style.left = Math.random() * 80 + 10 + '%';
            trail.style.animationDuration = (Math.random() * 3 + 4) + 's';
            
            document.querySelector('.floating-elements').appendChild(trail);
            
            setTimeout(() => {
                trail.remove();
            }, 8000);
        }

        // Create paw trails periodically
        setInterval(createPawTrail, 3000);
    </script>
</body>
</html>