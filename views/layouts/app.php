<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Shivam Singh - Portfolio'; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Web & Android Developer | Cyber Enthusiast from Bihar, India'; ?>">
    <link rel="icon" type="image/png" href="<?php echo PUBLIC_IMAGES_URL; ?>favicon.ico">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fugaz+One&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#F47A3C',
                            50: '#FFF4EE',
                            100: '#FFE6D6',
                            200: '#FFC7A8',
                            300: '#FFA06F',
                            400: '#F47A3C',
                            500: '#D64A0B',
                            600: '#B63E08',
                            700: '#8F3006',
                            800: '#682204',
                            900: '#3D1201',
                        },
                    },

                    fontFamily: {
                        sans: ['Open Sans'],
                        playfair: ['Playfair Display'],
                    },

                    keyframes: {

                        // Smooth Pop Animation
                        pop: {
                            '0%': {
                                transform: 'scale(0.75)',
                                opacity: '0',
                                filter: 'blur(6px)',
                            },
                            '60%': {
                                transform: 'scale(1.06)',
                                opacity: '1',
                                filter: 'blur(0px)',
                            },
                            '100%': {
                                transform: 'scale(1)',
                                opacity: '1',
                                filter: 'blur(0px)',
                            },
                        },

                        // Floating Animation
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)',
                            },
                            '50%': {
                                transform: 'translateY(-14px)',
                            },
                        },

                        // Slide From Left
                        slideLeft: {
                            '0%': {
                                transform: 'translateX(-120px) scale(0.95)',
                                opacity: '0',
                                filter: 'blur(4px)',
                            },
                            '100%': {
                                transform: 'translateX(0) scale(1)',
                                opacity: '1',
                                filter: 'blur(0px)',
                            },
                        },

                        // Slide From Right
                        slideRight: {
                            '0%': {
                                transform: 'translateX(120px) scale(0.95)',
                                opacity: '0',
                                filter: 'blur(4px)',
                            },
                            '100%': {
                                transform: 'translateX(0) scale(1)',
                                opacity: '1',
                                filter: 'blur(0px)',
                            },
                        },

                        // Slide From Top
                        slideTop: {
                            '0%': {
                                transform: 'translateY(-120px) scale(0.95)',
                                opacity: '0',
                                filter: 'blur(4px)',
                            },
                            '100%': {
                                transform: 'translateY(0) scale(1)',
                                opacity: '1',
                                filter: 'blur(0px)',
                            },
                        },

                        // Slide From Bottom
                        slideBottom: {
                            '0%': {
                                transform: 'translateY(120px) scale(0.95)',
                                opacity: '0',
                                filter: 'blur(4px)',
                            },
                            '100%': {
                                transform: 'translateY(0) scale(1)',
                                opacity: '1',
                                filter: 'blur(0px)',
                            },
                        },

                        // Fade In Smooth
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                            },
                            '100%': {
                                opacity: '1',
                            },
                        },

                        // Rotate Soft
                        rotateSoft: {
                            '0%': {
                                transform: 'rotate(-8deg) scale(0.95)',
                                opacity: '0',
                            },
                            '100%': {
                                transform: 'rotate(0deg) scale(1)',
                                opacity: '1',
                            },
                        },

                        // Pulse Glow
                        pulseGlow: {
                            '0%, 100%': {
                                boxShadow: '0 0 0px rgba(255,255,255,0)',
                            },
                            '50%': {
                                boxShadow: '0 0 25px rgba(255,255,255,0.35)',
                            },
                        },
                    },

                    animation: {

                        // Main Animations
                        pop: 'pop 0.9s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                        float: 'float 4s ease-in-out infinite',

                        // Sliding Animations
                        'slide-left': 'slideLeft 0.9s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                        'slide-right': 'slideRight 0.9s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                        'slide-top': 'slideTop 0.9s cubic-bezier(0.22, 1, 0.36, 1) forwards',
                        'slide-bottom': 'slideBottom 0.9s cubic-bezier(0.22, 1, 0.36, 1) forwards',

                        // Extra Premium Animations
                        fade: 'fadeIn 1s ease forwards',
                        rotate: 'rotateSoft 1s ease-out forwards',
                        glow: 'pulseGlow 3s ease-in-out infinite',

                        // Combined Animation
                        'hero-image': 'pop 1s ease-out forwards, float 4s ease-in-out infinite',
                    },

                }
            }
        }
    </script>
</head>

<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main>
        <!-- Background Blur -->
        <div class="fixed top-0 left-0 md:w-72 md:h-72 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="fixed bottom-0 right-0 md:w-72 md:h-72 w-60 h-60 bg-accent/10 rounded-full blur-3xl"></div>

        <?php
        // Include the appropriate page
        $page = isset($currentPage) ? $currentPage : 'landing';
        $pagePath = __DIR__ . '/../pages/' . $page . '.php';

        if (file_exists($pagePath)) {
            include $pagePath;
        } else {
            echo '<div class="container mx-auto px-4 py-20"><h1 class="text-4xl font-bold">Page Not Found</h1></div>';
        }
        ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>

    <script src="<?php echo PUBLIC_JS_URL; ?>script.js"></script>
    <script>
        // lucide icons initialization;
        lucide.createIcons();
    </script>
</body>

</html>
