<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Alumno
 *
 * @property int $id
 * @property string $foto
 * @property string $nombre
 * @property string $apellido
 * @property string|null $email
 * @property int $edad
 * @property string $direccion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereEdad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alumno whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos'; //Esto funciona para cuando la tabla y el modelo son diferentes en el plural del español y el ingles

    //propiedad fillable para poder rellenar los campos en la tabla de sql.
    protected $fillable = ['nombre','apellido','email','edad','direccion','foto'];

    //propiedad guarded para que los campos de la base de datos que no vayamos a usar se ponen aqui
    protected $guarded = ['nombre'];
    
    //propiedad hidden
    protected $hidden = ['id'];

    public function obtenerAlumnos() {
        // DB::table('alumnos')->all();
        return Alumno::all();
    }

    //Nos devuelve un alumno con el id del parametro en la base de datos
    public function obtenerAlumnosPorID($id) {
        return Alumno::find($id);
    }
}
