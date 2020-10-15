<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersCartTable extends Migration
    {
        public function up()
        {
            Schema::create('users_cart', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->integer('product_id')->default(0);
                $table->integer('amount')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_cart');
        }
    }
