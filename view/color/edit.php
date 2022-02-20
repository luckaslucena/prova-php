<div class="col-md-12 order-md-1">
    <h4 class="mb-3">Editar cor</h4>
    <form method="post" action="index.php?color=update">
        <div class="mb-3">
            <label for="address">Nome</label>
            <input type="hidden" name="id" value="<?php echo  $data['color']->getId(); ?>">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo  $data['color']->getName(); ?>">
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
    </form>
</div>

