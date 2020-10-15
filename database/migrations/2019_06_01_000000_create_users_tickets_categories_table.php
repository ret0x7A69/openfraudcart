<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTicketsCategoriesTable extends Migration
    {
        public function up()
        {
            Schema::create('users_tickets_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->text('name')->nullable();
                $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('users_tickets_categories');
        }
    }
