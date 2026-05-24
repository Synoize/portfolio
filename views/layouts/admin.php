<?php
$page = isset($currentPage) ? $currentPage : 'admin/login';
$pagePath = __DIR__ . '/../pages/' . $page . '.php';

ob_start();
if (file_exists($pagePath)) {
    include $pagePath;
} else {
    echo '<div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg"><h1 class="text-3xl font-bold">Page Not Found</h1></div>';
}
$adminContent = ob_get_clean();
$isAdminLogin = $page === 'admin/login';

if (!$isAdminLogin) {
    requireAdmin();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Admin Panel'; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Portfolio admin panel'; ?>">
    <link rel="icon" type="image/png" href="<?php echo PUBLIC_IMAGES_URL; ?>favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
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
                    },
                },
            },
        };
    </script>
</head>

<body class="h-screen font-sans text-gray-900">
    <?php if ($isAdminLogin): ?>
        <main>
            <?php echo $adminContent; ?>
        </main>
    <?php else: ?>
        <div class="h-screen lg:grid lg:grid-cols-[300px_minmax(0,1fr)]">
            <?php include __DIR__ . '/../pages/admin/_nav.php'; ?>

            <div class="min-w-0">
                <header class="flex h-[88px] flex-col justify-center gap-4 bg-gray-400 px-6 py-6 text-white sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="mb-2 text-[11px] uppercase tracking-[0.18em] text-primary-600">Admin Panel</p>
                        <h1 class="text-2xl font-semibold leading-tight"><?php echo sanitize($adminTitle ?? $pageTitle ?? 'Dashboard'); ?></h1>
                    </div>

                    <div class="flex items-center gap-3 text-sm text-green-400">
                        <i data-lucide="shield-check" class="h-5 w-5"></i>
                        <span><?php echo sanitize($_SESSION['admin_user']['name'] ?? 'Website Admin'); ?></span>
                    </div>
                </header>

                <main class="h-[calc(100vh-100px)] overflow-auto px-4 py-6 sm:px-6 lg:px-10">
                    <?php include __DIR__ . '/../pages/admin/_alerts.php'; ?>
                    <?php echo $adminContent; ?>
                </main>
            </div>
        </div>
    <?php endif; ?>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
