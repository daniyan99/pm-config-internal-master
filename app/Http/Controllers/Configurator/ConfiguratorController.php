<?php
    
    namespace App\Http\Controllers\Configurator;
    
    use App\Model\Configurator;
    use App\Model\Image as Image;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    
    class ConfiguratorController extends Controller
    {
        //
        
        public function index ()
        {
            return view('configurator.index', ['name' => 'Configurator']);
        }
        
        public function preloadImages (Request $request)
        {
            return Image::preloadImages($request);
        }
        
        public function getImageBasedOnRequest (Request $request)
        {
            
            $image = Configurator::getRequestedImage($request);
            
            return $image;
            
        }
        
    }
