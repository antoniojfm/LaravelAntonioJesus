        <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger" role="danger">
            <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        

        <?php $__env->startSection('content'); ?>
        <div class="container">
            <label for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo e($alumno->nombre ?? ''); ?>">
            <br/>
            <label for="apellido">Apellido</label>
            <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo e($alumno->apellido ?? ''); ?>">
            <br/>
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo e($alumno->email ?? ''); ?>">
            <br/>
            <label for="edad">Edad</label>
            <input type="number" class="form-control" name="edad" id="edad" value="<?php echo e($alumno->edad ?? ''); ?>">
            <br/>
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo e($alumno->direccion ?? ''); ?>">
        
            <?php if(isset($alumno->foto)): ?> 
                <img src="<?php echo e(asset('storage') . '/' . $alumno->foto ?? ''); ?>" width="100px">
                <br/>
            <?php endif; ?>

            <label for="foto">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto">
            <br/>
            <input type="submit" class="btn btn-success" value="<?php echo e($modo); ?> alumno">
            <br/><br/>
            <a href="<?php echo e(url('alumno')); ?>">Volver</a>
        </div>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravelAntonioJesusFernandez/resources/views/alumno/_fields.blade.php ENDPATH**/ ?>