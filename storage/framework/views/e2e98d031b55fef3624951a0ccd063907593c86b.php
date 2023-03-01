<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion de alumno</title>
</head>
<body>


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Formulario EDITAR USUARIO

    <form action="<?php echo e(url('alumno/' . $alumno->id)); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo e(method_field('PUT')); ?>

    <?php echo $__env->make('alumno._fields', ['modo' => 'Editar'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
    </form>
                      
</body>
</div>
<?php $__env->stopSection(); ?>
</html>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravelAntonioJesusFernandez/resources/views/alumno/edit.blade.php ENDPATH**/ ?>