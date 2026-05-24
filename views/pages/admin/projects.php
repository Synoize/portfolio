<?php
requireAdmin();
$adminTitle = 'Manage Projects';
$editing = getAdminRecord('projects', $_GET['id'] ?? 0);
$projects = getAdminRows('projects');
?>

<div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-[minmax(0,0.95fr)_minmax(0,1.25fr)]">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="mb-3 text-xl font-bold text-gray-900"><?php echo $editing ? 'Edit Project' : 'Add Project'; ?></h2>
            <form method="POST" action="<?php echo appUrl('/admin/projects/save'); ?>" class="grid gap-4 [&_input]:w-full [&_input]:rounded-lg [&_input]:border [&_input]:border-gray-300 [&_input]:px-4 [&_input]:py-2 [&_input]:transition [&_input]:focus:border-primary [&_input]:focus:outline-none [&_label_span]:mb-[0.35rem] [&_label_span]:block [&_label_span]:font-semibold [&_label_span]:text-gray-700 [&_select]:w-full [&_select]:rounded-lg [&_select]:border [&_select]:border-gray-300 [&_select]:px-4 [&_select]:py-2 [&_select]:transition [&_select]:focus:border-primary [&_select]:focus:outline-none [&_textarea]:w-full [&_textarea]:resize-none [&_textarea]:rounded-lg [&_textarea]:border [&_textarea]:border-gray-300 [&_textarea]:px-4 [&_textarea]:py-2 [&_textarea]:transition [&_textarea]:focus:border-primary [&_textarea]:focus:outline-none" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                <input type="hidden" name="id" value="<?php echo sanitize($editing['id'] ?? ''); ?>">

                <label><span>Title</span><input type="text" name="title" required value="<?php echo sanitize($editing['title'] ?? ''); ?>"></label>
                <label><span>Category</span>
                    <input type="text" name="category" list="project-categories" required value="<?php echo sanitize($editing['category'] ?? 'Web'); ?>">
                    <datalist id="project-categories">
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
                <label><span>Live URL</span><input type="url" name="url" value="<?php echo sanitize($editing['url'] ?? ''); ?>"></label>
                <label><span>GitHub URL</span><input type="url" name="github_url" value="<?php echo sanitize($editing['github_url'] ?? ''); ?>"></label>
                <label><span>Status</span>
                    <select name="status">
                        <?php foreach (['active', 'completed', 'archived'] as $status): ?>
                            <option value="<?php echo $status; ?>" <?php echo (($editing['status'] ?? 'active') === $status) ? 'selected' : ''; ?>><?php echo ucfirst($status); ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="flex items-center gap-2"><input class="!w-auto" type="checkbox" name="featured" <?php echo !empty($editing['featured']) ? 'checked' : ''; ?>> <span class="!mb-0">Featured</span></label>

                <div class="flex flex-wrap items-center gap-2">
                    <button type="submit" class="rounded-lg bg-primary px-4 py-[0.8rem] font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-primary-600">Save Project</button>
                    <?php if ($editing): ?><a class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white" href="<?php echo appUrl('/admin/projects'); ?>">Cancel</a><?php endif; ?>
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
            <h2 class="mb-3 text-xl font-bold text-gray-900">Projects</h2>
            <div class="grid gap-[0.9rem]">
                <?php foreach ($projects as $project): ?>
                    <article class="flex flex-col justify-between gap-4 rounded-lg border border-gray-200 p-4 sm:flex-row">
                        <div>
                            <h3 class="mb-1 font-bold text-gray-900"><?php echo sanitize($project['title']); ?></h3>
                            <p class="mb-2 text-gray-600"><?php echo sanitize(truncateText($project['description'], 120)); ?></p>
                            <small class="text-gray-500"><?php echo sanitize($project['category'] ?? 'Web'); ?> | <?php echo sanitize($project['status']); ?><?php echo $project['featured'] ? ' | Featured' : ''; ?></small>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="<?php echo appUrl('/admin/projects?id=' . intval($project['id'])); ?>" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-[0.85rem] py-[0.55rem] text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white">Edit</a>
                            <form method="POST" action="<?php echo appUrl('/admin/delete'); ?>" onsubmit="return confirm('Delete this project?');">
                                <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">
                                <input type="hidden" name="table" value="projects">
                                <input type="hidden" name="id" value="<?php echo intval($project['id']); ?>">
                                <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-[0.85rem] py-[0.55rem] font-semibold text-red-700 transition duration-300 hover:bg-red-50">Delete</button>
                            </form>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php if (empty($projects)): ?><p class="text-gray-500">No projects yet.</p><?php endif; ?>
            </div>
        </div>
    </div>
