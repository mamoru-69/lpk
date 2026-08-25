<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('programs', function(Blueprint $t){ $t->id(); $t->string('name'); $t->string('slug')->unique(); $t->string('category')->default('Jepang'); $t->string('short_description',300)->nullable(); $t->longText('description')->nullable(); $t->longText('requirements')->nullable(); $t->string('duration')->nullable(); $t->boolean('is_featured')->default(false); $t->boolean('is_active')->default(true); $t->integer('sort_order')->default(0); $t->timestamps(); }); } public function down():void{ Schema::dropIfExists('programs'); } };
