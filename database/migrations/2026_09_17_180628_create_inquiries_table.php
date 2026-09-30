<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('parent_name', 100);
            $table->string('child_name', 100);
            $table->unsignedTinyInteger('class');
            $table->unsignedTinyInteger('child_age');
            $table->string('phone', 20);
            $table->string('interested_in', 30);
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
