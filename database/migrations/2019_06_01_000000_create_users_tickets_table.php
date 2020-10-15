<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTicketsTable extends Migration
    {
        public function up()
        {
            Schema::create('users_tickets', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->integer('category_id')->default(0);
                $table->enum('status', ['closed', 'open'])->default('open');
                $table->text('subject')->nullable();
                $table->text('content')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_tickets');
        }
    }
