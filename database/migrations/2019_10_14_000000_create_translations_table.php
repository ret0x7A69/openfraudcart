<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateTranslationsTable extends Migration
    {
        public function up()
        {
            Schema::create('translations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('value')->nullable();
                $table->string('lang')->nullable();
                $table->string('keyword')->nullable();
                $table->integer('entry_id')->default(0);
                $table->string('type')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('translations');
        }
    }
