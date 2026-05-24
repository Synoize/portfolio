<?php
requireAdmin();
$adminTitle = 'Manage Skills';
$editing = getAdminRecord('skills', $_GET['id'] ?? 0);
$skills = getAdminRows('skills');
?>

<div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-[minmax(0,0.95fr)_minmax(0,1.25fr)]">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="mb-3 text-xl font-bold text-gray-900"><?php echo $editing ? 'Edit Skill' : 'Add Skill'; ?></h2>
            <form method="POST" action="<?php echo appUrl('/admin/skills/save'); ?>" class="grid gap-4 [&_input]:w-full [&_input]:rounded-lg [&_input]:border [&_input]:border-gray-300 [&_input]:px-4 [&_input]:py-2 [&_input]:transition [&_input]:focus:border-primary [&_input]:focus:outline-none [&_label_span]:mb-[0.35rem] [&_label_span]:block [&_label_span]:font-semibold [&_label_span]:text-gray-700">
                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                <input type="hidden" name="id" value="<?php echo sanitize($editing['id'] ?? ''); ?>">
                <label><span>Name</span><input type="text" name="name" required value="<?php echo sanitize($editing['name'] ?? ''); ?>"></label>
                <label><span>Category</span><input type="text" name="category" required value="<?php echo sanitize($editing['category'] ?? ''); ?>"></label>
                <label><span>Proficiency</span><input type="number" name="proficiency" min="0" max="100" value="<?php echo sanitize($editing['proficiency'] ?? 80); ?>"></label>
                <label><span>Sort order</span><input type="number" name="order_by" value="<?php echo sanitize($editing['order_by'] ?? 0); ?>"></label>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="submit" class="rounded-lg bg-primary px-4 py-[0.8rem] font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-primary-600">Save Skill</button>
                    <?php if ($editing): ?><a class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white" href="<?php echo appUrl('/admin/skills'); ?>">Cancel</a><?php endif; ?>
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="mb-3 text-xl font-bold text-gray-900">Skills</h2>
            <div class="grid gap-[0.9rem]">
                <?php foreach ($skills as $skill): ?>
                    <article class="flex flex-col justify-between gap-4 rounded-lg border border-gray-200 p-4 sm:flex-row">
                        <div>
                            <h3 class="mb-1 font-bold text-gray-900"><?php echo sanitize($skill['name']); ?></h3>
                            <p class="mb-2 text-gray-600"><?php echo sanitize($skill['category']); ?> | <?php echo intval($skill['proficiency']); ?>%</p>
                            <small class="text-gray-500">Order: <?php echo intval($skill['order_by']); ?></small>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="<?php echo appUrl('/admin/skills?id=' . intval($skill['id'])); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white">Edit</a>
                            <form method="POST" action="<?php echo appUrl('/admin/delete'); ?>" onsubmit="return confirm('Delete this skill?');">
                                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                                <input type="hidden" name="table" value="skills">
                                <input type="hidden" name="id" value="<?php echo intval($skill['id']); ?>">
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-[0.85rem] py-[0.55rem] font-semibold text-red-700 transition duration-300 hover:bg-red-50">Delete</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php if (empty($skills)): ?><p class="text-gray-500">No skills yet.</p><?php endif; ?>
            </div>
        </div>
    </div>
