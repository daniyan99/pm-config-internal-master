@extends('layouts.template.configurator')

@section('title', '- Configurator')

@push('styles')
    <link href="{{ asset('css/configurator/index.css') }}" rel="stylesheet">
@endpush



@section('content')

    @include('configurator.global.media')

    @include('configurator.global.sidebar')
@endsection


@push('scripts')
    <script src="{{ asset('js/configurator/sidebar.js') }}"></script>
    <script>
        var $sidebar = new sideBar({});
    </script>

   {{-- <script>

        var width = 1000;
        var height = 1000;


        var stage = new Konva.Stage({
            container: 'container',
            width: width,
            height: height,
        });



        var base = new Konva.Layer();



        var imageObj = new Image();
        imageObj.onload = function () {

            loadBeligImage();

        };
        imageObj.src = '/storage/original/6/round/base.png';

        var loadBeligImage = function() {

            var yoda = new Konva.Image({
                x: 0,
                y: 0,
                image: imageObj,
                centeredScaling: true,
            });

            // add the shape to the layer
            base.add(yoda);

            // add the layer to the stage
            stage.add(base);
        }





        var pImage = new Konva.Layer();
        var pImageObj = new Image();
        pImageObj.onload = function () {

            var primaryImage = new Konva.Image({
                x: 100,
                y: 0,
                image: pImageObj,
                centeredScaling: true,
            });

            // add the shape to the layer
            pImage.add(primaryImage);

            pImage.cache();

            // add the layer to the stage
            stage.add(pImage);
        };
        pImageObj.src = '/storage/original/6/round/base/primary.png';


        $('input[name="primaryColor"]').on('click touch', function (element) {
            $this = $(element.target);

            pImage.filters([Konva.Filters.RGB]);
            $color = $this.data('color');


            if ($color == 'blue') {
                pImage.red(48);
                pImage.blue(134);
                pImage.green(91);

            }

            if ($color == 'yellowGold') {
                pImage.red(219);
                pImage.blue(109);
                pImage.green(179);
            }

            pImage.batchDraw();
        });


    </script>--}}

@endpush
