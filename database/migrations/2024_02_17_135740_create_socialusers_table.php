<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialusers', function (Blueprint $table) {
            $table->id();
            $table->string('provider');
            $table->unsignedBigInteger('provider_user_id'); 
            $table->text('token');
            $table->foreignIdFor(User::class)->nullable()->constrained(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialusers');
    }
};
