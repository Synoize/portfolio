<?php if (isset($_SESSION['success'])): ?>
    <div class="mb-4 rounded-lg border border-green-300 bg-green-100 px-4 py-[0.8rem] text-green-800">
        <?php echo sanitize($_SESSION['success']); unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="mb-4 rounded-lg border border-red-300 bg-red-100 px-4 py-[0.8rem] text-red-800">
        <?php echo sanitize($_SESSION['error']); unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>
