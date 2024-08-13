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

        Schema::create('share_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('share_unit');
            $table->decimal('unit_buying_price', 10, 2);
            $table->boolean('is_sold')->default(false);
            $table->decimal('unit_sold_price', 10, 2)->nullable();
            $table->decimal('calculated_loss', 10, 2);
            $table->text('note')->nullable();
            $table->string('supporting_document_path');
            $table->enum('status', ['not_reviewed', 'accepted', 'rejected'])->default('not_reviewed');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_information');
    }
};
