(function ($, wp) {

    $(document).ready(function () {

        $('body').on('click','.add_price_list', function(){

            var this_parent = $(this).closest('.devvn_woo_price_filter');

            var thisTable = $(this).closest('table');

            var thisNumber = $(this).data('number');

            var size = thisTable.find( 'tbody tr' ).length;

            var devvn_price_template = wp.template( 'devvn-price-range-'+thisNumber );

            $('tbody',thisTable).append( devvn_price_template({

                index: size

            }));

        });


        $('body').on('click','.devvn_delete_price_list',function () {

            var thisTr = $(this).closest('tr');

            var thisTbody = $(this).closest('tbody');

            thisTr.fadeOut(400,function () {

                $(this).remove();

                var loop = 0;

                $('tr',thisTbody).each(function(index, row){

                    $('input', row ).each( function( i, el ) {

                        var t = $(el);

                        t.attr( 'name', t.attr('name').replace(/\[dk_([^[]*)\]/, "[dk_" + loop + "]" ) );

                    });

                    loop++;

                });

            });

            return false;

        });

    });

})(jQuery, wp)
