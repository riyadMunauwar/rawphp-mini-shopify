<?php include_once VIEWS . 'partials/head.php'; ?>
<?php include_once VIEWS . 'partials/header.php'; ?>
<section>
    <div class="container mx-auto bg-white md:my-4 p-5">
        <?php if(has('page', $data)) { ?>
            <?php echo  $data['page']['content'] ?? 'No Content available'; ?>
        <?php } ?>
        <?php echo $data['message'] ?? '' ?>
    </div>
</section>

<?php include_once VIEWS . 'partials/footer.php'; ?>