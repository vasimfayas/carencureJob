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
        Schema::create('job_cards', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('location');
            $table->date('posted_date');
            $table->date('last_date_to_apply');
            $table->string('whatsapp_no');
            $table->string('email_of_host');
            $table->text('job_features');
            $table->text('other_requirements');
            $table->json('emails_to_receive_applications'); // This can be a JSON column for storing multiple emails

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_cards');
    }
};
