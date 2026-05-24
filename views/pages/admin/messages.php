<?php
requireAdmin();
$adminTitle = 'Messages';
$messages = getAdminRows('messages');
?>

<div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
        <h2 class="mb-3 text-xl font-bold text-gray-900">Contact Messages</h2>
        <div class="grid gap-[0.9rem]">
            <?php foreach ($messages as $message): ?>
                <article class="rounded-lg border border-gray-200 p-4 <?php echo empty($message['is_read']) ? 'border-l-4 border-l-primary' : ''; ?>">
                    <div class="mb-3 flex flex-col justify-between gap-4 sm:flex-row">
                        <div>
                            <h3 class="mb-1 font-bold text-gray-900"><?php echo sanitize($message['subject']); ?></h3>
                            <p class="mb-2 text-gray-600"><?php echo sanitize($message['name']); ?> | <?php echo sanitize($message['email']); ?><?php echo $message['phone'] ? ' | ' . sanitize($message['phone']) : ''; ?></p>
                        </div>
                        <small class="text-gray-500"><?php echo sanitize(formatDate($message['created_at'], 'M d, Y h:i A')); ?></small>
                    </div>
                    <p class="mb-2 text-gray-600"><?php echo nl2br(sanitize($message['message'])); ?></p>
                    <div class="flex flex-wrap items-center gap-2">
                        <?php if (empty($message['is_read'])): ?>
                            <form method="POST" action="<?php echo appUrl('/admin/messages/read'); ?>">
                                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                                <input type="hidden" name="id" value="<?php echo intval($message['id']); ?>">
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-[0.85rem] py-[0.55rem] font-semibold text-gray-700 transition duration-300 hover:bg-gray-50">Mark Read</button>
                            </form>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo appUrl('/admin/delete'); ?>" onsubmit="return confirm('Delete this message?');">
                            <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                            <input type="hidden" name="table" value="messages">
                            <input type="hidden" name="id" value="<?php echo intval($message['id']); ?>">
                            <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-[0.85rem] py-[0.55rem] font-semibold text-red-700 transition duration-300 hover:bg-red-50">Delete</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>
            <?php if (empty($messages)): ?><p class="text-gray-500">No messages yet.</p><?php endif; ?>
        </div>
    </div>
