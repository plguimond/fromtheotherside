<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section class="admin-news">
        <h1 class="news-title">Ajouter ou modifier un article</h1>
        <!-- TABLE -->

        <div class="add-news">
            <a class="admin-button" href="indexAdmin.php?action=addNewsPage">Créer un nouvel article</a>
        </div>
        <?php if (!empty($data['news'])){ ?>
                <div class="table-news">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>title</th>
                                <th><span>Actions</span></th>
                            </tr>
                        </thead>
                </div>
                <tbody>
                <?php 
                
                    foreach($data['news'] as $news) { 
                ?>
                    <tr>
                        <td>
                        <p><?= $this->formatDate($news->created_At); ?></p>
                        </td>
                        <td>
                            <p><?= $news->title; ?> </p>  
                        </td>
                        <td >
                            <div class="action-icon"> 
                                <div>
                                    <a href="indexAdmin.php?action=viewNews&id=<?=$news->id;?>"> 
                                        <i class="fa-solid fa-eye show"></i>
                                    </a>
                                </div>

                                <div>
                                    <a class="trashcan" href="indexAdmin.php?action=deleteNews&id=<?=$news->id;?>">
                                    <i class="fa-solid fa-trash-can "></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
                </table>
    </div>
    <?php }else{ ?>
    <div>
        <p>Vous n'avez aucun article de publié.</p>
    </div>
    <?php } ?>  
    
    </section>

</main>
<?php include('app/Views/administration/layouts/footer.php'); ?>