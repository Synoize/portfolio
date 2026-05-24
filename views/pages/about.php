<?php $skills = getSkills(); ?>


<!-- About Section -->
<section class="relative py-12 overflow-hidden">

    <div class="mx-auto max-w-7xl px-4 relative z-10">

        <!-- Section Heading -->
        <div class="text-center mb-20">

            <p class="uppercase tracking-[5px] text-xs md:text-sm text-gray-400 mb-4">
                Introduction
            </p>

            <h2 class="text-3xl md:text-6xl font-playfair text-gray-800 mb-6">
                About Me
            </h2>

            <div class="w-24 h-[2px] bg-primary mx-auto"></div>

        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">

            <!-- LEFT IMAGE -->
            <div class="relative">

                <!-- Main Image -->
                <div class="overflow-hidden rounded-[32px] shadow-2xl group">
                    <img
                        src="<?php echo IMAGES_URL; ?>info-img.jpg"
                        alt="Shivam Singh"
                        class="w-full min-h-[400px] max-h-[600px] object-cover group-hover:scale-105 transition duration-700">
                </div>

                <!-- Floating Experience Card -->
                <div class="absolute -bottom-8 -right-8 bg-white px-12 py-6 border rounded-3xl shadow-xl border border-gray-100">
                    <h4 class="text-4xl font-bold text-primary mb-1">
                        1+
                    </h4>

                    <p class="text-gray-500 text-sm">
                        Years of Experience
                    </p>
                </div>

            </div>

            <!-- RIGHT CONTENT -->

            <!-- Intro -->
            <div class="mt-4 md:mb-4">

                <p class="text-sm leading-[1.8] md:leading-[2] text-gray-700 mb-4">
                    I'm <span class="font-semibold text-primary">Shivam Singh</span>,
                    a passionate Full Stack Web Developer, Android Developer,
                    AI Automation Engineer, and Cybersecurity Enthusiast from Bihar, India.
                    I specialize in creating modern, scalable, and performance-driven
                    applications that solve real-world business problems.
                </p>

                <p class="text-sm leading-[1.8] md:leading-[2] text-gray-700 mb-4">
                    With over 2 years of professional experience, I have worked with
                    multiple startups and companies, helping them build responsive websites,
                    AI-powered systems, automation tools, and secure backend infrastructures
                    using modern technologies and industry best practices.
                </p>

                <p class="text-sm leading-[1.8] md:leading-[2] text-gray-700 mb-4">
                    My expertise includes Full Stack Development, REST APIs,
                    Database Architecture, Authentication Systems, Cloud Integrations,
                    and AI workflow automation. I enjoy transforming ideas into
                    impactful digital products with clean UI/UX and optimized performance.
                </p>

                <p class="text-sm leading-[1.8] md:leading-[2] text-gray-700 mb-4">
                    Beyond development, I actively explore cybersecurity,
                    ethical hacking, penetration testing, and network security.
                    I continuously learn secure coding practices and work with tools
                    like Kali Linux, Nmap, Burp Suite, and OWASP standards
                    to build safer applications.
                </p>

                <p class="text-sm leading-[1.8] md:leading-[2] text-gray-700 md:mb-4">
                    I strongly believe in continuous learning, innovation,
                    and creating technology that combines design, intelligence,
                    and functionality to deliver meaningful user experiences.
                </p>

            </div>


            <div class="flex flex-col">
                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-5 mb-12">

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
                            30+
                        </h4>

                        <p class="text-gray-500 text-sm">
                            Happy Clients
                        </p>
                    </div>

                    <div class="col-span-2 md:col-span-1 bg-white border border-gray-100 rounded-3xl p-6 text-center shadow-sm hover:shadow-lg transition duration-300">
                        <h4 class="text-3xl font-bold text-primary mb-2">
                            8+
                        </h4>

                        <p class="text-gray-500 text-sm">
                            Technologies
                        </p>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap justify-center md:justify-start gap-5">

                    <!-- Contact Button -->
                    <a href="<?php echo appUrl('/contact'); ?>"
                        class="group inline-flex items-center gap-2 bg-primary hover:bg-opacity-90 text-white text-xs md:text-sm px-8 py-4 rounded-full font-medium transition duration-300 shadow-lg hover:shadow-xl">

                        Let's Work Together

                        <i data-lucide="arrow-right"
                            class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1">
                        </i>

                    </a>

                    <!-- Download CV -->
                    <a href="#" download="resume.pdf"
                        class="inline-flex items-center gap-2 border border-gray-300 hover:border-gray-800 hover:bg-gray-800 text-gray-700 text-xs md:text-sm hover:text-white px-8 py-4 rounded-full font-medium transition duration-300">

                        Download Resume

                        <i data-lucide="download"
                            class="w-4 h-4 transition-transform duration-300 group-hover:translate-y-0.5">
                        </i>
                    </a>

                </div>
            </div>

            <!-- Skills -->
            <div>

                <h4 class="text-xl text-center md:text-start font-semibold text-gray-900 mb-6">
                    Core Technologies & Skills
                </h4>

                <div class="flex flex-wrap justify-center md:justify-start gap-3 ">

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
    const username = "synoize";

    async function loadProjectsCount() {

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