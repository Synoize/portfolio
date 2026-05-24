<?php
requireAdmin();
$adminTitle = 'Dashboard';
$projectCount = count(getAdminRows('projects'));
$serviceCount = count(getAdminRows('services'));
$workCount = count(getAdminRows('works'));
$skillCount = count(getAdminRows('skills'));
$unreadCount = getUnreadMessageCount();
?>

<div class="grid grid-cols-1 gap-4 mb-5 sm:grid-cols-2 xl:grid-cols-5">
        <a href="<?php echo appUrl('/admin/projects'); ?>" class="block rounded-lg border border-gray-200 bg-white p-5 no-underline shadow-lg">
            <span class="mb-[0.4rem] block text-gray-500">Projects</span>
            <strong class="text-3xl font-bold text-gray-900"><?php echo $projectCount; ?></strong>
        </a>
        <a href="<?php echo appUrl('/admin/services'); ?>" class="block rounded-lg border border-gray-200 bg-white p-5 no-underline shadow-lg">
            <span class="mb-[0.4rem] block text-gray-500">Services</span>
            <strong class="text-3xl font-bold text-gray-900"><?php echo $serviceCount; ?></strong>
        </a>
        <a href="<?php echo appUrl('/admin/works'); ?>" class="block rounded-lg border border-gray-200 bg-white p-5 no-underline shadow-lg">
            <span class="mb-[0.4rem] block text-gray-500">Works</span>
            <strong class="text-3xl font-bold text-gray-900"><?php echo $workCount; ?></strong>
        </a>
        <a href="<?php echo appUrl('/admin/skills'); ?>" class="block rounded-lg border border-gray-200 bg-white p-5 no-underline shadow-lg">
            <span class="mb-[0.4rem] block text-gray-500">Skills</span>
            <strong class="text-3xl font-bold text-gray-900"><?php echo $skillCount; ?></strong>
        </a>
        <a href="<?php echo appUrl('/admin/messages'); ?>" class="block rounded-lg border border-gray-200 bg-white p-5 no-underline shadow-lg">
            <span class="mb-[0.4rem] block text-gray-500">Unread Messages</span>
            <strong class="text-3xl font-bold text-gray-900"><?php echo $unreadCount; ?></strong>
        </a>
    </div>

<div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
        <h2 class="mb-3 text-xl font-bold text-gray-900">Quick Actions</h2>
        <div class="flex flex-wrap items-center gap-2">
            <a href="<?php echo appUrl('/admin/projects'); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:border-gray-900 hover:bg-gray-900 hover:text-white">Add or edit projects</a>
            <a href="<?php echo appUrl('/admin/services'); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:border-gray-900 hover:bg-gray-900 hover:text-white">Update services</a>
            <a href="<?php echo appUrl('/admin/works'); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:border-gray-900 hover:bg-gray-900 hover:text-white">Manage portfolio works</a>
            <a href="<?php echo appUrl('/admin/messages'); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:border-gray-900 hover:bg-gray-900 hover:text-white">Read contact messages</a>
        </div>
    </div>
