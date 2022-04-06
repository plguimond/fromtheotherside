<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section class="admin-concerts">
       <?php var_dump($data['concerts']) ?>
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>