<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ICT - Future in Demand</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background: black;
            color: white;
            text-align: center;
            overflow-x: hidden; /* Prevent horizontal scrolling */
            min-height: 100vh; /* Ensure body is at least the height of the viewport */
        }

        .stars, .asteroids {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .star, .asteroid {
            position: absolute;
            border-radius: 50%;
        }

        .star {
            width: 8px;
            height: 8px;
            background: white;
            animation: twinkling 2s infinite alternate, moveStars 5s linear infinite;
        }

        .asteroid {
            width: 16px;
            height: 16px;
            background: red;
            animation: moveAsteroids 10s linear infinite;
        }

        @keyframes twinkling {
            from { opacity: 0.5; }
            to { opacity: 1; }
        }

        @keyframes moveStars {
            from { transform: translateY(0); }
            to { transform: translateY(-1000px); }
        }

        @keyframes moveAsteroids {
            from { transform: translate(0, 0); }
            to { transform: translate(100vw, 100vh); }
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(9, 2, 46, 0.7);
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            padding: 20px;
            margin: 0 auto;
            max-width: 800px;
        }

        .content h1 {
            font-size: 3em;
            margin-bottom: 0.5em;
        }

        .content p {
            font-size: 1.2em;
            margin-bottom: 1em;
        }

        .content a {
            margin: 0 10px;
            padding: 10px 20px;
            color: rgb(0, 0, 0);
            background: #f8c301;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .content a:hover {
            background: #FF5722;
        }

        .section {
            background: #449284;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: left;
        }

        .nav-wrapper {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 3;
            background-color: rgba(0, 0, 0, 0.5); /* Slightly transparent background */
            padding: 10px 0;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            padding: 0 20px;
        }

        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: 600;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .fw-bold {
            font-weight: 1000px !important;
        }
    </style>
</head>
<body>
    <div class="stars"></div>
    <div class="asteroids"></div>
    <div class="overlay"></div>

    @if (Route::has('login'))
        <div class="nav-wrapper">
            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        </div>
    @endif

    <div class="content">
        <h1 class="fw-bold" style="color: #f8c301;">ICT - Future in Demand</h1>
        <p class="fw-bold">Discover why Information and Communication Technology (ICT) is essential in today's world and will be even more crucial in the future.</p>
        <a class="fw-bold" href="#why-ict">Why ICT?</a>
        <a class="fw-bold" href="#our-classes">Our Classes</a>

        <div id="why-ict" class="section fw-bold">
            <h2 style="color: #f8c301">Why ICT?</h2>
            <p>ICT is the backbone of modern technology. From smartphones to smart homes, ICT is everywhere. It enables efficient communication, data management, and technological innovation.</p>
            <p>In the future, ICT will drive advancements in artificial intelligence, cybersecurity, and global connectivity. As the digital world expands, the demand for ICT professionals will continue to grow.</p>
        </div>

        <div id="our-classes" class="section fw-bold">
            <h2 style="color: #f8c301">Our Classes</h2>
            <p>We offer a wide range of ICT courses tailored to meet the demands of the industry. Our classes are designed to equip you with the skills needed to excel in various ICT fields.</p>
            <p>Join us to learn from experts and gain hands-on experience in the latest technologies.</p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Create stars
            const numStars = 100;
            for (let i = 0; i < numStars; i++) {
                const star = $('<div class="star"></div>');
                star.css({
                    top: `${Math.random() * 100}vh`,
                    left: `${Math.random() * 100}vw`,
                    animationDuration: `${Math.random() * 2 + 2}s, ${Math.random() * 50 + 50}s`,
                    animationDelay: `${Math.random() * 50}s`
                });
                $('.stars').append(star);
            }

            // Create asteroids
            const numAsteroids = 10;
            for (let i = 0; i < numAsteroids; i++) {
                const asteroid = $('<div class="asteroid"></div>');
                asteroid.css({
                    top: `${Math.random() * 100}vh`,
                    left: `${Math.random() * 100}vw`,
                    animationDuration: `${Math.random() * 30 + 20}s`,
                    animationDelay: `${Math.random() * 20}s`
                });
                $('.asteroids').append(asteroid);
            }

            // Smooth scroll for links
            $('a[href^="#"]').on('click', function(event) {
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top
                    }, 1000);
                }
            });
        });
    </script>
</body>
</html>
