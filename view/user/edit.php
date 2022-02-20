<div class="col-md-12 order-md-1">
    <h4 class="mb-3">Editar usuário</h4>
    <form method="post" action="index.php?user=update">
        <div class="mb-3">
            <label for="address">Nome</label>
            <input type="hidden" name="id" value="<?php echo  $data['user']->getId(); ?>">
            <input type="text" class="form-control" name="name" id="name" value="<?php echo  $data['user']->getName(); ?>">
        </div>
        <div class="mb-3">
            <label for="email">E-mail <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo  $data['user']->getEmail(); ?>">
        </div>
        <hr class="mb-4">
        <h4 class="mb-3">Cores</h4>
        
        <div class="d-block my-3">
            <?php foreach ($data['colors'] as $color) : 
            $id = $color->getId();
            $checked = in_array($id, $data['checked']) ? 'checked="checked"' : '';
                
            ?>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="color[]" id="cor-<?php echo $id;?>" <?php echo $checked;?> value="<?php echo $id;?>">
                <label class="custom-control-label" for="cor-<?php echo $id;?>"><?php echo $color->getName();?></label>
            </div>
            <?php endforeach ?>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Salvar</button>
    </form>
</div>

