<?php
$content = contentSettings();
if (isAdminLoggedIn()) {
    redirectTo('/admin');
}
?>

<!-- ============================= -->
<!-- Admin Login Section -->
<!-- ============================= -->

<section class="relative h-screen flex items-center justify-center overflow-hidden px-4 py-20">

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-[460px]">

        <div class="rounded-2xl border bg-white p-10 shadow-lg">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <img src="<?php echo PUBLIC_IMAGES_URL; ?>logo.png" alt="<?php echo sanitize($content['site_owner_name']); ?>" class="h-8 w-auto object-contain">
            </div>

            <!-- Heading -->
            <div class="text-center mb-6 border-t pt-6">
                <h1 class="text-2xl font-semibold text-primary mb-4">
                    Admin Login
                </h1>

                <p class="text-sm text-gray-500 leading-relaxed">
                    Sign in to manage your portfolio website content and settings.
                </p>

            </div>

            <!-- Alerts -->
            <?php include __DIR__ . '/_alerts.php'; ?>

            <!-- Login Form -->
            <form method="POST"
                action="<?php echo appUrl('/admin/login'); ?>"
                class="space-y-5">

                <!-- CSRF -->
                <input type="hidden"
                    name="_token"
                    value="<?php echo csrfToken(); ?>">

                <!-- Username -->
                <div>

                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Username
                    </label>

                    <div class="relative">

                        <input
                            type="text"
                            name="username"
                            required
                            autocomplete="username"
                            autofocus
                            placeholder="Enter username"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3 text-gray-900 outline-none transition duration-300 focus:border-primary focus:bg-white">

                    </div>

                </div>

                <!-- Password -->
                <div>

                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Password
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter password"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-5 py-3 text-gray-900 outline-none transition duration-300 focus:border-primary focus:bg-white">

                    </div>

                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center gap-2 text-gray-500 cursor-pointer">

                        <input type="checkbox"
                            class="rounded border-gray-300 text-primary focus:ring-primary">

                        Remember me

                    </label>

                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="group relative flex w-full items-center justify-center gap-2 overflow-hidden rounded-xl bg-primary px-6 py-4 font-semibold text-white text-sm shadow-lg hover:shadow-xl">

                    Login to Dashboard

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />

                    </svg>

                </button>

            </form>

            <!-- Footer -->
            <div class="mt-6 text-center">

                <p class="text-xs text-gray-400">
                    © <?php echo date('Y'); ?>
                    Synoize Admin Panel. All rights reserved.
                </p>

            </div>

        </div>

    </div>

</section>