<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
    <h1 class="h2 mb-md-0">Cores</h1>
    <div class="btn-toolbar mb-md-0">
     <a type="button" class="btn btn-outline-primary" href="?color=create">Novo</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th style='width: 40px'>#</th>
            <th>Nome</th>
            <th style='width: 135px'></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['colors'] as $color) : ?>
        <tr>
            <td><?php echo $color->getId();?></td>
            <td><?php echo $color->getName();?></td>
            <td>
                <a type="button" class="btn btn-outline-primary btn-sm" href="?color=edit&id=<?php echo $color->getId();?>">Editar</a>
                <a type="button" class="btn btn-outline-danger btn-sm" href="?color=destroy&id=<?php echo $color->getId();?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>