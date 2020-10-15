<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersCartEntriesTable extends Migration
    {
        public function up()
        {
            Schema::create('users_carts_entries', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->integer('order_id')->default(0);
                $table->integer('shopping_id')->default(0);
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_carts_entries');
        }
    }
