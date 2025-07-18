import { Splide } from '@splidejs/splide'
import '@splidejs/splide/dist/css/splide.min.css'


const splide = new Splide( '.splide', {
  type   : 'loop',
  perPage: 3,
  perMove: 1,
  focus  : 'center',
  gap: "1.5rem",
  speed:1000,
  autoplay: true,

  breakpoints: {
    768: {
      perPage: 1,     
      gap    : '1rem' 
    }
  }
} );

splide.mount();