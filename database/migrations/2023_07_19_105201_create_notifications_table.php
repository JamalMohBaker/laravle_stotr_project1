<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type'); //name of class notification stored in type
            $table->morphs('notifiable');
            //notifiable_type -> name of use class
            // notifiable_id -> id of user
            $table->text('data'); // in this field stored arryy from toDatabaseMessage
            $table->timestamp('read_at')->nullable(); //time of reading
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
