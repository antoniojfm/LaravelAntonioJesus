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
    <h1>Listado de Alumnos</h1>
    <br/>
    <p><a href="<?php echo e(url('alumno/create')); ?>" class="btn btn-success">Registrar Alumno</a></p>
    <?php if(Session::has('mensaje')): ?>
        <?php echo e(Session::get('mensaje')); ?>

    <?php endif; ?>
    <br/>
    
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Edad</th>
                <th>Direccion</th>

                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $alumnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alumno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($alumno->id); ?></td>
                <td><img src="<?php echo e(asset('storage') . '/' . $alumno->foto); ?>" class="img-thumbnail img-fluid" width="100px"></td>
                <td><?php echo e($alumno->nombre); ?></td>
                <td><?php echo e($alumno->apellido); ?></td>
                <td><?php echo e($alumno->email); ?></td>
                <td><?php echo e($alumno->edad); ?></td>
                <td><?php echo e($alumno->direccion); ?></td>
                <td>
                    <div class="btn-group mx-2" role="group">
                        <a href="<?php echo e(url('alumno/' . $alumno->id)); ?>" class="btn btn-primary">Show</a>
                        <a href="<?php echo e(url('alumno/' . $alumno->id . '/edit')); ?>" class="btn btn-danger">Edit</a>
                        <form action="<?php echo e(url('alumno/' . $alumno->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo e(method_field('DELETE')); ?>

                            <input type="submit" onclick="return confirm('Se va a eliminar el alumno #<?php echo e($alumno->id); ?>')" class="btn btn-warning" value="Borrar" >
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </tbody>
    </table>
    <?php echo $alumnos->links(); ?>


</body>
</div>
<?php $__env->stopSection(); ?>
</html>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravelAntonioJesusFernandez/resources/views/alumno/index.blade.php ENDPATH**/ ?>