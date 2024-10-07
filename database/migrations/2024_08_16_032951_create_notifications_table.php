<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifikasisTable extends Migration
{
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('pesan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
}
