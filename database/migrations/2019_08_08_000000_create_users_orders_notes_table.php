<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersOrdersNotesTable extends Migration
    {
        public function up()
        {
            Schema::create('users_orders_notes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('order_id')->default(0);
                $table->text('note')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_orders_notes');
        }
    }
