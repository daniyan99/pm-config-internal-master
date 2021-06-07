<?php
    
    namespace App\Model;
    
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use App\Jobs\ConfiguratorImageAngleOne;
    use App\Jobs\ConfiguratorImageAngleTwo;
    use App\Jobs\ConfiguratorImageAngleThree;
    
    use App\Traits\UuidModel;
    use App\Model\Configurator as Configurator;
    
    class Product extends Model
    {
        
        use UuidModel;
        
        protected $table        = 'products';
        public    $primaryKey   = 'id';
        public    $incrementing = false;
        protected $guarded      = ['id', 'created_at', 'updated_at'];
        
        /**
         * @param $request
         *
         * @return mixed
         *              This is what triggers the configurator
         *              What we do here is take the request and see if it exists as a product in the database
         *              If it does exist then return the product to us
         *              If it doesn't exist then lets create a new product and the images that go with it
         */
        public static function getConfiguredProduct ($request)
        {
            $serializedName = Configurator::serializedName($request);
//            try {
  //              return Product::where('serialized_name', $serializedName)->firstOrFail();
    //        } catch (ModelNotFoundException $e) {
                
                $newProduct = new Product();
                
                $newProduct->name            = configurator::generateFileName($request);
                $newProduct->serialized_name = configurator::serializedName($request);
                $newProduct->configuration   = json_encode(configurator::queryConfiguration($request));
                $newProduct->image_file_name = configurator::generateFileName($request) . '.jpg';
                $newProduct->save();
                
                Configurator::createNewConfiguration($request);
                
                ConfiguratorImageAngleOne::dispatchNow($newProduct);
                ConfiguratorImageAngleTwo::dispatchNow($newProduct);
                ConfiguratorImageAngleThree::dispatchNow($newProduct);
                
                return $newProduct;
      //      }
        }
        
        public static function getPreviewImage ()
        {
            return Product::first();
        }
        
    }
