function sideBar(opts) {

    defautlOpts = {};

    $opts = $.extend(defautlOpts, opts, {});


    $opts.sideBarParentButton = $('.sideBar.sideBar-parent li');
    $opts.sideBarChildrenCloseBtn = $('.sideBar-level2 .sideBar-close');
    $opts.sideBarChildrenAcceptCancelBtn = $('.sideBar-level2 .acceptCancel');

    $opts.optionsChecked = $('[type=radio]:checked');

    var $step;

    var init = function () {

        bindClickEvents();

        preDownloadImagesCache();

        selectCheckedOptions();
    };


    var bindClickEvents = function () {
        //Click on the Section and open its child sidebar for options
        $opts.sideBarParentButton.on('click touch', function (element) {
            $this = $(element.target);
            $sideBarAttribute = $this.attr('data-sidebar');
            $('#' + $sideBarAttribute).addClass('open');

            $step = parseInt($('#' + $sideBarAttribute).attr('data-step'));

            toggleSideBarOverflow('on');
        });

        //Click on the Child sidebar close button and close the window
        $opts.sideBarChildrenCloseBtn.on('click touch', function (element) {
            $this = $(element.target);
            $this.parents('.sideBar-level2').removeClass('open');
            toggleSideBarOverflow('off');
        });


        $(':radio').on('click touch', function () {
            $(this).parents('li').addClass('selected');
            $(this).parents('li').siblings().removeClass('selected');

            $serializeArray = $('#formArray :radio').serializeArray();
            console.log($('#formArray :radio').serializeArray());

            submitRequest($serializeArray);
        });


        /**
         * Click on the cancel button in the child sidebar to close the window
         * This will also try to cancel and changes made to the product  -- maybe
         */
        $opts.sideBarChildrenAcceptCancelBtn.on('click touch', function (element) {
            $this = $(element.target);

            if ($this.attr('class') == 'cancel') {
                $this.parents('.sideBar-level2').removeClass('open');
                toggleSideBarOverflow('off');
            }

            if ($this.attr('class') == 'accept') {
                $this.parents('.sideBar-level2').removeClass('open');
                toggleSideBarOverflow('off');
            }

            if ($this.attr('class') == 'next') {
                $step = parseInt($step) + 1;
                $this.parents('.sideBar-level2').removeClass('open');
                $this.parents('.sideBar-level2').siblings("[data-step='" + $step + "']").addClass('open');

            }
        });


    };


    var toggleSideBarOverflow = function ($status) {
        if ($status == 'on') {
            $('#sideBar').css('overflow', 'hidden');
        } else if ($status == 'off') {
            $('#sideBar').removeAttr('style');
        }
    }


    var selectCheckedOptions = function () {
        $opts.optionsChecked.each(function () {
            $(this).parents('li').addClass('selected');
        });
    };

    var submitRequest = function (serializedArray) {

        $.ajax({
            url: 'api/product/create-product',
            data: serializedArray,
            dataType: 'json',
            method: 'GET',
        })
            .done(function (response) {
                console.log(response);
                setTimeout(function () {
                        var $image = new Image();

                        $image.onload = function () {
                            $('.mediaImage').attr('src', $image.src);
                        };

                        $image.src = '/storage/render/' + response['image_file_name'];
                    }
                    , 2000
                );


            })
            .fail(function (error) {
                console.log(error);
            })
            .always(function () {
                console.log('always run');
            });


        // axios.get('/api/configurator/request-image', {
        //     params: {
        //         section: element.data('section') ? element.data('section') : 'null',
        //         color: element.data('color') ? element.data('color') : 'null',
        //     }
        // })
        //     .then(function (response) {
        //         console.log(response);
        //     })
        //     .catch(function (error) {
        //         console.log(error)
        //     })
        //     .then(function () {
        //
        //     })


        // axios.get('/api/configurator/preload-images', {
        //     params: {
        //         section: element.data('type') ? element.data('type') : null,
        //         color: element.data('color') ? element.data('color') : null,
        //         style: 'round',
        //         width: 6,
        //     }
        // })
        //     .then(function (response) {
        //         console.log(response.data);
        //
        //         $('.mediaImage').attr('src', response.data);
        //
        //     })
        //     .catch(function (error) {
        //         console.log(error);
        //     })
        //     .then(function () {
        //         console.log('done');
        //     });
        //
        // console.log($(':radio:checked'));
    };

    var preDownloadImagesCache = function () {

        $width = $('input[name="width"]:checked').attr('value');

        axios.get('/api/configurator/preload-images', {
            params: {
                width: $width,
            }
        })
            .then(function (response) {
                $data = response.data['data'];
                $url = response.data['url'];

                preloadImages($data, $url);

            })
            .catch(function (error) {

            })
            .then(function () {
                console.log('preloading images done');
            })

    };


    var preloadImages = function ($data, $url) {

        var $images = new Array();
        console.log($url);

        $.each($data, function (index, value) {
            $images[index] = new Image();
            $images[index].src = $url + value;

        })

        console.log($images);
    };


    init();
}
