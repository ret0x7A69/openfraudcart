<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersOrdersTable extends Migration
    {
        public function up()
        {
            Schema::create('users_orders', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->text('name')->nullable();
                $table->text('content')->nullable();
                $table->integer('cart_entry_id')->default(0);
                $table->integer('amount')->default(0);
                $table->integer('price_in_cent')->default(0);
                $table->integer('totalprice')->default(0);
                $table->integer('weight')->default(0);
                $table->integer('delivery_price')->default(0);
                $table->string('weight_char')->default('g');
                $table->string('delivery_method')->nullable();
                $table->enum('status', ['nothing', 'cancelled', 'completed', 'pending'])->default('nothing');
                $table->text('drop_info')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_orders');
        }
    }
