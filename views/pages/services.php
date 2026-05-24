<?php
$selectedCategory = normalizeCategoryFilter($_GET['category'] ?? null);
$categories = getContentCategories('services');
$services = getServices($selectedCategory);
?>

<!-- SERVICES -->
<section class="py-12">

    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADING -->
        <div class="text-center mb-16">

            <span class="uppercase tracking-[4px] text-xs md:text-sm text-gray-500">
                SERVICES
            </span>

            <h1 class="mt-3 text-3xl md:text-6xl font-playfair text-gray-800">
                What I Offer
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-gray-500 text-sm md:text-base leading-8">
                Modern digital solutions crafted to help startups,
                businesses and brands grow online.
            </p>

        </div>

        <!-- FILTERS -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">

            <!-- ALL -->
            <a href="<?php echo appUrl('/services'); ?>"
                class="px-6 py-3 rounded-full border text-xs font-medium transition duration-300
                <?php echo $selectedCategory === null
                    ? 'bg-[#2d2d2d] border-[#2d2d2d] text-white'
                    : 'bg-transparent border-gray-400 text-gray-700 hover:bg-[#2d2d2d] hover:text-white hover:border-[#2d2d2d]'; ?>">

                All

            </a>

            <?php foreach ($categories as $category): ?>

                <a href="<?php echo appUrl('/services?category=' . urlencode($category)); ?>"
                    class="px-6 py-3 rounded-full border text-xs font-medium transition duration-300
                    <?php echo $selectedCategory === $category
                        ? 'bg-[#2d2d2d] border-[#2d2d2d] text-white'
                        : 'bg-transparent border-gray-400 text-gray-700 hover:bg-[#2d2d2d] hover:text-white hover:border-[#2d2d2d]'; ?>">

                    <?php echo sanitize($category); ?>

                </a>

            <?php endforeach; ?>

        </div>

        <!-- SERVICES GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7">

            <?php foreach ($services as $service): ?>

                <div
                    class="group bg-white border border-gray-200 rounded-xl overflow-hidden transition duration-500 hover:-translate-y-2 hover:shadow-xl">

                    <!-- IMAGE -->
                    <?php if (!empty($service['image_url'])): ?>

                        <div class="h-[240px] overflow-hidden bg-gray-100">

                            <img
                                src="<?php echo sanitize($service['image_url']); ?>"
                                alt="<?php echo sanitize($service['title']); ?>"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-105">

                        </div>

                    <?php endif; ?>

                    <!-- CONTENT -->
                    <div class="p-6">

                        <!-- CATEGORY -->
                        <span class="uppercase text-[11px] tracking-[1px] text-[#ff5c4d] font-medium">

                            <?php echo sanitize($service['category'] ?? 'Web'); ?>

                        </span>

                        <!-- TITLE -->
                        <h3 class="mt-3 text-xl font-semibold text-black leading-snug">

                            <?php echo sanitize($service['title']); ?>

                        </h3>

                        <!-- DESCRIPTION -->
                        <p class="mt-4 text-gray-500 leading-7 text-sm">

                            <?php echo nl2br(sanitize($service['description'])); ?>

                        </p>

                        <!-- BUTTON -->
                        <div class="mt-7">

                            <a href="<?php echo appUrl('/contact'); ?>"
                                class="inline-flex items-center gap-2 text-sm font-medium text-black group/link">

                                Learn More

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

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <!-- EMPTY -->
        <?php if (empty($services)): ?>

            <div class="text-center py-20">

                <h3 class="text-3xl font-semibold text-gray-800 mb-3">
                    No services found
                </h3>

                <p class="text-gray-500">
                    Add services from the admin panel or try another category.
                </p>

            </div>

        <?php endif; ?>

        <!-- CTA -->
        <div class="text-center mt-24">

            <h2 class="text-4xl font-semibold text-[#1f2937] mb-5">
                Need a custom solution?
            </h2>

            <p class="text-gray-500 mb-8 max-w-2xl mx-auto">
                Let’s build something powerful and modern for your business.
            </p>

            <a href="<?php echo appUrl('/contact'); ?>"
                class="inline-flex items-center gap-3 border border-black px-8 py-4 rounded-full text-sm font-medium text-black transition duration-300 hover:bg-black hover:text-white">

                Get In Touch

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