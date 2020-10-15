<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateProductsItemsTable extends Migration
    {
        public function up()
        {
            Schema::create('products_items', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('product_id')->default(0);
                $table->text('content')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('products_items');
        }
    }
