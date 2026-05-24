<?php
$selectedCategory = normalizeCategoryFilter($_GET['category'] ?? null);
$categories = getContentCategories('works');
$works = getWorks(null, $selectedCategory);
?>

<!-- My WORKS -->
<section class="py-12">

    <div class="mx-auto max-w-7xl px-4">

        <!-- HEADING -->
        <div class="text-center mb-14">

            <span class="uppercase tracking-[4px] text-xs md:text-sm text-gray-500">
                WORKS
            </span>

            <h1 class="mt-3 text-3xl md:text-6xl font-playfair text-gray-800">
                My Clients
            </h1>
            
            <div class="mt-6 w-24 h-[2px] bg-primary mx-auto"></div>

        </div>

        <!-- FILTERS -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">

            <!-- ALL -->
            <a href="<?php echo appUrl('/my-work'); ?>"
                class="px-6 py-3 text-xs rounded-full border text-xs font-medium transition duration-300
                <?php echo $selectedCategory === null
                    ? 'bg-[#2d2d2d] border-[#2d2d2d] text-white'
                    : 'bg-transparent border-gray-400 text-gray-700 hover:bg-[#2d2d2d] hover:text-white hover:border-[#2d2d2d]'; ?>">

                All
            </a>

            <?php foreach ($categories as $category): ?>

                <a href="<?php echo appUrl('/my-work?category=' . urlencode($category)); ?>"
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

            <?php foreach ($works as $work): ?>

                <div
                    class="group bg-white border border-gray-200 rounded-xl overflow-hidden transition duration-500 hover:-translate-y-2 hover:shadow-xl">

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden h-[250px] bg-gray-100">

                        <?php if (!empty($work['image_url'])): ?>

                            <img
                                src="<?php echo sanitize($work['image_url']); ?>"
                                alt="<?php echo sanitize($work['title']); ?>"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105">

                        <?php endif; ?>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-6">

                        <!-- CATEGORY -->
                        <span class="uppercase text-[11px] tracking-[1px] text-[#ff5c4d] font-medium">

                            <?php echo sanitize($work['category'] ?? 'Web'); ?>

                        </span>

                        <!-- TITLE -->
                        <h3 class="mt-3 text-xl font-semibold text-black leading-snug">

                            <?php echo sanitize($work['title']); ?>

                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="mt-3 text-gray-500 text-sm leading-7">

                            <?php echo sanitize($work['description']); ?>

                        </p>

                        <!-- TECH STACK -->
                        <div class="flex flex-wrap gap-2 mt-5">

                            <?php foreach (technologyBadges($work['technologies']) as $technology): ?>

                                <span
                                    class="px-4 py-1.5 text-xs rounded-full border border-gray-300 text-gray-700 bg-white">

                                    <?php echo sanitize($technology); ?>

                                </span>

                            <?php endforeach; ?>

                        </div>

                        <!-- BUTTON -->
                        <?php if (!empty($work['url'])): ?>

                            <div class="mt-7">

                                <a href="<?php echo sanitize($work['url']); ?>"
                                    target="_blank"
                                    rel="noopener"
                                    class="inline-flex items-center gap-2 text-sm font-medium text-black group/link">

                                    View Project

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4 transition duration-300 group-hover/link:translate-x-1"
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

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- EMPTY -->
        <?php if (empty($works)): ?>

            <div class="text-center py-20">

                <h3 class="text-3xl font-semibold text-gray-800 mb-3">
                    No work found
                </h3>

                <p class="text-gray-500">
                    Try another category or add new projects.
                </p>

            </div>

        <?php endif; ?>

    </div>

</section>
