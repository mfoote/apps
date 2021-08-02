<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('phone_number')->index()->nullable();
            $table->string('email')->index()->nullable();
            $table->text('comments')->nullable();
            $table->json('form_meta')->nullable();
            $table->json('tracking_meta')->nullable();
            $table->string('ip_address')->index();
            $table->string('session_id')->index();
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::create('form_messages', function (Blueprint $table) {
            $table->id();
            $table->string('form_id')->index();
            $table->text('message')->nullable();
            $table->json('form_meta')->nullable();
            $table->json('tracking_meta')->nullable();
            $table->string('ip_address')->index();
            $table->string('session_id')->index();
            $table->string('status')->index();
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::create('form_notes', function (Blueprint $table) {
            $table->id();
            $table->string('form_id')->index();
            $table->text('note')->nullable();
            $table->json('form_meta')->nullable();
            $table->json('tracking_meta')->nullable();
            $table->string('ip_address')->index();
            $table->string('session_id')->index();
            $table->string('status')->index();
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
        Schema::dropIfExists('form_messages');
        Schema::dropIfExists('form_notes');
    }
}
