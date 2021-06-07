<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Cache;
    use App\Http\Resources\PreloadImages as PreloadImagesResource;
    use App\Model\Configurator as Configurator;

    class Image extends Model
    {

        const imageWidth      = 1462;
        const imageHeight     = 1462;
        const imageBackground = 'white';
        const imageQuantum    = '65535';

        const originalResourcePath = 'images/original/';

        static private $cache = [];

        protected static function preloadImages ($request)
        {
            $width  = $request->query('width') ? $request->query('width') : 6;
            $images = Storage::disk('builder')->allFiles($width);

            return new PreloadImagesResource($images);
        }

        protected static function makeImage ($request)
        {
            $cacheKey           = Configurator::serializedName($request);
            $queryConfiguration = Configurator::queryConfiguration($request);
            $fileName           = Configurator::generateFileName($request);
            $image              = new Image();
            $baseImageContainer = new \Imagick();
            $baseImageContainer->newImage(1000, 1000, 'white', 'jpg');
            $imageContainer = new \Imagick();
            $imageContainer->newImage(self::imageWidth, self::imageHeight, self::imageBackground, 'jpg');
            //Base
            if ($queryConfiguration['style'] == 'dome') {
                $baseProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'round' . DIRECTORY_SEPARATOR
                    . 'base.png'));
            } elseif ($queryConfiguration['style'] == 'flat') {
                $baseProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'flat_base.png'));
            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                $baseProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'angle_base.png'));
            } elseif ($queryConfiguration['style'] == 'stepEdge') {
                $baseProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'step_base.png'));
            } elseif ($queryConfiguration['style'] == 'stepFlat') {
                $baseProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'stepflat_base.png'));
            }
            $imageContainer->compositeImageGravity($baseProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            //Primary
            if ($queryConfiguration['style'] == 'dome') {
                $image->generateColorImage($cacheKey, $imageContainer, 'primary', $queryConfiguration['primaryColor'], $queryConfiguration['width'], 'round');
            } elseif ($queryConfiguration['style'] == 'flat') {
                $image->generateColorImage($cacheKey, $imageContainer, 'flat_primary', $queryConfiguration['primaryColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                $image->generateColorImage($cacheKey, $imageContainer, 'angle_primary', $queryConfiguration['primaryColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                $image->generateColorImage($cacheKey, $imageContainer, 'step_primary', $queryConfiguration['primaryColor'], $queryConfiguration['width'], 'flat');
            }
            //Shank
            if ($queryConfiguration['style'] == 'dome') {
                $image->generateColorImage($cacheKey, $imageContainer, 'shank', $queryConfiguration['shankColor'], $queryConfiguration['width'], 'round');
            } elseif ($queryConfiguration['style'] == 'flat') {
                $image->generateColorImage($cacheKey, $imageContainer, 'flat_shank', $queryConfiguration['shankColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                $image->generateColorImage($cacheKey, $imageContainer, 'angle_shank', $queryConfiguration['shankColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                $image->generateColorImage($cacheKey, $imageContainer, 'step_shank', $queryConfiguration['shankColor'], $queryConfiguration['width'], 'flat');
            }
            //Edge
            if ($queryConfiguration['style'] == 'dome') {
                $image->generateColorImage($cacheKey, $imageContainer, 'edge', $queryConfiguration['edgeColor'], $queryConfiguration['width'], 'round');
            } elseif ($queryConfiguration['style'] == 'flat') {
                $image->generateColorImage($cacheKey, $imageContainer, 'flat_edge', $queryConfiguration['edgeColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                $image->generateColorImage($cacheKey, $imageContainer, 'angle_edge', $queryConfiguration['edgeColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'stepEdge') {
                $image->generateColorImage($cacheKey, $imageContainer, 'step_edge', $queryConfiguration['edgeColor'], $queryConfiguration['width'], 'flat');
            } elseif ($queryConfiguration['style'] == 'stepFlat') {
                $image->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge', $queryConfiguration['edgeColor'], $queryConfiguration['width'], 'flat');
                $image->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge_edge', $queryConfiguration['edgeColor'], $queryConfiguration['width'], 'flat');
            }
            //EDGE EDGE
            if ($queryConfiguration['style'] == 'stepFlat' && $queryConfiguration['edgeEdgeColor'] != 'white') {
                $image->generateColorImage($cacheKey, $imageContainer, 'stepflat_edge_edge', $queryConfiguration['edgeEdgeColor'], $queryConfiguration['width'], 'flat');
            }
            //Two Tone
            if ($queryConfiguration['accent'] == 'thin' || $queryConfiguration['accent'] == 'thick') {
                if ($queryConfiguration['twoTone'] == 'yes') {
                    if ($queryConfiguration['accentLine'] == 'center') {
                        if ($queryConfiguration['position'] == 'left') {
                            if ($queryConfiguration['style'] == 'dome') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'brush_left_center', 'white', $queryConfiguration['width'], 'round');
                            } elseif ($queryConfiguration['style'] == 'flat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'flat_brush_left_center', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'angle_brush_left_center', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'step_brush_left_center', 'white', $queryConfiguration['width'], 'flat');
                            }
                        } elseif ($queryConfiguration['position'] == 'right') {
                            if ($queryConfiguration['style'] == 'dome') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'brush_right_center', 'white', $queryConfiguration['width'], 'round');
                            } elseif ($queryConfiguration['style'] == 'flat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'flat_brush_right_center', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'angle_brush_right_center', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'step_brush_right_center', 'white', $queryConfiguration['width'], 'flat');
                            }
                        }
                    } elseif ($queryConfiguration['accentLine'] == 'offset') {
                        if ($queryConfiguration['position'] == 'left') {
                            if ($queryConfiguration['style'] == 'dome') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'brush_left_offset', 'white', $queryConfiguration['width'], 'round');
                            } elseif ($queryConfiguration['style'] == 'flat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'flat_brush_left_offset', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'angle_brush_left_offset', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'step_brush_left_offset', 'white', $queryConfiguration['width'], 'flat');
                            }
                        } elseif ($queryConfiguration['position'] == 'right') {
                            if ($queryConfiguration['style'] == 'dome') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'brush_right_offset', 'white', $queryConfiguration['width'], 'round');
                            } elseif ($queryConfiguration['style'] == 'flat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'flat_brush_right_offset', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'angle_brush_right_offset', 'white', $queryConfiguration['width'], 'flat');
                            } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                                $image->generateColorImage($cacheKey, $imageContainer, 'step_brush_right_offset', 'white', $queryConfiguration['width'], 'flat');
                            }
                        }
                    }
                }
            }
            //Accent
            if ($queryConfiguration['accent'] == 'thin') {
                if ($queryConfiguration['accentLine'] == 'center') {
                    if ($queryConfiguration['style'] == 'dome') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'accent_thin_center', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'round');
                    } elseif ($queryConfiguration['style'] == 'flat') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'accent_thin_center', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'angle_accent_thin_center', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'step_accent_thin_center', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    }
                } elseif ($queryConfiguration['accentLine'] == 'offset') {
                    if ($queryConfiguration['style'] == 'dome') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'accent_thin_offset', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'round');
                    } elseif ($queryConfiguration['style'] == 'flat') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'accent_thin_offset', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'angle_accent_thin_offset', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'step_accent_thin_offset', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    }
                } elseif ($queryConfiguration['accentLine'] == 'double') {
                    if ($queryConfiguration['style'] == 'dome') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'accent_thin_double', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'round');
                    } elseif ($queryConfiguration['style'] == 'flat') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'accent_thin_double', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'angle_accent_thin_double', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    } elseif ($queryConfiguration['style'] == 'stepEdge' || $queryConfiguration['style'] == 'stepFlat') {
                        $image->generateColorImage($cacheKey, $imageContainer, 'step_accent_thin_double', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                    }
                }
            } elseif ($queryConfiguration['accent'] == 'thick') {
                if ($queryConfiguration['style'] == 'bevelEdge') {
                    $image->generateColorImage($cacheKey, $imageContainer, 'thick_accent', $queryConfiguration['accentColor'], $queryConfiguration['width'], 'flat');
                }
            }
            if ($queryConfiguration['style'] == 'dome') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'round' . DIRECTORY_SEPARATOR
                    . 'shadow.png'));
            } elseif ($queryConfiguration['style'] == 'flat') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'shadow.png'));
            } elseif ($queryConfiguration['style'] == 'bevelEdge') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'angle_base-shadow.png'));
            } elseif ($queryConfiguration['style'] == 'stepEdge') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'step_base-shadow.png'));
            } elseif ($queryConfiguration['style'] == 'stepFlat') {
                $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . 'flat' . DIRECTORY_SEPARATOR
                    . 'stepflat_base-shadow.png'));
            }
            $imageContainer->compositeImageGravity($shadowProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            $imageContainer->resizeImage(1270, 1270, \Imagick::FILTER_HANNING, 1, TRUE);
            $baseImageContainer->compositeImageGravity($imageContainer, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            $baseImageContainer->shaveImage(125, 0);
            $baseImageContainer->writeImage(storage_path('app/public/render/') . $fileName . '.jpg');
            // $imageContainer->shaveImage(125,0);
            // $imageContainer->writeImage(storage_path('app/public/render/') . $fileName . '.jpg');
            return;
        }

        protected function generateBaseImage ($imageContainer, $queryConfiguration, $options)
        {
            $baseProductImage   = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . $queryConfiguration['style']
                . DIRECTORY_SEPARATOR . 'base.png'));
            $shadowProductImage = new \Imagick(resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $queryConfiguration['width'] . DIRECTORY_SEPARATOR . $queryConfiguration['style']
                . DIRECTORY_SEPARATOR . 'shadow.png'));
            $shadowProductImage->compositeImageGravity($baseProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);
            $imageContainer->compositeImageGravity($shadowProductImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);

            return $imageContainer;
        }

        protected function generateColorImage ($cacheKey, $imageContainer, $section, $color, $width, $style)
        {
            $cacheKeyFinal = $cacheKey . '-' . $style . '-' . $section . '-' . $color . '-' . $width;
            if (Cache::has($cacheKeyFinal)) {
                $image = new \Imagick();
                $image->readImageBlob(Cache::get($cacheKeyFinal));
                $imageContainer->compositeImageGravity($image, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);

                return $imageContainer;
            } else {
                $sectionBaseImage = resource_path(self::originalResourcePath . 'base' . DIRECTORY_SEPARATOR . $width . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . 'base/' . $section . '.png');
                $baseImage        = new \Imagick($sectionBaseImage);
                $iWidth           = $baseImage->getImageWidth();
                $iHeight          = $baseImage->getImageHeight();
                $newColor         = $this->getColor($color);
                $levels           = $this->getLevelsBasedOnColor($color);
                $colorImage       = new \Imagick();
                $colorImage->newImage($iWidth, $iHeight, $newColor);
                $colorImage->setImageFormat("jpg");
                $colorImage->setImageMatte(1);
                $colorImage->compositeImage($baseImage, \Imagick::COMPOSITE_DSTIN, 0, 0);
                $baseImage->compositeImageGravity($colorImage, \Imagick::COMPOSITE_MULTIPLY, \Imagick::GRAVITY_CENTER);
                $baseImage->levelImage($levels[0], $levels[1], $levels[2]);
                // $baseImage->resizeImage((($iWidth * 90) * .01), (($iHeight * 90) * .01), \Imagick::FILTER_TRIANGLE, 1);
                // $baseImage->blurImage(0.1, 0.1);
                $baseImage->writeImage(storage_path('app/public/cache/') . $cacheKeyFinal . '.png');
                Cache::put($cacheKeyFinal, Storage::disk('public')->get('cache/' . $cacheKeyFinal . '.png'), '60');
                // Cache::put($cacheKeyFinal, serialize($baseImage), '10');
                $imageContainer->compositeImageGravity($baseImage, \Imagick::COMPOSITE_DEFAULT, \Imagick::GRAVITY_CENTER);

                return $imageContainer;
            }
        }

        protected function getColor ($color)
        {
            switch ($color) {
                case 'red':
                    return '#c32247'; //#e86767
                    break;
                case 'purple':
                    return '#5b2e8e';
                    break;
                case 'fuschia':
                    return '#9d2463';
                    break;
                case 'green':
                    return '#008752';
                    break;
                case 'teal':
                    return '#008982';
                    break;
                case 'copper':
                    return '#8a572e';
                    break;
                case 'blue':
                    return '#425d78';
                    break;
                case 'gunmetal':
                    return '#746f62';
                    break;
                case 'black':
                    return '#4a4948';
                    break;
                case 'yellowGold':
                    return '#dbb36d';
                    break;
                case 'roseGold':
                    return '#cb9e7f';
                    break;
                default:
                    return '#ffffff';
                    break;
            }
        }

        protected function getLevelsBasedOnColor ($color)
        {
            switch ($color) {
                case 'red':
                    $levels = array(23, 0.91, 255);
                    break;
                case 'purple':
                    $levels = array(23, 0.96, 217);
                    break;
                case 'fuschia':
                    $levels = array(23, 0.85, 195);
                    break;
                case 'green':
                    $levels = array(23, 0.86, 207);
                    break;
                case 'teal':
                    $levels = array(23, 0.95, 203);
                    break;
                case 'copper':
                    $levels = array(23, 0.95, 203);
                    break;
                case 'blue':
                    $levels = array(32, 0.90, 164);
                    break;
                case 'gunmetal':
                    $levels = array(23, 0.85, 191);
                    break;
                case 'black':
                    $levels = array(23, 0.90, 159);
                    break;
                case 'yellowGold':
                    $levels = array(23, 1.52, 181);
                    break;
                case 'roseGold':
                    $levels = array(23, 1.56, 185);
                    break;
                default:
                    $levels = array(0, 1, 255);
                    break;
            }
            $quamtumLevels = $this->quantamizePhotoshopLevelsData($levels);

            return $quamtumLevels;
        }

        protected function quantamizePhotoshopLevelsData ($levels)
        {
            $blackPoint = (self::imageQuantum * $levels[0]) / 255;
            $gamma      = $levels[1];
            $whitePoint = (self::imageQuantum * $levels[2] / 255);

            return array($blackPoint, $gamma, $whitePoint);
        }

    }
