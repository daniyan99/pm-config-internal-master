<?php

    namespace App\Model;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Support\Facades\Storage as Storage;
    use App\Model\Product as Product;
    use App\Model\Image as Image;

    class Configurator extends Model
    {
        //DEFAULT CONFIGURATION VALUES
        const style          = 'dome';
        const primaryColor   = 'white';
        const edgeColor      = 'white';
        const edgeEdgeColor  = 'white';
        const shankColor     = 'white';
        const accent         = NULL;
        const accentLine     = 'center';
        const accentColor    = 'white';
        const accentColorTwo = 'white';
        const twoTone        = 'no';
        const position       = 'left';
        const width          = '6';

        protected static function createNewConfiguration ($request)
        {
            //Image::makeAngleTwo($request);
            return Image::makeImage($request);
            // self::makeImage('angle2', $queryConfiguration, $fileName);
            // self::makeImage('angle4', $queryConfiguration, $fileName);
        }

        /**
         * @param $request
         *
         * @return array
         *              Takes the default values and merges it with any request queries made
         *              This will make sure that the first load of a blank product will return an product
         */
        protected static function queryConfiguration ($request)
        {
            $configuration = [
                'style'          => $request->query('style') ? $request->query('style') : self::style,
                'primaryColor'   => $request->query('primaryColor') ? $request->query('primaryColor') : self::primaryColor,
                'edgeColor'      => $request->query('edgeColor') ? $request->query('edgeColor') : self::edgeColor,
                'edgeEdgeColor'  => $request->query('edgeEdgeColor') ? $request->query('edgeEdgeColor') : self::edgeEdgeColor,
                'shankColor'     => $request->query('shankColor') ? $request->query('shankColor') : self::shankColor,
                'accent'         => $request->query('accent') ? $request->query('accent') : self::accent,
                'accentLine'     => $request->query('accentLine') ? $request->query('accentLine') : self::accentLine,
                'twoTone'        => $request->query('twoTone') ? $request->query('twoTone') : self::twoTone,
                'position'       => $request->query('position') ? $request->query('position') : self::position,
                'accentColor'    => $request->query('accentColor') ? $request->query('accentColor') : self::accentColor,
                'accentColorTwo' => $request->query('accentColorTwo') ? $request->query('accentColorTwo') : self::accentColorTwo,
                'width'          => $request->query('width') ? $request->query('width') : self::width,
            ];

            return $configuration;
        }

        /**
         * @param $request
         *
         * @return string
         *               Take the request of all the configuration models and generates a unique MD5 Serialized number from it
         *               Each unique configuration will render a unique number, but the same configuration will always spit out the same number
         */
        protected static function serializedName ($request)
        {
            $queryConfiguration = static::queryConfiguration($request);

            return md5(serialize($queryConfiguration));
        }

        protected static function generateFileName ($request)
        {
            $queryConfiguration = static::queryConfiguration($request);
            $style              = self::getFileNameCode('style', $queryConfiguration['style']);
            $primary            = self::getFileNameCode('color', $queryConfiguration['primaryColor']);
            $edge               = self::getFileNameCode('color', $queryConfiguration['edgeColor']);
            $edgeEdge           = self::getFileNameCode('color', $queryConfiguration['edgeEdgeColor']);
            $shank              = self::getFileNameCode('color', $queryConfiguration['shankColor']);
            $accent             = self::getFileNameCode('accent', $queryConfiguration['accent']);
            $accentLine         = self::getFileNameCode('accentLine', $queryConfiguration['accentLine']);
            $accentColor        = self::getFileNameCode('color', $queryConfiguration['accentColor']);
            $accentColorTwo     = self::getFileNameCode('color', $queryConfiguration['accentColor']);
            $twoTone            = self::getFileNameCode('twoTone', $queryConfiguration['twoTone']);
            $position           = self::getFileNameCode('position', $queryConfiguration['position']);

            return $style . '-' . $primary . '-' . $edge . '-' . $edgeEdge . '-' . $shank . '-' . $accent . '-' . $accentLine . '-' . $accentColor . '-' . $accentColorTwo . '-' . $twoTone . '-' . $position . '-'
                . $queryConfiguration['width'];
        }

        protected static function getFileNameCode ($section, $change)
        {
            if ($section == 'style') {
                switch ($change) {
                    case 'dome':
                        return 'RD';
                        break;
                    case 'flat':
                        return 'FL';
                        break;
                    case 'bevelEdge':
                        return 'BE';
                        break;
                    case 'stepEdge':
                        return 'SE';
                        break;
                    case 'stepFlat';
                        return 'SF';
                        break;
                    default:
                        return 'RD';
                        break;
                }
            } elseif ($section == 'color') {
                switch ($change) {
                    case 'red':
                        return 'CA';
                        break;
                    case 'purple':
                        return 'RB';
                        break;
                    case 'fuschia':
                        return 'CF';
                        break;
                    case 'green':
                        return 'EZ';
                        break;
                    case 'teal':
                        return 'AT';
                        break;
                    case 'copper':
                        return 'CS';
                        break;
                    case 'blue':
                        return 'EB';
                        break;
                    case 'gunmetal':
                        return 'MG';
                        break;
                    case 'black':
                        return 'DN';
                        break;
                    case 'yellowGold':
                        return 'YG';
                        break;
                    case 'roseGold':
                        return 'RG';
                        break;
                    default:
                        return 'GG';
                        break;
                }
            } elseif ($section == 'accent') {
                switch ($change) {
                    case 'thin':
                        return 'TH';
                        break;
                    case 'thick':
                        return 'TK';
                        break;
                    default:
                        return 'NA';
                        break;
                }
            } elseif ($section == 'accentLine') {
                switch ($change) {
                    case 'center':
                        return 'CT';
                        break;
                    case 'offset':
                        return 'OF';
                        break;
                    case 'double':
                        return 'DD';
                        break;
                    default:
                        return 'NA';
                        break;
                }
            } elseif ($section == 'twoTone') {
                switch ($change) {
                    case 'yes':
                        return 'TT';
                        break;
                    default:
                        return 'NA';
                        break;
                }
            } elseif ($section == 'position') {
                switch ($change) {
                    case 'right':
                        return 'RT';
                        break;
                    default:
                        return 'LT';
                        break;
                }
            }
        }

        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        protected function createDirectoryIfItDoesntExist ($width, $style, $section = NULL)
        {
            $storagePath = 'public/builder/' . $width . DIRECTORY_SEPARATOR . $style . DIRECTORY_SEPARATOR . $section . DIRECTORY_SEPARATOR;
            if ( ! Storage::directories($storagePath)) {
                Storage::makeDirectory($storagePath);
            };

            return;
        }

    }
