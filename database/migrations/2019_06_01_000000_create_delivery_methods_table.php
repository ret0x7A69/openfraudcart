<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDeliveryMethodsTable extends Migration
    {
        public function up()
        {
            Schema::create('delivery_methods', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('price')->default(0);
                $table->string('name')->nullable();
                $table->integer('min_amount')->default(0);
                $table->integer('max_amount')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('delivery_methods');
        }
    }
