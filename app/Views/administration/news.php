<?php include('app/Views/administration/layouts/header.php'); ?>

<main class="admin-content">
    <?php include('app/Views/administration/layouts/sidebar.php'); ?>

    <section class="admin-news">
        <h1 class="news-title">Ajouter ou modifier un article</h1>

        <div class="add-news">
            <a title="Liens vers la création d'un nouvel artile" class="admin-button" href="indexAdmin.php?action=addNewsPage">Créer un nouvel article</a>
        </div>
        <!-- tableau affichage des articles -->
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
                <tbody>
                <?php 
                
                // boucle sur la ligne pour avoir un article par ligne
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
                                    <a  title="Lien vers la modification de cet article" href="indexAdmin.php?action=viewNews&id=<?=$news->id;?>"> 
                                        <i class="fa-solid fa-eye show"></i>
                                    </a>
                                </div>

                                <div>
                                    <a title="Bouton supprimer cet article" class="trashcan" href="indexAdmin.php?action=deleteNews&id=<?=$news->id;?>">
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