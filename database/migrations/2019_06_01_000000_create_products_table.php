<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateProductsTable extends Migration
    {
        public function up()
        {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->text('description')->nullable();
                $table->text('short_description')->nullable();
                $table->text('content')->nullable();
                $table->integer('price_in_cent')->default(0);
                $table->integer('old_price_in_cent')->default(0);
                $table->integer('category_id')->default(0);
                $table->integer('drop_needed')->default(0);
                $table->integer('sells')->default(0);
                $table->integer('interval')->default(1);
                $table->integer('stock_management')->default(0);
                $table->integer('as_weight')->default(0);
                $table->integer('weight_available')->default(0);
                $table->string('weight_char')->default('g');
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('products');
        }
    }
