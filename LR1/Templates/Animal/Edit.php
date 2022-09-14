
    <div class="container">
        <h1 class="pt-2 mb-3"><?=$title ?? ""?></h1>

        <div class="d-flex align-items-center flex-column pt-3 h5">
            <form class="" action="AnimalEdit.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data" style="width: 100%">

                <label class="pt-3">Кличка животного</label>
                <input type="text" class="form-control mt-1 input-lg" name="name" placeholder="Название продукта" value="<?=isset($_POST['name'])?htmlspecialchars($_POST['name']):($Animal['name'] ?? "");?>">

                <?php
                if (isset($error_messages['name'])) :
                    ?>
                    <p class="pt-3"><?=$error_messages['name']?></p>
                <?php
                endif;
                ?>

                <label class="pt-3">Описание</label>
                <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Описание продукта"><?=isset($_POST['description'])?htmlspecialchars($_POST['description']):($Animal['description'] ?? "");?></textarea>

                <?php
                if (isset($error_messages['description'])) :
                    ?>
                    <p class="pt-3"><?=$error_messages['description']?></p>
                <?php
                endif;
                ?>

                <label class="pt-3">Год рождения</label>
                <input type="text" class="form-control mt-1" name="year_of_birth" placeholder="Стоимость продукта" value="<?=isset($_POST['year_of_birth'])?htmlspecialchars($_POST['year_of_birth']):($Animal['year_of_birth'] ?? "");?>">

                <?php
                if (isset($error_messages['year_of_birth'])) :
                    ?>
                    <p class="pt-3"><?=$error_messages['year_of_birth']?></p>
                <?php
                endif;
                ?>

                <label class="pt-3">Категория</label>
                <select class="form-select mt-1" name="owner" title="Группа">
                    <?php
                    for($i = 0; $i < count($Owners) ; $i++)
                    {
                        if (isset($_POST['owner']) && $_POST['owner'] == ($i + 1))
                            echo "<option value=" . $Owners[$i]['id'] . " selected>" . $Owners[$i]['name'] . "</option>";
                        else if (!isset($_POST['category']) && isset($Animal['id_owner']) && $Animal['id_owner'] == ($i + 1))
                            echo "<option value=" . $Owners[$i]['id'] . " selected>" . $Owners[$i]['name'] . "</option>";
                        else
                            echo "<option value=" . $Owners[$i]['id']. ">" . $Owners[$i]['name'] . "</option>";
                    }
                    ?>
                </select>

                <label class="pt-3">Загрузите фотографию продукта</label>
                <input type="file" class="form-control mt-1" placeholder="Фото" name="image" title="Фото">

                <?php
                if (isset($error_messages['image'])) :
                    ?>
                    <p class="pt-3"><?=$error_messages['image']?></p>
                <?php
                endif;
                ?>

                <button type="submit" class="btn btn-primary mt-3 pt-1">Изменить</button>

            </form>
        </div>
    </div>