<?php
requireAdmin();
$adminTitle = 'Manage About';
$about = aboutSettings();
$content = contentSettings();
?>

<div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-[minmax(0,1fr)_360px]">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
        <h2 class="mb-3 text-xl font-bold text-gray-900">Website Content</h2>
        <form method="POST" action="<?php echo appUrl('/admin/about/save'); ?>" class="grid gap-4 [&_input]:w-full [&_input]:rounded-lg [&_input]:border [&_input]:border-gray-300 [&_input]:px-4 [&_input]:py-2 [&_input]:transition [&_input]:focus:border-primary [&_input]:focus:outline-none [&_label_span]:mb-[0.35rem] [&_label_span]:block [&_label_span]:font-semibold [&_label_span]:text-gray-700 [&_textarea]:w-full [&_textarea]:resize-y [&_textarea]:rounded-lg [&_textarea]:border [&_textarea]:border-gray-300 [&_textarea]:px-4 [&_textarea]:py-2 [&_textarea]:transition [&_textarea]:focus:border-primary [&_textarea]:focus:outline-none" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrfToken(); ?>">

            <h3 class="text-lg font-bold text-gray-900">General</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Owner Name</span><input type="text" name="site_owner_name" value="<?php echo sanitize($content['site_owner_name']); ?>"></label>
                <label><span>GitHub Username</span><input type="text" name="github_username" value="<?php echo sanitize($content['github_username']); ?>"></label>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Site Title</span><input type="text" name="site_name" value="<?php echo sanitize($content['site_name']); ?>"></label>
                <label><span>Site Description</span><input type="text" name="site_description" value="<?php echo sanitize($content['site_description']); ?>"></label>
            </div>
            <label><span>Footer Copyright</span><input type="text" name="footer_copyright" value="<?php echo sanitize($content['footer_copyright']); ?>"></label>

            <h3 class="text-lg font-bold text-gray-900">Homepage Hero</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Greeting</span><input type="text" name="hero_greeting" value="<?php echo sanitize($content['hero_greeting']); ?>"></label>
                <label><span>Hero Title</span><input type="text" name="hero_title" value="<?php echo sanitize($content['hero_title']); ?>"></label>
            </div>
            <label><span>Hero Description</span><textarea name="hero_description" rows="3"><?php echo sanitize($content['hero_description']); ?></textarea></label>
            <label><span>Primary CTA Label</span><input type="text" name="primary_cta_label" value="<?php echo sanitize($content['primary_cta_label']); ?>"></label>
            <label><span>Profile Image</span><input type="file" name="hero_profile_image_file" accept="image/jpeg,image/png,image/gif,image/webp"></label>

            <h3 class="text-lg font-bold text-gray-900">About</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Eyebrow</span><input type="text" name="about_eyebrow" value="<?php echo sanitize($about['about_eyebrow']); ?>"></label>
                <label><span>Title</span><input type="text" name="about_title" value="<?php echo sanitize($about['about_title']); ?>"></label>
            </div>

            <label>
                <span>About paragraphs</span>
                <textarea name="about_body" rows="12"><?php echo sanitize($about['about_body']); ?></textarea>
            </label>

            <div class="grid gap-4 md:grid-cols-3">
                <label><span>Experience</span><input type="text" name="about_experience_years" value="<?php echo sanitize($about['about_experience_years']); ?>"></label>
                <label><span>Happy Clients</span><input type="text" name="about_happy_clients" value="<?php echo sanitize($about['about_happy_clients']); ?>"></label>
                <label><span>Technologies</span><input type="text" name="about_technologies" value="<?php echo sanitize($about['about_technologies']); ?>"></label>
            </div>

            <label><span>About Image</span><input type="file" name="about_image_file" accept="image/jpeg,image/png,image/gif,image/webp"></label>
            <label><span>Resume PDF</span><input type="file" name="resume_file" accept="application/pdf,.pdf"></label>
            <label><span>Resume URL</span><input type="url" name="resume_url" value="<?php echo sanitize($about['resume_url']); ?>" placeholder="Upload a PDF or paste a direct resume URL"></label>

            <h3 class="text-lg font-bold text-gray-900">Sections</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Projects Eyebrow</span><input type="text" name="projects_eyebrow" value="<?php echo sanitize($content['projects_eyebrow']); ?>"></label>
                <label><span>Projects Title</span><input type="text" name="projects_title" value="<?php echo sanitize($content['projects_title']); ?>"></label>
            </div>
            <label><span>Projects Description</span><textarea name="projects_description" rows="3"><?php echo sanitize($content['projects_description']); ?></textarea></label>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Works Eyebrow</span><input type="text" name="works_eyebrow" value="<?php echo sanitize($content['works_eyebrow']); ?>"></label>
                <label><span>Works Title</span><input type="text" name="works_title" value="<?php echo sanitize($content['works_title']); ?>"></label>
                <label><span>Services Eyebrow</span><input type="text" name="services_eyebrow" value="<?php echo sanitize($content['services_eyebrow']); ?>"></label>
                <label><span>Services Title</span><input type="text" name="services_title" value="<?php echo sanitize($content['services_title']); ?>"></label>
            </div>
            <label><span>Services Description</span><textarea name="services_description" rows="3"><?php echo sanitize($content['services_description']); ?></textarea></label>

            <h3 class="text-lg font-bold text-gray-900">Contact</h3>
            <div class="grid gap-4 md:grid-cols-2">
                <label><span>Contact Eyebrow</span><input type="text" name="contact_eyebrow" value="<?php echo sanitize($content['contact_eyebrow']); ?>"></label>
                <label><span>Contact Title</span><input type="text" name="contact_title" value="<?php echo sanitize($content['contact_title']); ?>"></label>
            </div>
            <label><span>Contact Description</span><textarea name="contact_description" rows="3"><?php echo sanitize($content['contact_description']); ?></textarea></label>

            <div>
                <button type="submit" class="rounded-lg bg-primary px-4 py-[0.8rem] font-semibold text-white transition duration-300 hover:-translate-y-0.5 hover:bg-primary-600">Save Website Content</button>
            </div>
        </form>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-lg">
        <h2 class="mb-3 text-xl font-bold text-gray-900">Current Assets</h2>

        <?php if (!empty($about['about_image_url'])): ?>
            <img class="mb-4 h-56 w-full rounded-lg border border-gray-200 object-cover" src="<?php echo sanitize($about['about_image_url']); ?>" alt="Current about image">
        <?php endif; ?>

        <div class="grid gap-3 text-sm text-gray-600">
            <p><strong class="text-gray-900">Experience:</strong> <?php echo sanitize($about['about_experience_years']); ?></p>
            <p><strong class="text-gray-900">Clients:</strong> <?php echo sanitize($about['about_happy_clients']); ?></p>
            <p><strong class="text-gray-900">Technologies:</strong> <?php echo sanitize($about['about_technologies']); ?></p>

            <?php if (!empty($about['resume_url'])): ?>
                <a href="<?php echo sanitize($about['resume_url']); ?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2 font-semibold text-gray-700 no-underline transition duration-300 hover:bg-gray-900 hover:text-white">View Resume</a>
            <?php else: ?>
                <p>No resume uploaded yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
