<?php
    
    namespace App\Http\Resources;
    
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Support\Facades\Storage;
    
    class PreloadImages extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return array
         */
        public function toArray ($request)
        {
            return parent::toArray($request);
        }
        
        public function with ($request)
        {
            return [
                'url' => '/storage/builder/',
            ];
        }
    }
