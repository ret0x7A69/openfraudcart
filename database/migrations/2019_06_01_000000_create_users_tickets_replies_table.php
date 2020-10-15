<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTicketsRepliesTable extends Migration
    {
        public function up()
        {
            Schema::create('users_tickets_replies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->default(0);
                $table->integer('ticket_id')->default(0);
                $table->text('content')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_tickets_replies');
        }
    }
