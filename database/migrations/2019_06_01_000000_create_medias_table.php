<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateMediasTable extends Migration
    {
        public function up()
        {
            Schema::create('medias', function (Blueprint $table) {
                $table->increments('id');
                $table->text('filename')->nullable();
                $table->text('mimetype')->nullable();
                $table->enum('type', ['image', 'video', 'audio', 'mixed'])->default('mixed');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('medias');
        }
    }
