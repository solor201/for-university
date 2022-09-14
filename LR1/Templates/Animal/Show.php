<?php
    if (isset($Animals)) :
?>
    <div class="container mb-5 pb-3">
        <?php
        if (count($Animals) > 0) :
            ?>
            <h4 class="pt-2 mb-3">Список животных</h4>
            <table class="table table-hover table-responsive table-striped mt-3">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Кличка</th>
                    <th>Владелец</th>
                    <th>Год рождения</th>
                    <th>Описание</th>
                    <th>Фото</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($Animals as $key => $item) :
                    ?>
                    <tr>
                        <th><?=$item['id']?></th>
                        <td><?=$item['name']?></th>
                        <td><?=$item['name_owner']?></td>
                        <td><?=$item['year_of_birth']?></td>
                        <td><?=$item['description']?></td>
                        <td><img alt="<?=$item['name']?>" width="250" src="Source/Images/<?=$item['img_path']?>"></td>
                        <td>
                            <div class="btn-group-vertical text-center">
                                <a class="btn btn-primary" type="button" id="edit" href="/LR1/AnimalEdit.php?id=<?=$item['id']?>">Редактировать</a>
                                <a class="btn btn-danger AnimalDelete" id="<?=$item['id']?>" data-entityname="student">Удалить</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        else:
            ?>
            <h1 class="pt-2 mb-3">Животных нет</h1>
        <?php
        endif;
        ?>
        <a class="btn btn-primary btn-lg mb-5" type="button" href="/LR1/AnimalAdd.php">Добавить</a>
    </div>

<?php endif; ?>