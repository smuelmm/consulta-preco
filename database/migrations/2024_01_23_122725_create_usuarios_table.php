<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->biginteger('cpf');
            $table->string('nome');
        });
    }
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
?>
