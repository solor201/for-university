<?php
if (isset($Owners)) :
    ?>
    <div class="container mb-5 pb-3">
        <?php
        if (count($Owners) > 0) :
            ?>
            <h4 class="pt-2 mb-3">Список животных</h4>
            <table class="table table-hover table-responsive table-striped mt-3 text-center">
                <thead>
                <tr>
                    <th colspan="1">id</th>
                    <th colspan="2">ФИО</th>
                    <th colspan="2">Действия</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($Owners as $key => $item) :
                    ?>
                    <tr>
                        <th colspan="1"><?=$item['id']?></th>
                        <td colspan="2">
                            <a href="/LR1/AnimalShow.php?id=<?=$item['id']?>">
                                <?=$item['name']?>
                            </a>
                        </th>

                        <td><a class="btn btn-primary" type="button" id="edit" href="/LR1/OwnerEdit.php?id=<?=$item['id']?>">Редактировать</a>
                        <a class="btn btn-danger OwnerDelete" id="<?=$item['id']?>" data-entityname="student">Удалить</a></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        else:
            ?>
            <h1 class="pt-2 mb-3">Клиентов нет</h1>
        <?php
        endif;
        ?>
        <a class="btn btn-primary btn-lg mb-5" type="button" href="/LR1/OwnerAdd.php">Добавить</a>
    </div>

<?php endif; ?>