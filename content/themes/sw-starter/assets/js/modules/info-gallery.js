import SlickSlider from './slick';
export default {
    init: function() {

      const $sliders = document.querySelectorAll('.info_gallery .slick-slider'); 
      const variables = {
            atuoplay: false, 
            dots : true };

      if($sliders.length === 0 ){

        return false;
      
      }

      const slick_slider = new SlickSlider();

      $.each($sliders, (index, slider ) => {
          slick_slider.init(slider,variables)
      });

    }
}