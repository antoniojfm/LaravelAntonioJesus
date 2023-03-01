<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Alumno</title>
</head>
<body>


<?php $__env->startSection('content'); ?>
<div class="container">
    <p><a href="<?php echo e(url('alumno')); ?>">Volver</a></p>
    <h1>Datos del alumno</h1>
    <br/>

    Nombre Completo => <?php echo e($alumno->nombre . ' ' . $alumno->apellido); ?>

    <br/>
    Edad => <?php echo e($alumno->edad); ?>

    <br/>
    Direccion => <?php echo e($alumno->direccion); ?>

    <br/>
    Email => <a href="mailto:<?php echo e($alumno->email); ?>" title="Enviar un mensaje"><?php echo e($alumno->email); ?></a>
    <br/>
    Foto => <img src="<?php echo e(asset('storage') . '/' . $alumno->foto); ?>" width="100px">

</body>
</div>
<?php $__env->stopSection(); ?>
</html>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravelAntonioJesusFernandez/resources/views/alumno/show.blade.php ENDPATH**/ ?>