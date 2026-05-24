<?php
if (isAdminLoggedIn()) {
    redirectTo('/admin');
}
?>

<section class="flex min-h-[70vh] items-center justify-center bg-gray-100 px-4 py-16">
    <div class="w-full max-w-[440px] rounded-lg border border-gray-200 bg-white p-8 shadow-lg">
        <p class="mb-[0.35rem] text-xs font-bold uppercase tracking-[0.08em] text-primary">Website Manager</p>
        <h1 class="mb-3 text-2xl font-bold text-gray-900">Admin Login</h1>
        <p class="text-gray-500">Sign in to manage projects, services, works, skills, and contact messages.</p>

        <?php include __DIR__ . '/_alerts.php'; ?>

        <form method="POST" action="<?php echo appUrl('/admin/login'); ?>" class="grid gap-4 [&_input]:w-full [&_input]:rounded-lg [&_input]:border [&_input]:border-gray-300 [&_input]:px-4 [&_input]:py-2 [&_input]:transition [&_input]:focus:border-primary [&_input]:focus:outline-none [&_label_span]:mb-[0.35rem] [&_label_span]:block [&_label_span]:font-semibold [&_label_span]:text-gray-700">
            <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">

            <label>
                <span>Username</span>
                <input type="text" name="username" required autocomplete="username" autofocus>
            </label>

            <label>
                <span>Password</span>
                <input type="password" name="password" required autocomplete="current-password">
            </label>

            <button type="submit" class="rounded-lg bg-primary px-4 py-[0.8rem] font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-primary-600">Login</button>
        </form>
    </div>
</section>
