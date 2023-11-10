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
        Schema::create('a_e_request_forms', function (Blueprint $table) {
            $table->id();
            $table->string('icpc_no')->nullable();
            $table->string('mount_code')->nullable();
            $table->string('company_name')->nullable();
            $table->string('weight')->nullable();
            $table->string('destination')->nullable();
            $table->string('ae_rate')->nullable();
            $table->integer('service')->nullable();
            $table->longText('ae_comment')->nullable();
            $table->integer('ae_status')->nullable();
            $table->string('rate_offer')->nullable();
            $table->longText('pricing_comment')->nullable();
            $table->integer('pricing_status')->nullable();
            $table->integer('billing_status')->nullable();
            $table->integer('staus')->nullable();
            $table->integer('assign_ae')->nullable();
            $table->string('awb')->nullable();
            $table->string('fixed_rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_e_request_forms');
    }
};
