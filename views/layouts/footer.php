<?php $content = contentSettings(); ?>
<footer class="text-gray-800 py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Center Content -->
        <div class="flex flex-col items-center justify-center text-center">

            <!-- Brand -->
            <img src="<?php echo PUBLIC_IMAGES_URL; ?>logo.png" alt="<?php echo sanitize($content['site_owner_name']); ?>" class="h-8 w-auto object-contain">

            <!-- Email -->
            <a href="<?php echo emailUrl(); ?>"
                class="group mt-5 flex items-center gap-2 text-sm md:text-base text-gray-500 hover:text-primary transition duration-300">

                <i data-lucide="mail"
                    class="w-4 h-4 transition-transform duration-300 group-hover:scale-105">
                </i>

                <?php echo sanitize(contactEmail()); ?>
            </a>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-300 mt-14 pt-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                <!-- Copyright -->
                <p class="text-xs md:text-sm text-gray-400 text-center md:text-left">
                    <?php echo $content['footer_copyright']; ?>
                </p>

                <!-- Social Links -->
                <div class="flex items-center gap-6 text-sm text-gray-400">

                    <a href="<?php echo socialUrl('instagram'); ?>"
                        class="hover:text-primary transition duration-300">
                        Instagram
                    </a>

                    <a href="<?php echo socialUrl('github'); ?>"
                        class="hover:text-primary transition duration-300">
                        GitHub
                    </a>

                    <a href="<?php echo socialUrl('linkedin'); ?>"
                        class="hover:text-primary transition duration-300">
                        LinkedIn
                    </a>

                    <a href="<?php echo socialUrl('twitter'); ?>"
                        class="hover:text-primary transition duration-300">
                        Twitter
                    </a>

                </div>
            </div>
        </div>
    </div>
</footer>
