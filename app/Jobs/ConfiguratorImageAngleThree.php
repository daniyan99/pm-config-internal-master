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
    
    class ConfiguratorImageAngleThree implements ShouldQueue
    {
        
        const imageWidth      = 1462;
        const imageHeight     = 1462;
        const imageBackground = 'transparent';
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
            Log::info('Running Angle 4');
            $this->makeImage($product);
        }
        
        public function makeImage ($product)
        {
            
            $fileName       = $product['name'];
            $configuration  = json_decode($product['configuration'], true);
            $id             = $product['id'];
            $serializedName = $product['serialized_name'];
    
            $cacheKey = $serializedName;
    
            $hands = new \Imagick(resource_path(self::originalResourcePath . 'angle4' . DIRECTORY_SEPARATOR . 'base.png'));
            
            $primary = new \Imagick();
            $primary->newImage(self::imageWidth, self::imageHeight, 'transparent', 'png');
            
            //Primary
            if ($configuration['style'] == 'dome') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $primary, 'primary', $configuration['primaryColor'], 'round', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $primary, 'primary_accent_thin_center', $configuration['primaryColor'], 'round', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $primary, 'primary_accent_thin_offset', $configuration['primaryColor'], 'round', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $primary, 'primary_accent_thin_double', $configuration['primaryColor'], 'round', $configuration['width']);
                    }
                }
            } elseif ($configuration['style'] == 'flat') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $primary, 'primary', $configuration['primaryColor'], 'flat', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $primary, 'primary_accent_thin_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $primary, 'primary_accent_thin_offset', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $primary, 'primary_accent_thin_double', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                }
            } elseif ($configuration['style'] == 'bevelEdge') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $primary, 'angle_primary', $configuration['primaryColor'], 'flat', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $primary, 'angle_primary_accent_thin_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $primary, 'angle_primary_accent_thin_offset', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $primary, 'angle_primary_accent_thin_double', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                } elseif ($configuration['accent'] == 'thick') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $primary, 'angle_primary_accent_thick_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                }
            } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                if ($configuration['accent'] == 'none' || $configuration['accent'] == null) {
                    $this->generateColorImage($cacheKey, $primary, 'step_primary', $configuration['primaryColor'], 'flat', $configuration['width']);
                } elseif ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        $this->generateColorImage($cacheKey, $primary, 'step_primary_accent_thin_center', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'offset') {
                        $this->generateColorImage($cacheKey, $primary, 'step_primary_accent_thin_offset', $configuration['primaryColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['accentLine'] == 'double') {
                        $this->generateColorImage($cacheKey, $primary, 'step_primary_accent_thin_double', $configuration['primaryColor'], 'flat', $configuration['width']);
                    }
                }
            }
    
            
    
            $edge = new \Imagick();
            $edge->newImage(self::imageWidth, self::imageHeight, 'transparent', 'png');
            if ($configuration['style'] == 'bevelEdge') {
                $this->generateColorImage($cacheKey, $edge, 'angle_edge', $configuration['edgeColor'], 'flat', $configuration['width']);
            } elseif ($configuration['style'] == 'stepEdge') {
                $this->generateColorImage($cacheKey, $edge, 'step_edge', $configuration['edgeColor'], 'flat', $configuration['width']);
            } elseif ($configuration['style'] == 'stepFlat') {
                $this->generateColorImage($cacheKey, $edge, 'stepflat_edge', $configuration['edgeColor'], 'flat', $configuration['width']);
            }
            
            
            $twoTone = new \Imagick();
            $twoTone->newImage(self::imageWidth, self::imageHeight, 'transparent', 'png');
            if ($configuration['twoTone'] == 'yes') {
                if ($configuration['accent'] == 'thin') {
                    if ($configuration['accentLine'] == 'center') {
                        if ($configuration['style'] == 'dome') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_center_left', 'white', 'round', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_center_right', 'white', 'round', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'flat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_center_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_center_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'bevelEdge') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'angle_primary_thin_center_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'angle_primary_thin_center_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'step_primary_thin_center_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'step_primary_thin_center_right', 'white', 'flat', $configuration['width']);
                            }
                        }
                    } elseif ($configuration['accentLine'] == 'offset') {
                        if ($configuration['style'] == 'dome') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'flat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'bevelEdge') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'angle_primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'angle_primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'step_primary_thin_offset_left', 'white', 'flat', $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'step_primary_thin_offset_right', 'white', 'flat', $configuration['width']);
                            }
                        }
                    }
                } elseif ($configuration['accent'] == 'thick') {
                    if ($configuration['accentLine'] == 'center') {
                        if ($configuration['style'] == 'bevelEdge') {
                            if ($configuration['position'] == 'left') {
                                $this->generateColorImage($cacheKey, $twoTone, 'angle_primary_thick_center_left', 'white', $configuration['style'], $configuration['width']);
                            } elseif ($configuration['position'] == 'right') {
                                $this->generateColorImage($cacheKey, $twoTone, 'angle_primary_thick_center_right', 'white', $configuration['style'], $configuration['width']);
                            }
                        }
                    }
                }
            }
            
            $accent = new \Imagick();
            $accent->newImage(self::imageWidth, self::imageHeight, 'transparent', 'png');
            if ($configuration['accent'] == 'thin') {
                if ($configuration['accentLine'] == 'center') {
                    if ($configuration['style'] == 'dome') {
                        $this->generateColorImage($cacheKey, $accent, 'accent_thin_center', $configuration['accentColor'], 'round', $configuration['width']);
                    } elseif ($configuration['style'] == 'flat') {
                        $this->generateColorImage($cacheKey, $accent, 'accent_thin_center', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $accent, 'angle_accent_thin_center', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                        $this->generateColorImage($cacheKey, $accent, 'step_accent_thin_center', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                } elseif ($configuration['accentLine'] == 'offset') {
                    if ($configuration['style'] == 'dome') {
                        $this->generateColorImage($cacheKey, $accent, 'accent_thin_offset', $configuration['accentColor'], 'round', $configuration['width']);
                    } elseif ($configuration['style'] == 'flat') {
                        $this->generateColorImage($cacheKey, $accent, 'accent_thin_offset', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $accent, 'angle_accent_thin_offset', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                        $this->generateColorImage($cacheKey, $accent, 'step_accent_thin_offset', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                } elseif ($configuration['accentLine'] == 'double') {
                    if ($configuration['style'] == 'dome') {
                        $this->generateColorImage($cacheKey, $accent, 'accent_thin_double', $configuration['accentColor'], 'round', $configuration['width']);
                    } elseif ($configuration['style'] == 'flat') {
                        $this->generateColorImage($cacheKey, $accent, 'accent_thin_double', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $accent, 'angle_accent_thin_double', $configuration['accentColor'], 'flat', $configuration['width']);
                    } elseif ($configuration['style'] == 'stepEdge' || $configuration['style'] == 'stepFlat') {
                        $this->generateColorImage($cacheKey, $accent, 'step_accent_thin_double', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                }
            } elseif ($configuration['accent'] == 'thick') {
                if ($configuration['accentLine'] == 'center') {
                    if ($configuration['style'] == 'bevelEdge') {
                        $this->generateColorImage($cacheKey, $accent, 'thick_accent', $configuration['accentColor'], 'flat', $configuration['width']);
                    }
                }
            }
            
            
            $primary->compositeImageGravity($edge, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            $primary->compositeImageGravity($twoTone, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            $primary->compositeImageGravity($accent, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            
            $belig = new \Imagick();
            $belig->newImage(self::imageWidth, self::imageHeight, 'transparent', 'png');
    
            $belig->compositeImageGravity($primary, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
    
            
            $primary->resizeImage(176, 176, \Imagick::FILTER_BOX, 0.5);
            $primary->rotateImage('transparent', -4);
            $hands->compositeImage($primary, \Imagick::COMPOSITE_DEFAULT, 123, 475);
            
            
            $secondRing = clone $belig;
            
            $secondRing->resizeImage(168, 168, \Imagick::FILTER_BOX, 0.5);
            $secondRing->rotateImage('transparent', -9);
            $hands->compositeImage($secondRing, \Imagick::COMPOSITE_DEFAULT, 890, 568);
            $hands->setFormat('jpg');
            $hands->resizeImage(1000, 1000, \Imagick::FILTER_HANNING, 1, true);
            $hands->writeImage(storage_path('app/public/angle4/') . $fileName . '.jpg');
            
        }
    
        public function generateColorImage ($cacheKey, $imageContainer, $section, $color, $style, $width)
        {
            $cacheKeyFinal = $cacheKey . 'angle4' . '-' . $style . '-' . $section . '-' . $color;
        
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
            
                $baseImage->writeImage(storage_path('app/public/cache4/') . $cacheKeyFinal . '.png');
                Cache::put($cacheKeyFinal, Storage::disk('public')->get('cache4/' . $cacheKeyFinal . '.png'), '60');
            
                $imageContainer->addImage($baseImage);
            
                return $imageContainer;
            }
        }
        
    }
