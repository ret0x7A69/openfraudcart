<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateProductsBonusTable extends Migration
    {
        public function up()
        {
            Schema::create('products_bonus', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('product_id')->default(0);
                $table->integer('min_amount')->default(0);
                $table->string('percent')->default('1');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('products_bonus');
        }
    }
