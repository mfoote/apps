<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('chart_number')->nullable()->index();
            $table->integer('status_id')->index();
            $table->string('conversion_type')->index();
            $table->boolean('converted_call')->default(false)->index();
            $table->string('ip_address')->nullable();
            $table->string('external_id')->index();
            $table->string('external_id_type')->index();
            $table->string('first_name')->index();
            $table->string('middle_initial')->nullable()->index();
            $table->string('last_name')->index();
            $table->string('suffix')->nullable()->index();
            $table->string('alias')->nullable();
            $table->date('date_of_birth')->nullable()->index();
            $table->string('web_postal_code')->nullable()->index();
            $table->text('web_comments')->nullable();
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::create('contact_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contact_id')->index();
            $table->string('address')->index();
            $table->string('address_type')->nullable()->index();
            $table->string('address_two')->nullable()->index();
            $table->string('city')->index();
            $table->string('state')->index();
            $table->string('postal_code')->nullable()->index();
            $table->boolean('is_primary')->index();
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::create('contact_phone_numbers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contact_id')->index();
            $table->string('phone_number')->index();
            $table->string('phone_number_type')->nullable()->index();
            $table->boolean('is_primary')->index();
            $table->timestamps();
            $table->softDeletes()->index();
            $table->index('created_at');
            $table->index('updated_at');
        });
        Schema::create('contact_notes', function (Blueprint $table) {
            $table->id();
            $table->string('contact_id')->index();
            $table->text('note')->nullable();
            $table->string('status')->index();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('updated_user_id')->nullable()->index();
            $table->date('follow_up_on')->nullable()->index();
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
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('contact_addresses');
        Schema::dropIfExists('contact_phone_numbers');
        Schema::dropIfExists('contact_notes');
    }
}
