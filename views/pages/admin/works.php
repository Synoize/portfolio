<?php
requireAdmin();
$adminTitle = 'Manage Works';
$editing = getAdminRecord('works', $_GET['id'] ?? 0);
$works = getAdminRows('works');
?>

<div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-[minmax(0,0.95fr)_minmax(0,1.25fr)]">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="mb-3 text-xl font-bold text-gray-900"><?php echo $editing ? 'Edit Work' : 'Add Work'; ?></h2>
            <form method="POST" action="<?php echo appUrl('/admin/works/save'); ?>" class="grid gap-4 [&_input]:w-full [&_input]:rounded-lg [&_input]:border [&_input]:border-gray-300 [&_input]:px-4 [&_input]:py-2 [&_input]:transition [&_input]:focus:border-primary [&_input]:focus:outline-none [&_label_span]:mb-[0.35rem] [&_label_span]:block [&_label_span]:font-semibold [&_label_span]:text-gray-700 [&_textarea]:w-full [&_textarea]:resize-none [&_textarea]:rounded-lg [&_textarea]:border [&_textarea]:border-gray-300 [&_textarea]:px-4 [&_textarea]:py-2 [&_textarea]:transition [&_textarea]:focus:border-primary [&_textarea]:focus:outline-none" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                <input type="hidden" name="id" value="<?php echo sanitize($editing['id'] ?? ''); ?>">
                <label><span>Title</span><input type="text" name="title" required value="<?php echo sanitize($editing['title'] ?? ''); ?>"></label>
                <label><span>Category</span>
                    <input type="text" name="category" list="work-categories" required value="<?php echo sanitize($editing['category'] ?? 'Web'); ?>">
                    <datalist id="work-categories">
                        <option value="Web">
                        <option value="App">
                        <option value="Design">
                        <option value="Automation">
                        <option value="Ads">
                    </datalist>
                </label>
                <label><span>Description</span><textarea name="description" rows="5" required><?php echo sanitize($editing['description'] ?? ''); ?></textarea></label>
                <label><span>Technologies (comma separated)</span><input type="text" name="technologies" value="<?php echo sanitize($editing['technologies'] ?? ''); ?>"></label>
                <label><span>Upload Image</span><input type="file" name="image_file" accept="image/jpeg,image/png,image/gif,image/webp"></label>
                <?php if (!empty($editing['image_url'])): ?>
                    <img class="block h-40 w-full rounded-lg border border-gray-200 object-cover" src="<?php echo sanitize($editing['image_url']); ?>" alt="<?php echo sanitize($editing['title']); ?>">
                <?php endif; ?>
                <label><span>Project URL</span><input type="url" name="url" value="<?php echo sanitize($editing['url'] ?? ''); ?>"></label>
                <label><span>Case study</span><textarea name="case_study" rows="4"><?php echo sanitize($editing['case_study'] ?? ''); ?></textarea></label>
                <label class="flex items-center gap-2"><input class="!w-auto" type="checkbox" name="featured" <?php echo !empty($editing['featured']) ? 'checked' : ''; ?>> <span class="!mb-0">Featured</span></label>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="submit" class="rounded-lg bg-primary px-4 py-[0.8rem] font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-primary-600">Save Work</button>
                    <?php if ($editing): ?><a class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white" href="<?php echo appUrl('/admin/works'); ?>">Cancel</a><?php endif; ?>
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="mb-3 text-xl font-bold text-gray-900">Works</h2>
            <div class="grid gap-[0.9rem]">
                <?php foreach ($works as $work): ?>
                    <article class="flex flex-col justify-between gap-4 rounded-lg border border-gray-200 p-4 sm:flex-row">
                        <div>
                            <h3 class="mb-1 font-bold text-gray-900"><?php echo sanitize($work['title']); ?></h3>
                            <p class="mb-2 text-gray-600"><?php echo sanitize(truncateText($work['description'], 120)); ?></p>
                            <small class="text-gray-500"><?php echo sanitize($work['category'] ?? 'Web'); ?> | <?php echo $work['featured'] ? 'Featured' : 'Standard'; ?></small>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="<?php echo appUrl('/admin/works?id=' . intval($work['id'])); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white">Edit</a>
                            <form method="POST" action="<?php echo appUrl('/admin/delete'); ?>" onsubmit="return confirm('Delete this work item?');">
                                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                                <input type="hidden" name="table" value="works">
                                <input type="hidden" name="id" value="<?php echo intval($work['id']); ?>">
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-[0.85rem] py-[0.55rem] font-semibold text-red-700 transition duration-300 hover:bg-red-50">Delete</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php if (empty($works)): ?><p class="text-gray-500">No works yet.</p><?php endif; ?>
            </div>
        </div>
    </div>
