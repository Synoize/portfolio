<?php 

$skills = getSkills();
$about = aboutSettings();
$content = contentSettings();
$resumeUrl = resumeDownloadUrl();

$selectedCategory = normalizeCategoryFilter($_GET['category'] ?? null);
$categories = getContentCategories('works');
$works = array_slice(getWorks(null, $selectedCategory), 0, 4);


$selectedCategory = normalizeCategoryFilter($_GET['category'] ?? null);
$categories = getContentCategories('services');
$services = array_slice(getServices($selectedCategory), 0, 4);

$selectedCategory = normalizeCategoryFilter($_GET['category'] ?? null);
$categories = getContentCategories('projects');
$projects = array_slice(getProjects(null, $selectedCategory), 0, 4);

?>

<!-- Landing Page -->
<section class="flex items-center justify-center">
    <div class="mx-auto max-w-7xl px-4 py-10">
        <div class="text-center max-w-3xl mx-auto">
            <!-- Profile Image -->
            <?php if (!empty($content['hero_profile_image_url'])): ?>
                <div class="mb-8 flex justify-center">
                    <img src="<?php echo sanitize($content['hero_profile_image_url']); ?>" alt="<?php echo sanitize($content['site_owner_name']); ?>" class="h-40 w-40 rounded-full border-2 border-primary object-cover shadow-lg md:h-48 md:w-48">
                </div>
            <?php endif; ?>

            <!-- Greeting -->
            <p class="text-lg md:text-xl text-gray-400 mb-4"><?php echo sanitize($content['hero_greeting']); ?> <span class="text-primary font-semibold"><?php echo sanitize($content['site_owner_name']); ?></span></p>

            <!-- Main Heading -->
            <h1 class="text-3xl md:text-6xl text-gray-800 font-playfair mb-6 leading-tight">
                <?php echo sanitize($content['hero_title']); ?>
            </h1>

            <!-- Description -->
            <p class="text-sm md:text-base text-gray-500 mb-12">
                <?php echo sanitize($content['hero_description']); ?>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-row flex-wrap justify-center gap-4">
                <a href="<?php echo appUrl('/contact'); ?>"
                    class="group flex h-12 items-center gap-3 border border-primary rounded-full px-8 text-xs transition duration-300 bg-primary text-white hover:bg-opacity-90">
                    <?php echo sanitize($content['primary_cta_label']); ?>
                    <i data-lucide="arrow-right"
                        class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1">
                    </i>
                </a>

                <a href="<?php echo sanitize($resumeUrl ?: '#'); ?>" <?php echo $resumeUrl ? 'download="resume.pdf"' : ''; ?>
                    class="group flex h-12 items-center gap-3 border border-gray-800 rounded-full px-8 text-xs transition duration-300 text-gray-800 hover:text-white hover:bg-gray-800">
                    DOWNLOAD RESUME
                    <i data-lucide="download"
                        class="w-4 h-4 transition-transform duration-300 group-hover:translate-y-0.5">
                    </i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Me -->
<section class="relative py-12 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 relative z-10">

        <!-- Section Heading -->
        <div class="text-center mb-20">

            <p class="uppercase tracking-[5px] text-xs md:text-sm text-gray-400 mb-4">
                <?php echo sanitize($about['about_eyebrow']); ?>
            </p>

            <h2 class="text-3xl md:text-6xl font-playfair text-gray-800 mb-6">
                <?php echo sanitize($about['about_title']); ?>
            </h2>

            <div class="w-24 h-[2px] bg-primary mx-auto"></div>

        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">

            <!-- LEFT IMAGE -->
            <div class="relative">

                <!-- Main Image -->
                <div class="overflow-hidden rounded-[32px] shadow-2xl group">
                    <?php if (!empty($about['about_image_url'])): ?>
                        <img
                            src="<?php echo sanitize($about['about_image_url']); ?>"
                            alt="<?php echo sanitize($content['site_owner_name']); ?>"
                            class="w-full min-h-[400px] max-h-[600px] object-cover group-hover:scale-105 transition duration-700">
                    <?php endif; ?>
                </div>

                <!-- Floating Experience Card -->
                <div class="absolute -bottom-8 -right-8 bg-white px-12 py-6 border rounded-3xl shadow-xl border border-gray-100">
                    <h4 class="text-4xl font-bold text-primary mb-1">
                        <?php echo sanitize($about['about_experience_years']); ?>
                    </h4>

                    <p class="text-gray-500 text-sm">
                        Years of Experience
                    </p>
                </div>

            </div>

            <!-- RIGHT CONTENT -->

            <!-- Intro -->
            <div class="mt-4 md:mb-4">

                <?php foreach (settingParagraphs($about['about_body']) as $paragraph): ?>
                    <p class="text-sm leading-[1.8] md:leading-[2] text-gray-700 mb-4">
                        <?php echo sanitize($paragraph); ?>
                    </p>
                <?php endforeach; ?>

            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:mb-12">

                <div class="bg-white border border-gray-100 rounded-3xl p-6 text-center shadow-sm hover:shadow-lg transition duration-300">

                    <!-- Dynamic Number -->
                    <h4 id="projectsCount"
                        class="text-3xl font-bold text-primary mb-2">
                        0
                    </h4>

                    <p class="text-gray-500 text-sm">
                        Projects Completed
                    </p>


                </div>

                <div class="bg-white border border-gray-100 rounded-3xl p-6 text-center shadow-sm hover:shadow-lg transition duration-300">
                    <h4 class="text-3xl font-bold text-primary mb-2">
                        <?php echo sanitize($about['about_happy_clients']); ?>
                    </h4>

                    <p class="text-gray-500 text-sm">
                        Happy Clients
                    </p>
                </div>

                <div class="col-span-2 md:col-span-1 bg-white border border-gray-100 rounded-3xl p-6 text-center shadow-sm hover:shadow-lg transition duration-300">
                    <h4 class="text-3xl font-bold text-primary mb-2">
                        <?php echo sanitize($about['about_technologies']); ?>
                    </h4>

                    <p class="text-gray-500 text-sm">
                        Technologies
                    </p>
                </div>

            </div>

            <!-- Skills -->
            <div>

                <h4 class="text-xl text-center md:text-start font-semibold text-gray-900 mb-6">
                    Core Technologies & Skills
                </h4>

                <div class="flex flex-wrap justify-center md:justify-start gap-3">

                    <?php foreach ($skills as $skill): ?>

                        <span class="px-5 py-3 rounded-full bg-white border border-gray-200 text-gray-700 text-xs font-medium shadow-sm hover:bg-primary hover:text-white hover:border-primary transition duration-300">
                            <?php echo sanitize($skill['name']); ?>
                        </span>

                    <?php endforeach; ?>

                    <?php if (empty($skills)): ?>

                        <span class="text-gray-500">
                            No skills found. <br> Please add some skills to the database.
                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>
</section>

<script>
    const username = "<?php echo sanitize($content['github_username']); ?>";

    async function loadProjectsCount() {

        if (!username) return;

        try {

            const response = await fetch(
                `https://api.github.com/users/${username}/repos?per_page=100`
            );

            const repos = await response.json();

            // Total Projects
            const totalProjects = repos.length;

            document.getElementById("projectsCount").innerText =
                totalProjects + "+";

        } catch (error) {

            console.log("GitHub Error:", error);

        }

    }

    loadProjectsCount();
</script>

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
        <div class="text-center mt-20">
            <a href="<?php echo appUrl('/projects'); ?>"
                class="inline-flex items-center gap-3 border border-black px-8 py-4 rounded-full text-sm font-medium text-black transition duration-300 hover:bg-black hover:text-white">

                SEE ALL PROJECTS

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

<!-- My WORKS -->
<section class="py-12">

  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- HEADING -->
        <div class="text-center mb-14">

            <span class="uppercase tracking-[4px] text-xs md:text-sm text-gray-500">
                <?php echo sanitize($content['works_eyebrow']); ?>
            </span>

            <h1 class="mt-3 text-3xl md:text-6xl font-playfair text-gray-800">
                <?php echo sanitize($content['works_title']); ?>
            </h1>
            
            <div class="mt-6 w-24 h-[2px] bg-primary mx-auto"></div>

        </div>

        <!-- FILTERS -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">

            <!-- ALL -->
            <a href="<?php echo appUrl('/my-work'); ?>"
                class="px-6 py-3 rounded-full border text-xs font-medium transition duration-300
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

        <!-- CTA -->
        <div class="text-center mt-20">
            <a href="<?php echo appUrl('/my-work'); ?>"
                class="inline-flex items-center gap-3 border border-black px-8 py-4 rounded-full text-sm font-medium text-black transition duration-300 hover:bg-black hover:text-white">

                SEE ALL CLIENTS

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

<!-- SERVICES -->
<section class="py-12">

    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADING -->
        <div class="text-center mb-16">

            <span class="uppercase tracking-[4px] text-xs md:text-sm text-gray-500">
                <?php echo sanitize($content['services_eyebrow']); ?>
            </span>

            <h1 class="mt-3 text-3xl md:text-6xl font-playfair text-gray-800">
                <?php echo sanitize($content['services_title']); ?>
            </h1>

            <p class="mt-6 max-w-2xl mx-auto text-gray-500 text-sm md:text-base leading-8">
                <?php echo nl2br(sanitize($content['services_description'])); ?>
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
        <div class="text-center mt-20">
            <a href="<?php echo appUrl('/services'); ?>"
                class="inline-flex items-center gap-3 border border-black px-8 py-4 rounded-full text-sm font-medium text-black transition duration-300 hover:bg-black hover:text-white">

                SEE ALL SERVICES

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

<!-- CONTACT -->
<section class="py-12">

    <div class="max-w-5xl mx-auto px-4">

        <!-- HEADING -->
        <div class="text-center">

            <span class="uppercase tracking-[4px] text-xs md:text-sm text-gray-500">
                CONNECT WITH ME
            </span>

            <h1 class="mt-4 text-3xl md:text-6xl font-playfair text-gray-800">
                Get In Touch
            </h1>

            <div class="mt-6 w-24 h-[2px] bg-primary mx-auto"></div>

        </div>

        <!-- FORM -->
        <div class="mt-20">

            <?php if (isset($_SESSION['success'])): ?>

                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>

            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>

            <?php endif; ?>

            <form method="POST"
                action="<?php echo appUrl('/contact'); ?>"
                class="max-w-3xl mx-auto">

                <!-- INPUTS -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <!-- NAME -->
                    <input
                        type="text"
                        name="name"
                        required
                        placeholder="Enter your name"
                        class="h-[64px] rounded-[20px] border border-gray-300 bg-transparent px-6 text-[15px] text-[#2d2d2d] placeholder-[#8b93a7] outline-none transition duration-300 focus:border-black">

                    <!-- EMAIL -->
                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="Enter your email"
                        class="h-[64px] rounded-[20px] border border-gray-300 bg-transparent px-6 text-[15px] text-[#2d2d2d] placeholder-[#8b93a7] outline-none transition duration-300 focus:border-black">

                </div>

                <!-- MESSAGE -->
                <textarea
                    name="message"
                    rows="7"
                    required
                    placeholder="Enter your message"
                    class="w-full rounded-[20px] border border-gray-300 bg-transparent px-6 py-6 text-[15px] text-[#2d2d2d] placeholder-[#8b93a7] outline-none resize-none transition duration-300 focus:border-black"></textarea>

                <!-- BUTTON -->
                <div class="flex justify-center mt-14">

                    <button
                        type="submit"
                        class="inline-flex items-center gap-3 rounded-full bg-[#3d3d3d] px-10 py-5 text-sm font-medium uppercase tracking-[1px] text-white transition duration-300 hover:bg-black">

                        Submit Now

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

                    </button>

                </div>

            </form>

        </div>

    </div>

</section>
