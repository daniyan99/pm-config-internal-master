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
    
    class ConfiguratorImageAngleTwo implements ShouldQueue
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
            Log::info('Running Angle 3');
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
            
            //PRIMARY
            if ($configuration['style'] == 'dome') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $imageContainer, 'primary', $configuration['primaryColor'], 'round', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'primary_accent_thin_center', $configuration['primaryColor'], 'round', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'primary_accent_thin_offset', $configuration['primaryColor'], 'round', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'primary_accent_thin_double', $configuration['primaryColor'], 'round', $configuration['width']);
                    }
                }
            } elseif ($configuration['style'] == 'flat') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $imageContainer, 'primary', $configuration['primaryColor'], 'flat', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'primary_accent_thin_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'primary_accent_thin_offset', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'primary_accent_thin_double', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                }
            } elseif ($configuration['style'] == 'bevelEdge') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary', $configuration['primaryColor'], 'flat', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_accent_thin_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_accent_thin_offset', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_accent_thin_double', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                } elseif ($configuration['accent'] == 'thick') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_accent_thick_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                }
            } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $imageContainer, 'step_primary', $configuration['primaryColor'], 'flat', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_accent_thin_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_accent_thin_offset', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_accent_thin_double', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                }
            }
            
            //Two Tone
            if ($configuration['twoTone'] == 'yes') {
                if ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        if ($configuration['style'] == 'dome') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_center_left', 'white', 'round', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_center_right', 'white', 'round', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'flat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_center_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_center_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'bevelEdge') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_thin_center_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_thin_center_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_thin_center_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_thin_center_right', 'white', 'flat', $configuration['width']);
                            }
                        }
                    } elseif ($configuration['accentLine'] == 'offset') {
                        if ($configuration['style'] == 'dome') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_offset_left', 'white', 'round', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_offset_right', 'white', 'round', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'flat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'bevelEdge') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'angle_primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $imageContainer, 'step_primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        }
                    }
                }
            }
            
            //Accent
            if ($configuration['accent'] == 'thin') {
                if ($configuration['accentLine'] == 'center') {
                    if ($configuration['style'] == 'dome') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'accent_thin_center', $configuration['accentColor'], 'round', $configuration['width']);
                    } elseif ($configuration['style'] == 'flat') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'accent_thin_center', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_accent_thin_center', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'step_accent_thin_center', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                } elseif ($configuration['accentLine'] == 'offset') {
                    if ($configuration['style'] == 'dome') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'accent_thin_offset', $configuration['accentColor'], 'round', $configuration['width']);
                    } elseif ($configuration['style'] == 'flat') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'accent_thin_offset', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_accent_thin_offset', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'step_accent_thin_offset', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                } elseif ($configuration['accentLine'] == 'double') {
                    if ($configuration['style'] == 'dome') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'accent_thin_double', $configuration['accentColor'], 'round', $configuration['width']);
                    } elseif ($configuration['style'] == 'flat') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'accent_thin_double', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'angle_accent_thin_double', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'step_accent_thin_double', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                }
            } elseif ($configuration['accent'] == 'thick') {
                if ($configuration['accentLine'] == 'center') {
                    if ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $imageContainer, 'thick_accent', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                }
            }
            
            //Edge
            if ($configuration['style'] == 'bevelEdge') {
                $this->generateColorImage($cacheKey, $imageContainer, 'angle_edge', $configuration['edgeColor'], 'flat', $configuration['width']);
            } elseif ($configuration['style'] == 'stepEdge') {
                $this->generateColorImage($cacheKey, $imageContainer, 'step_edge', $configuration['edgeColor'], 'flat', $configuration['width']);
            } elseif ($configuration['style'] == 'stepFlat') {
                $this->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge', $configuration['edgeColor'], 'flat', $configuration['width']);
            }
            
            //Shadow
            if ($configuration['style'] == 'dome') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle3' . DIRECTORY_SEPARATOR . $configuration['width'] . DIRECTORY_SEPARATOR . 'round' . DIRECTORY_SEPARATOR
                    . 'shadow.png'));
            } elseif ($configuration['style'] == 'flat') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle3' . DIRECTORY_SEPARATOR . $configuration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'shadow.png'));
            } elseif ($configuration['style'] == 'bevelEdge') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle3' . DIRECTORY_SEPARATOR . $configuration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'angle_base-shadow.png'));
            } elseif ($configuration['style'] == 'stepEdge') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle3' . DIRECTORY_SEPARATOR . $configuration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'step_base-shadow.png'));
            } elseif ($configuration['style'] == 'stepFlat') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'angle3' . DIRECTORY_SEPARATOR . $configuration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'stepflat_base-shadow.png'));
            }
            
            $imageContainer->compositeImageGravity($shadowProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            
            $imageContainer->resizeImage(1000, 1000, \Imagick::FILTER_HANNING, 1, true);
            $imageContainer->writeImage(storage_path('app/public/angle3/') . $fileName);
            
        }
        
        public function generateColorImage ($cacheKey, $imageContainer, $section, $color, $style, $width)
        {
            $cacheKeyFinal = $cacheKey . 'angle3' . '-' . $style . '-' . $section . '-' . $color . '-' . $width;
            
            if (Cache::has($cacheKeyFinal)) {
                $image = new \Imagick();
                $image->readImageBlob(Cache::get($cacheKeyFinal));
                $imageContainer->compositeImageGravity($image, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
                
                return $imageContainer;
            } else {
                $sectionBaseImage = resource_path(self::originalResourcePath . 'angle3' . DIRECTORY_SEPARATOR . $width . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . 'base/' . $section . '.png');
                
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
                
                $baseImage->writeImage(storage_path('app/public/cache3/') . $cacheKeyFinal . '.png');
                Cache::put($cacheKeyFinal, Storage::disk('public')->get('cache3/' . $cacheKeyFinal . '.png'), '60');
                
                $imageContainer->compositeImageGravity($baseImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
                
                return $imageContainer;
            }
        }
    }
