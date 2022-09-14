<div class="container">
    <h1 class="pt-2 mb-3"><?=$header ?? ""?></h1>

    <div class="d-flex align-items-center flex-column pt-3 h5">
        <form class="" action="OwnerAdd.php" method="post" enctype="multipart/form-data" style="width: 100%">

            <label class="pt-3">ФИО клиента</label>
            <input type="text" class="form-control mt-1 input-lg" name="name" value="<?=isset($_POST['name'])?htmlspecialchars($_POST['name']):"";?>">

            <?php
            if (isset($error_messages['name'])) :
                ?>
                <p class="pt-3"><?=$error_messages['name']?></p>
            <?php
            endif;
            ?>

            <button type="submit" class="btn btn-primary mt-3 pt-1">Добавить</button>

        </form>
    </div>
</div>