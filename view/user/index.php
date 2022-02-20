<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
    <h1 class="h2 mb-md-0">Usuários</h1>
    <div class="btn-toolbar mb-md-0">
     <a type="button" class="btn btn-outline-primary" href="?user=create">Novo</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th style='width: 40px'>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Cores</th>
            <th style='width: 135px'></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['users'] as $user) : ?>
        <tr>
            <td><?php echo $user->getId();?></td>
            <td><?php echo $user->getName();?></td>
            <td><?php echo $user->getEmail();?></td>
            <td><?php echo $user->getColors();?></td>
            <td>
                <a type="button" class="btn btn-outline-primary btn-sm" href="?user=edit&id=<?php echo $user->getId();?>">Editar</a>
                <a type="button" class="btn btn-outline-danger btn-sm" href="?user=destroy&id=<?php echo $user->getId();?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>