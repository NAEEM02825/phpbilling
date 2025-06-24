<?php if (isset($_SESSION['flash_message'])): ?>
<div class="alert alert-<?php echo $_SESSION['flash_message']['type']; ?> alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['flash_message']['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['flash_message']); endif; ?>