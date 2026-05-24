<aside class="flex h-screen flex-col items-start gap-6 bg-gray-400 p-6 text-white">
    <img src="<?php echo ASSETS_URL; ?>logo.png" alt="Admin" class="h-[72px] px-2 py-2 object-contain pb-6">


    <nav class="grid gap-3 w-full">
        <a href="<?php echo appUrl('/admin'); ?>" class="flex items-center gap-4 rounded-lg px-4 py-3 text-sm no-underline transition duration-300 <?php echo isActive('/admin') ? 'bg-primary text-white' : 'text-gray-200 hover:bg-gray-800 hover:text-white'; ?>">
            Dashboard
        </a>
        <a href="<?php echo appUrl('/admin/projects'); ?>" class="flex items-center gap-4 rounded-lg px-4 py-3 text-sm no-underline transition duration-300 <?php echo isActive('/admin/projects') ? 'bg-primary text-white' : 'text-gray-200 hover:bg-gray-800 hover:text-white'; ?>">
            Projects
        </a>
        <a href="<?php echo appUrl('/admin/services'); ?>" class="flex items-center gap-4 rounded-lg px-4 py-3 text-sm no-underline transition duration-300 <?php echo isActive('/admin/services') ? 'bg-primary text-white' : 'text-gray-200 hover:bg-gray-800 hover:text-white'; ?>">
            Services
        </a>
        <a href="<?php echo appUrl('/admin/works'); ?>" class="flex items-center gap-4 rounded-lg px-4 py-3 text-sm no-underline transition duration-300 <?php echo isActive('/admin/works') ? 'bg-primary text-white' : 'text-gray-200 hover:bg-gray-800 hover:text-white'; ?>">
            Works
        </a>
        <a href="<?php echo appUrl('/admin/skills'); ?>" class="flex items-center gap-4 rounded-lg px-4 py-3 text-sm no-underline transition duration-300 <?php echo isActive('/admin/skills') ? 'bg-primary text-white' : 'text-gray-200 hover:bg-gray-800 hover:text-white'; ?>">
            Skills
        </a>
        <a href="<?php echo appUrl('/admin/messages'); ?>" class="flex items-center gap-4 rounded-lg px-4 py-3 text-sm no-underline transition duration-300 <?php echo isActive('/admin/messages') ? 'bg-primary text-white' : 'text-gray-200 hover:bg-gray-800 hover:text-white'; ?>">
            Messages
        </a>
    </nav>

    <div class="mt-auto w-full grid gap-3 border-t pt-3 text-sm">
        <a href="<?php echo appUrl('/'); ?>" class="flex items-center gap-3 rounded-lg px-4 py-3 text-gray-200 no-underline transition duration-300 hover:bg-gray-800 hover:text-white">View Website</a>
        <a href="<?php echo appUrl('/admin/logout'); ?>" class="flex items-center gap-3 rounded-lg px-4 py-3 text-red-500 font-semibold no-underline transition duration-300 hover:bg-red-600 hover:text-white">Logout</a>
    </div>
</aside>