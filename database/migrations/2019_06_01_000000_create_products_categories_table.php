<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateProductsCategoriesTable extends Migration
    {
        public function up()
        {
            Schema::create('products_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('slug')->nullable();
                $table->string('keywords')->nullable();
                $table->string('meta_tags_desc')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('products_categories');
        }
    }
