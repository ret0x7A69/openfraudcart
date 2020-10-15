<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersCartShoppingsTable extends Migration
    {
        public function up()
        {
            Schema::create('users_carts_shoppings', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->integer('is_done')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_carts_shoppings');
        }
    }
