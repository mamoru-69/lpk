<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void{ Schema::create('registrations',function(Blueprint $t){ $t->id(); $t->string('name'); $t->string('nik',30)->nullable(); $t->string('birth_place')->nullable(); $t->date('birth_date')->nullable(); $t->enum('gender',['L','P'])->nullable(); $t->string('phone',30); $t->string('email')->nullable(); $t->text('address')->nullable(); $t->string('education')->nullable(); $t->foreignId('program_id')->nullable()->constrained()->nullOnDelete(); $t->string('japanese_level')->nullable(); $t->string('status')->default('baru')->index(); $t->text('notes')->nullable(); $t->timestamps(); }); } public function down():void{ Schema::dropIfExists('registrations'); } };
