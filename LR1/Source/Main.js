$(document).ready(function() {
    $(".AnimalDelete").click(function(){
        if (window.confirm("Вы точно хотите удалить таблицу?")) {
            window.location.replace('/LR1/AnimalDelete.php?id='+$(this).attr("id"));
        }
    });

    $(".OwnerDelete").click(function(){
        if (window.confirm("Вы точно хотите удалить таблицу?")) {
            window.location.replace('/LR1/OwnerDelete.php?id='+$(this).attr("id"));
        }
    });
});