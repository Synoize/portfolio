<?php $content = contentSettings(); ?>

<!-- CONTACT -->
<section class="py-12">

    <div class="max-w-7xl mx-auto px-4">

        <!-- HEADING -->
        <div class="text-center mb-20">

            <span class="uppercase tracking-[4px] text-[12px] text-gray-500">
                <?php echo sanitize($content['contact_eyebrow']); ?>
            </span>

            <h1 class="mt-3 text-3xl md:text-6xl font-playfair text-gray-800"><?php echo sanitize($content['contact_title']); ?></h1>

            <p class="mt-6 max-w-2xl mx-auto text-gray-500 text-sm md:text-base leading-8"><?php echo nl2br(sanitize($content['contact_description'])); ?></p>

        </div>

        <!-- MAIN GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT INFO -->
            <div class="space-y-6">

                <!-- EMAIL -->
                <div class="bg-white border border-gray-200 rounded-xl p-4">

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-2xl bg-[#111827] flex items-center justify-center shrink-0">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8" />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs uppercase tracking-[2px] text-gray-400 mb-2">
                                Email
                            </p>

                            <h3 class="text-xs md:text-sm font-semibold text-black mb-2">
                                <?php echo sanitize(contactEmail()); ?>
                            </h3>

                            <a href="<?php echo emailUrl(); ?>"
                                class="inline-flex items-center gap-2 text-xs font-medium text-[#ff5c4d]">

                                Send Email

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

                </div>

                <!-- PHONE -->
                <div class="bg-white border border-gray-200 rounded-xl p-4">

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-2xl bg-[#ff5c4d] flex items-center justify-center shrink-0">

                            <!-- CALL ICON -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a1.5 1.5 0 001.5-1.5v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.5 1.5 0 00-1.465.417l-.97.97a12.035 12.035 0 01-5.292-5.292l.97-.97a1.5 1.5 0 00.417-1.465L8.213 3.852A1.5 1.5 0 007.122 3H5.75a1.5 1.5 0 00-1.5 1.5v2.25z" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs uppercase tracking-[2px] text-gray-400 mb-2">
                                Phone
                            </p>

                            <h3 class="text-sm md:text-lg font-semibold text-black mb-2">
                                <?php echo sanitize(contactPhone()); ?>
                            </h3>

                            <a href="<?php echo phoneUrl(); ?>"
                                class="inline-flex items-center gap-2 text-xs font-medium text-[#ff5c4d]">

                                Call Now

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

                </div>

                <!-- WHATSAPP -->
                <div class="bg-white border border-gray-200 rounded-xl p-4">

                    <div class="flex items-start gap-5">

                        <div class="w-14 h-14 rounded-2xl bg-green-600 flex items-center justify-center shrink-0">

                            <!-- WHATSAPP ICON -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 32 32"
                                fill="currentColor"
                                class="w-6 h-6 text-white">

                                <path
                                    d="M19.11 17.21c-.27-.13-1.58-.78-1.82-.87-.24-.09-.42-.13-.6.14-.18.27-.69.87-.85 1.05-.15.18-.31.2-.58.07-.27-.13-1.13-.42-2.16-1.35-.8-.71-1.34-1.59-1.5-1.86-.16-.27-.02-.42.12-.55.12-.12.27-.31.4-.47.13-.16.18-.27.27-.45.09-.18.04-.34-.02-.47-.07-.13-.6-1.45-.82-1.99-.22-.52-.44-.45-.6-.46h-.51c-.18 0-.47.07-.71.34-.24.27-.93.91-.93 2.22s.96 2.57 1.1 2.75c.13.18 1.88 2.87 4.56 4.02.64.28 1.14.44 1.53.56.64.2 1.22.17 1.68.1.51-.08 1.58-.64 1.8-1.25.22-.62.22-1.15.15-1.25-.07-.11-.24-.18-.51-.31z" />

                                <path
                                    d="M16.01 3C8.83 3 3 8.74 3 15.83c0 2.27.6 4.48 1.74 6.42L3 29l6.95-1.81a13.1 13.1 0 006.06 1.54h.01c7.18 0 13.01-5.74 13.01-12.83C29.03 8.74 23.2 3 16.01 3zm0 23.43h-.01a10.8 10.8 0 01-5.5-1.5l-.39-.23-4.12 1.07 1.1-4-.25-.41a10.58 10.58 0 01-1.63-5.63c0-5.89 4.85-10.69 10.8-10.69 2.89 0 5.6 1.11 7.64 3.13a10.57 10.57 0 013.16 7.56c0 5.89-4.84 10.69-10.8 10.69z" />

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs uppercase tracking-[2px] text-gray-400 mb-2">
                                WhatsApp
                            </p>

                            <h3 class="text-sm md:text-lg font-semibold text-black mb-2">
                                Quick Chat Anytime
                            </h3>

                            <a href="<?php echo socialUrl('whatsapp'); ?>"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-xs font-medium text-green-600">

                                Chat on WhatsApp

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

                </div>

            </div>

            <!-- FORM -->
            <div class="lg:col-span-2">

                <div class="bg-white border border-gray-200 rounded-2xl p-6 md:p-12">

                    <h2 class="text-xl md:text-3xl font-semibold text-black mb-10">
                        Send Me a Message
                    </h2>

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
                        class="space-y-6">

                        <!-- GRID -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- NAME -->
                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    required
                                    placeholder="John Doe"
                                    class="w-full h-14 rounded-2xl border border-gray-300 px-5 text-sm outline-none transition focus:border-black">

                            </div>

                            <!-- EMAIL -->
                            <div>

                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    required
                                    placeholder="<?php echo sanitize(contactEmail()); ?>"
                                    class="w-full h-14 rounded-2xl border border-gray-300 px-5 text-sm outline-none transition focus:border-black">

                            </div>

                        </div>

                        <!-- PHONE -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Phone Number
                            </label>

                            <input
                                type="tel"
                                name="phone"
                                placeholder="<?php echo sanitize(contactPhone()); ?>"
                                class="w-full h-14 rounded-2xl border border-gray-300 px-5 text-sm outline-none transition focus:border-black">

                        </div>

                        <!-- SUBJECT -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Subject
                            </label>

                            <input
                                type="text"
                                name="subject"
                                required
                                placeholder="Project Inquiry"
                                class="w-full h-14 rounded-2xl border border-gray-300 px-5 text-sm outline-none transition focus:border-black">

                        </div>

                        <!-- MESSAGE -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Message
                            </label>

                            <textarea
                                name="message"
                                rows="6"
                                required
                                placeholder="Tell me about your project..."
                                class="w-full rounded-2xl border border-gray-300 px-5 py-4 text-sm outline-none resize-none transition focus:border-black"></textarea>

                        </div>

                        <!-- BUTTON -->
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-3 rounded-full bg-black px-8 py-4 text-sm font-medium text-white transition duration-300 hover:opacity-90">

                            Send Message

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

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>