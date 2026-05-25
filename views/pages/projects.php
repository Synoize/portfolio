<?php
$selectedCategory = normalizeCategoryFilter($_GET['category'] ?? null);
$categories = getContentCategories('projects');
$projects = getProjects(null, $selectedCategory);
$content = contentSettings();
?>

<!-- PROJECTS -->
<section class="py-12">

    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADING -->
        <div class="text-center mb-16">

            <span class="uppercase tracking-[4px] text-xs md:text-sm text-gray-500">
                <?php echo sanitize($content['projects_eyebrow']); ?>
            </span>

            <h1 class="mt-3 text-3xl md:text-6xl font-playfair text-gray-800">
                <?php echo sanitize($content['projects_title']); ?>
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-gray-500 text-sm md:text-base leading-8">
                <?php echo nl2br(sanitize($content['projects_description'])); ?>
            </p>

        </div>

        <!-- FILTERS -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">

            <!-- ALL -->
            <a href="<?php echo appUrl('/projects'); ?>"
                class="px-6 py-3 rounded-full border text-xs font-medium transition duration-300
                <?php echo $selectedCategory === null
                    ? 'bg-[#2d2d2d] border-[#2d2d2d] text-white'
                    : 'bg-transparent border-gray-400 text-gray-700 hover:bg-[#2d2d2d] hover:text-white hover:border-[#2d2d2d]'; ?>">

                All

            </a>

            <?php foreach ($categories as $category): ?>

                <a href="<?php echo appUrl('/projects?category=' . urlencode($category)); ?>"
                    class="px-6 py-3 rounded-full border text-xs font-medium transition duration-300
                    <?php echo $selectedCategory === $category
                        ? 'bg-[#2d2d2d] border-[#2d2d2d] text-white'
                        : 'bg-transparent border-gray-400 text-gray-700 hover:bg-[#2d2d2d] hover:text-white hover:border-[#2d2d2d]'; ?>">

                    <?php echo sanitize($category); ?>

                </a>

            <?php endforeach; ?>

        </div>

        <!-- PROJECT GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php foreach ($projects as $project): ?>

                <div
                    class="group bg-white border border-gray-200 rounded-xl overflow-hidden transition duration-500 hover:-translate-y-2 hover:shadow-xl">

                    <!-- IMAGE -->
                    <?php if (!empty($project['image_url'])): ?>

                        <div class="relative h-[280px] overflow-hidden bg-gray-100">

                            <img
                                src="<?php echo sanitize($project['image_url']); ?>"
                                alt="<?php echo sanitize($project['title']); ?>"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                            <!-- STATUS -->
                            <div class="absolute top-5 left-5">

                                <span class="px-4 py-2 rounded-full bg-white/90 backdrop-blur text-xs font-semibold text-black shadow">

                                    <?php echo sanitize(ucfirst($project['status'])); ?>

                                </span>

                            </div>

                        </div>

                    <?php endif; ?>

                    <!-- CONTENT -->
                    <div class="p-6">

                        <!-- CATEGORY -->
                        <span class="uppercase text-[11px] tracking-[1px] text-[#ff5c4d] font-medium">

                            <?php echo sanitize($project['category'] ?? 'Web'); ?>

                        </span>

                        <!-- TITLE -->
                        <h3 class="mt-3 text-xl font-semibold text-black leading-snug">

                            <?php echo sanitize($project['title']); ?>

                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="mt-4 text-gray-500 leading-7 text-sm">

                            <?php echo nl2br(sanitize($project['description'])); ?>

                        </p>

                        <!-- TECH STACK -->
                        <div class="flex flex-wrap gap-2 mt-6">

                            <?php foreach (technologyBadges($project['technologies']) as $technology): ?>

                                <span
                                    class="px-4 py-1.5 text-xs rounded-full border border-gray-300 text-gray-700 bg-white">

                                    <?php echo sanitize($technology); ?>

                                </span>

                            <?php endforeach; ?>

                        </div>

                        <!-- BUTTONS -->
                        <div class="flex items-center gap-5 mt-8">

                            <?php if (!empty($project['github_url'])): ?>

                                <a href="<?php echo sanitize($project['github_url']); ?>"
                                    target="_blank"
                                    rel="noopener"
                                    class="inline-flex items-center gap-2 text-sm font-medium text-black group/github">

                                    GitHub

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 transition duration-300 group-hover/github:translate-x-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />

                                    </svg>

                                </a>

                            <?php endif; ?>

                            <?php if (!empty($project['url'])): ?>

                                <a href="<?php echo sanitize($project['url']); ?>"
                                    target="_blank"
                                    rel="noopener"
                                    class="inline-flex items-center gap-2 text-sm font-medium text-[#ff5c4d] group/live">

                                    Live Demo

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 transition duration-300 group-hover/live:translate-x-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />

                                    </svg>

                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- EMPTY -->
        <?php if (empty($projects)): ?>

            <div class="text-center py-20">

                <h3 class="text-3xl font-semibold text-gray-800 mb-3">
                    No projects found
                </h3>

                <p class="text-gray-500">
                    Add projects from the admin panel or try another category.
                </p>

            </div>

        <?php endif; ?>

        <!-- CTA -->
        <div
            class="mt-24 bg-white border border-gray-200 rounded-[32px] p-12 text-center shadow-sm">

            <h2 class="text-4xl font-semibold text-[#1f2937] mb-5">
                More Projects Coming Soon
            </h2>

            <p class="text-gray-500 text-lg leading-8 max-w-2xl mx-auto mb-8">
                I’m constantly building new products, experimenting with
                ideas and contributing to modern digital experiences.
            </p>

            <a href="<?php echo socialUrl('github'); ?>"
                target="_blank"
                rel="noopener"
                class="inline-flex items-center gap-3 border border-black px-8 py-4 rounded-full text-sm font-medium text-black transition duration-300 hover:bg-black hover:text-white">

                Follow on GitHub

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M17 8l4 4m0 0l-4 4m4-4H3" />

                </svg>

            </a>

        </div>

    </div>

</section>
