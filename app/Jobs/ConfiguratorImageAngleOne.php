<?php
    
    namespace App\Jobs;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Foundation\Bus\Dispatchable;
    
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Cache;
    
    use App\Model\Product as Product;
    use App\Model\Configurator as Configurator;
    use App\Model\Image as Image;
    
    use Illuminate\Support\Facades\Log;
    
    class ConfiguratorImageAngleOne implements ShouldQueue
    {
        
        const imageWidth      = 1462;
        const imageHeight     = 1462;
        const imageBackground = 'white';
        const imageQuantum    = '65535';
        
        const originalResourcePath = 'images/original/';
        
        use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
        
        /**
         * Create a new job instance.
         *
         * @return void
         */
        public function __construct (Product $product)
        {
            $this->product = $product;
        }
        
        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle ()
        {
            
            $product = $this->product;
            Log::info('Running Angle 2');
            
            $this->makeImage($product);
        }
        
        public function makeImage ($product)
        {
            
            $fileName       = $product['image_file_name'];
            $configuration  = json_decode($product['configuration'], true);
            $id             = $product['id'];
            $serializedName = $product['serialized_name'];
            
            $cacheKey = $serializedName;
            
            $imageContainer = new \Imagick();
            $imageContainer->newImage(self::imageWidth, self::imageHeight, self::imageBackground, 'jpg');
            
            //Base
            if ($configuration['style'] == 'dome') {
                $baseProductImage   = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'round' . DIRECTORY_SEPARATOR . 'base.png'));
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'round' . DIRECTORY_SEPARATOR . 'shadow.png'));
                
            } elseif ($configuration['style'] == 'flat') {
                $baseProductImage   = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'flat_base.png'));
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'shadow.png'));
                
            } elseif ($configuration['style'] == 'bevelEdge') {
                $baseProductImage   = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'angle_base.png'));
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'shadow.png'));
                
            } elseif ($configuration['style'] == 'stepEdge') {
                $baseProductImage   = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'step_base.png'));
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'shadow.png'));

            } elseif ($configuration['style'] == 'stepFlat') {
                $baseProductImage   = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'stepflat_base.png'));
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'shadow.png'));
            }
            
            $imageContainer->compositeImageGravity($baseProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            
            //Primary
            if ($configuration['style'] == 'dome') {
                $this->generateColorImage($cacheKey, $imageContainer, 'primary', $configuration['primaryColor'], 'round');
            } elseif ($configuration['style'] == 'stepFlat') {
                $this->generateColorImage($cacheKey, $imageContainer, 'stepflat_primary', $configuration['primaryColor'], 'flat');
            }
            
            //Shank
            if ($configuration['style'] == 'dome') {
                $this->generateColorImage($cacheKey, $imageContainer, 'shank', $configuration['shankColor'], 'round');
            } elseif ($configuration['style'] == 'flat') {
                $this->generateColorImage($cacheKey, $imageContainer, 'shank', $configuration['shankColor'], 'flat');
            } elseif ($configuration['style'] == 'bevelEdge') {
                $this->generateColorImage($cacheKey, $imageContainer, 'angle_shank', $configuration['shankColor'], 'flat');
            } elseif ($configuration['style'] == 'stepEdge') {
                $this->generateColorImage($cacheKey, $imageContainer, 'step_shank', $configuration['shankColor'], 'flat');
            } elseif ($configuration['style'] == 'stepFlat') {
                $this->generateColorImage($cacheKey, $imageContainer, 'stepflat_shank', $configuration['shankColor'], 'flat');
            }
            
            //Edge
            if ($configuration['style'] == 'dome') {
                $this->generateColorImage($cacheKey, $imageContainer, 'edge', $configuration['edgeColor'], 'round');
            } elseif ($configuration['style'] == 'flat') {
                $this->generateColorImage($cacheKey, $imageContainer, 'edge', $configuration['edgeColor'], 'flat');
            } elseif ($configuration['style'] == 'bevelEdge') {
                $this->generateColorImage($cacheKey, $imageContainer, 'angle_edge', $configuration['edgeColor'], 'flat');
            } elseif ($configuration['style'] == 'stepEdge') {
                $this->generateColorImage($cacheKey, $imageContainer, 'step_edge', $configuration['edgeColor'], 'flat');
            }elseif ($configuration['style'] == 'stepFlat') {
                $this->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge', $configuration['edgeColor'], 'flat');
                $this->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge-edge', $configuration['edgeEdgeColor'], 'flat');
            }

            if ($configuration['style'] == 'stepFlat' && $configuration['edgeEdgeColor'] != 'white'){
                $this->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge-edge', $configuration['edgeEdgeColor'], 'flat');
            }
    
            
            //Shadow
            if ($configuration['style'] == 'dome') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'round' . DIRECTORY_SEPARATOR . 'shadow.png'));
            } elseif ($configuration['style'] == 'flat') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'shadow.png'));
            } elseif ($configuration['style'] == 'bevelEdge') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'angle_base-shadow.png'));
            } elseif ($configuration['style'] == 'stepEdge') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'step_base-shadow.png'));
            } elseif ($configuration['style'] == 'stepFlat') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR . 'stepflat_base-shadow.png'));
            }
    
            $imageContainer->compositeImageGravity($shadowProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
    
    
            $imageContainer->resizeImage(1000, 1000, \Imagick::FILTER_HANNING, 1, true);
            $imageContainer->writeImage(storage_path('app/public/angle2/') . $fileName);
            
        }
        
        protected function generateColorImage ($cacheKey, $imageContainer, $section, $color, $style)
        {
            $cacheKeyFinal = $cacheKey . 'angle2' . '-' . $style . '-' . $section . '-' . $color;
            
            if (Cache::has($cacheKeyFinal)) {
                $image = new \Imagick();
                $image->readImageBlob(Cache::get($cacheKeyFinal));
                $imageContainer->compositeImageGravity($image, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
                
                return $imageContainer;
            } else {
                $sectionBaseImage = resource_path(self::originalResourcePath . 'angle2' . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . 'base/' . $section . '.png');
                
                $baseImage = new \Imagick($sectionBaseImage);
                $baseImage->setSize(self::imageWidth, self::imageHeight);
                
                $newColor = Image::getColor($color);
                $levels   = Image::getLevelsBasedOnColor($color);
                
                $colorImage = new \Imagick();
                $colorImage->newImage(self::imageWidth, self::imageHeight, $newColor);
                $colorImage->setImageFormat("jpg");
                $colorImage->setImageMatte(1);
                $colorImage->compositeImage($baseImage, \Imagick::COMPOSITE_DSTIN, 0, 0);
                
                $baseImage->compositeImageGravity($colorImage, \Imagick::COMPOSITE_MULTIPLY, \Imagick::GRAVITY_CENTER);
                
                $baseImage->levelImage($levels[0], $levels[1], $levels[2]);
                
                $baseImage->writeImage(storage_path('app/public/cache2/') . $cacheKeyFinal . '.png');
                Cache::put($cacheKeyFinal, Storage::disk('public')->get('cache2/' . $cacheKeyFinal . '.png'), '60');
                
                $imageContainer->compositeImageGravity($baseImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
                
                return $imageContainer;
            }
        }
    }
