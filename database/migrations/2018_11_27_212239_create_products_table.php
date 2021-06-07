<?php
    
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    class CreateProductsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up ()
        {
            Schema::create('products', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('name');
                $table->string('serialized_name')->nullable()->comment('md5 Serialized Name based on configuration');
                $table->json('configuration_images')->nullable();
                $table->json('configuration')->nullable();
                $table->string('image_file_name')->nullable()->comment('Rendered Image');
                $table->timestamps();
            });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down ()
        {
            Schema::dropIfExists('products');
        }
    }
