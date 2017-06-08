import $ from 'jquery';
import smoothState from 'smoothState';
import NProgress from 'NProgress';

const SPA = {

      init : function(){
      var settings = { 
            anchors: 'a',

            onStart: {
                duration: 280, 
                render: function ( $container ) {
                    console.log('here');
                    $container.addClass( 'slide-out' );
                }
            },
            onAfter: function( $container ) {
                
                $container.removeClass( 'slide-out' );
            }
        };
 
        $('#container').smoothState(settings);
    }  
  };
export default SPA;
