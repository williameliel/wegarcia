import 'slick-carousel';
// SlickSlider is a base class
class SlickSlider {

    init(slider, variables ){

        if(slider === 0 ){

            return false;
      
        }
        const $slider = $(slider);
        
        var options = { arrows: false, 
                        dots: false,
                        autoplay: true,
                        autoplaySpeed: 3500,
                        infinite: true,
                        speed: 500,
                        nextArrow: '<button class="slick-next fa fa-angle-right"></button>',
                        prevArrow: '<button class="slick-prev fa fa-angle-left"></button>'
                    };

        $.extend( options, variables ); 

        $slider.on('init', (slick)=>{ $(slick.target).addClass('loaded') });

        $slider.slick(options);  

    }
}
export default SlickSlider;
 

