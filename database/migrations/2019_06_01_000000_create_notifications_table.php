<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateNotificationsTable extends Migration
    {
        public function up()
        {
            Schema::create('notifications', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('custom_id')->default(0);
                $table->text('extra_data')->nullable();
                $table->string('type')->nullable();
                $table->enum('readed', ['false', 'true'])->default('false');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('notifications');
        }
    }
