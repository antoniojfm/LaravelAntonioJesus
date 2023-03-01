<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
</head>
<body>


<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Formulario de Creacion de Alumnos</h1>

    <form action="<?php echo e(url('alumno/')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('alumno._fields', ['modo' => 'Crear'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </form>
</body>
</div>
<?php $__env->stopSection(); ?>
</html>

<!-- //Imprimir variables de entorno .env salen de ahi
env("APP_NAME")

//Variable name que esta en config/app.php
<?php echo e(config('app.name')); ?> -->
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravelAntonioJesusFernandez/resources/views/alumno/create.blade.php ENDPATH**/ ?>