<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateArticlesTable extends Migration
    {
        public function up()
        {
            Schema::create('articles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('body')->nullable();
                $table->integer('user_id')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('articles');
        }
    }
