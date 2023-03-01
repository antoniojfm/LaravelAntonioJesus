<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseridToAlumnos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     Schema::table('alumnos', function (Blueprint $table) {
    //         $table->unsignedBigInteger('userid')->after('id');

    //         if(Schema::hasTable('alumnos')) {
    //             if(Schema::hasColumn('alumnos','userid')) {
    //                 if(Schema::hasColumn('users','id')) {
    //                     //Asignamos la clave foranea en este campo a la clave primaria id de la tabla users
    //                     $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
    //                 }
    //             }
    //         }
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
    // public function down()
    // {
    //     Schema::table('alumnos', function (Blueprint $table) {
    //         $table->dropForeign('alumnos_userid_foreign');
    //         $table->dropColumn('userid');
    //     });
    // }
}
