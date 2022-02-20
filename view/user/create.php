<div class="col-md-12 order-md-1">
    <h4 class="mb-3">Novo usuário</h4>
    <form method="post" action="index.php?user=store">
        <div class="mb-3">
            <label for="address">Nome</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="">
        </div>
        <div class="mb-3">
            <label for="email">E-mail <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
        </div>
        <hr class="mb-4">
        <h4 class="mb-3">Cores</h4>
        
        <div class="d-block my-3">
            <?php foreach ($data['colors'] as $color) : ?>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="color[]" id="cor-<?php echo $color->getId();?>" value="<?php echo $color->getId();?>">
                <label class="custom-control-label" for="cor-<?php echo $color->getId();?>"><?php echo $color->getName();?></label>
            </div>
            <?php endforeach ?>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
    </form>
</div>

