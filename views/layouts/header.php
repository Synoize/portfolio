<?php
$content = contentSettings();
$navItems = [
    ['path' => '/', 'label' => 'HOME'],
    ['path' => '/about', 'label' => 'ABOUT ME'],
    ['path' => '/services', 'label' => 'SERVICES'],
    ['path' => '/my-work', 'label' => 'MY WORKS'],
    ['path' => '/projects', 'label' => 'PROJECTS'],
];
?>

<header class="bg-white sm:bg-transparent sticky top-0 z-50 md:border-b-0 border-t-2 border-t-primary">
    <nav class="mx-auto max-w-7xl px-4 py-5">
        <div class="flex items-center justify-between">
            <a href="<?php echo appUrl('/'); ?>" class="inline-flex items-center">
                <img src="<?php echo PUBLIC_IMAGES_URL; ?>logo.png" alt="<?php echo sanitize($content['site_owner_name']); ?>" class="h-8 w-auto object-contain">
            </a>

            <div class="hidden h-14 items-center space-x-10 rounded-full border bg-white/80 px-10 text-sm backdrop-blur-md lg:flex">
                <?php foreach ($navItems as $item): ?>
                    <a href="<?php echo appUrl($item['path']); ?>" class="relative font-medium transition <?php echo isActive($item['path']) ? 'text-primary' : 'text-gray-700 hover:text-black'; ?>">
                        <?php echo $item['label']; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="hidden lg:block">
                <a href="<?php echo appUrl('/contact'); ?>"
                    class="group flex h-12 items-center gap-3 border border-primary rounded-full px-8 text-xs transition duration-300 <?php echo isActive('/contact') ? 'bg-primary text-white' : 'hover:bg-primary text-primary hover:text-white'; ?>">
                    <?php echo sanitize($content['primary_cta_label']); ?>
                    <i data-lucide="arrow-right"
                        class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1">
                    </i>
                </a>
            </div>

            <button id="menuBtn" class="text-gray-800 focus:outline-none lg:hidden" aria-label="Open menu">
                <i data-lucide="menu"
                    class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90">
                </i>
            </button>
        </div>
    </nav>

    <div id="overlay" class="invisible fixed inset-0 z-40 bg-black/40 opacity-0 transition-all duration-300"></div>

    <div id="mobileSidebar"
        class="fixed right-[-100%] top-0 z-50 flex h-full w-[280px] flex-col bg-white shadow-2xl transition-all duration-500">

        <!-- HEADER -->
        <div class="flex items-center justify-between border-b px-6 py-5">
            <a href="<?php echo appUrl('/'); ?>" class="inline-flex items-center">
                <img src="<?php echo PUBLIC_IMAGES_URL; ?>logo.png" alt="<?php echo sanitize($content['site_owner_name']); ?>" class="h-8 w-auto object-contain">
            </a>

            <button id="closeBtn"
                class="flex h-10 w-10 items-center justify-center rounded-full transition hover:bg-gray-100"
                aria-label="Close menu">

                <i data-lucide="x" class="h-5 w-5 text-black"></i>
            </button>
        </div>

        <!-- NAV LINKS -->
        <div class="flex flex-1 flex-col space-y-1 p-3 font-medium text-gray-700">
            <?php foreach ($navItems as $item): ?>
                <a href="<?php echo appUrl($item['path']); ?>"
                    class="group flex items-center justify-between rounded-xl p-3 text-sm transition-all duration-300
                <?php echo isActive($item['path'])
                    ? 'bg-primary/10 text-primary'
                    : 'hover:bg-gray-100 hover:text-black'; ?>">
                    <?php echo $item['label']; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- CONTACT BUTTON -->
        <div class="p-6 pt-0">
            <a href="<?php echo appUrl('/contact'); ?>"
                class="group flex h-12 w-full items-center justify-center gap-3 rounded-full border border-primary text-xs font-semibold tracking-wide transition-all duration-300
            <?php echo isActive('/contact')
                ? 'bg-primary text-white'
                : 'text-primary hover:bg-primary hover:text-white'; ?>">

                <?php echo sanitize($content['primary_cta_label']); ?>

                <i data-lucide="arrow-right"
                    class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1">
                </i>
            </a>
        </div>
    </div>
</header>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const closeBtn = document.getElementById('closeBtn');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
        mobileSidebar.classList.remove('right-[-100%]');
        mobileSidebar.classList.add('right-0');

        overlay.classList.remove('opacity-0', 'invisible');
        overlay.classList.add('opacity-100', 'visible');
    });

    function closeSidebar() {
        mobileSidebar.classList.remove('right-0');
        mobileSidebar.classList.add('right-[-100%]');

        overlay.classList.remove('opacity-100', 'visible');
        overlay.classList.add('opacity-0', 'invisible');
    }

    closeBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
    
</script>
