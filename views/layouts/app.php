<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? sanitize($pageTitle) : sanitize(getSiteSetting('site_name', SITE_NAME)); ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? sanitize($pageDescription) : sanitize(getSiteSetting('site_description', SITE_DESCRIPTION)); ?>">
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

    <!-- LEFT: Instagram -->
    <a href="https://instagram.com/synoize" target="_blank" class="fixed bottom-6 left-6 z-50 
          w-12 h-12 flex items-center justify-center 
          rounded-xl shadow-lg 
          bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 
          hover:scale-110 transition duration-300 animate-float">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
            class="w-12 h-12 rounded-xl shadow-lg hover:scale-110 transition" />
    </a>

    <!-- RIGHT: WhatsApp -->
    <a href="https://wa.me/916205163577" target="_blank" class="fixed bottom-6 right-6 z-50 
          w-12 h-12 flex items-center justify-center 
          rounded-full shadow-lg 
          bg-green-500 hover:bg-green-600 
          hover:scale-110 transition duration-300 animate-float">

        <!-- Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20 3.5A11.9 11.9 0 0012.1 0C5.6 0 .3 5.3.3 
             11.8c0 2.1.5 4.1 1.5 5.9L0 24l6.5-1.7c1.7.9 
             3.7 1.4 5.6 1.4 6.5 0 11.8-5.3 
             11.8-11.8 0-3.1-1.2-6-3.9-8.4zM12.1 
             21c-1.7 0-3.3-.4-4.8-1.2l-.3-.2-3.9 
             1 1-3.8-.2-.3c-1-1.5-1.5-3.2-1.5-4.9 
             0-5.4 4.4-9.8 9.8-9.8 2.6 0 5.1 1 
             6.9 2.9 1.8 1.8 2.9 4.3 2.9 
             6.9 0 5.4-4.4 9.8-9.8 
             9.8zm5.4-7.3c-.3-.1-1.7-.8-2-1-.3-.1-.5-.1-.7.1-.2.3-.8 
             1-.9 1.1-.2.2-.3.2-.6.1-.3-.1-1.3-.5-2.5-1.6-.9-.8-1.6-1.8-1.8-2.1-.2-.3 
             0-.5.1-.6.1-.1.3-.3.4-.4.1-.2.2-.3.3-.5.1-.2 
             0-.4 0-.6 0-.1-.7-1.6-1-2.2-.2-.5-.5-.4-.7-.4h-.6c-.2 
             0-.6.1-.9.4-.3.3-1.2 1.2-1.2 
             2.8s1.2 3.2 1.4 3.4c.2.3 
             2.4 3.6 5.9 5 .8.3 1.4.5 
             1.9.6.8.2 1.6.2 2.2.1.7-.1 
             1.7-.7 2-1.4.2-.7.2-1.3.1-1.4-.1-.1-.3-.2-.6-.3z" />
        </svg>
    </a>

    <?php include __DIR__ . '/footer.php'; ?>

    <script src="<?php echo PUBLIC_JS_URL; ?>script.js"></script>
    <script>
        // lucide icons initialization;
        lucide.createIcons();
    </script>
</body>

</html>