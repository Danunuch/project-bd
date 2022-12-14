 $('.banner_index').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  autoplay: true,
  fade: true,
  autoplaySpeed: 5000,
});


 $('.new_slick').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  responsive: [{
    breakpoint: 1400,
    settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true
    }
},

{
    breakpoint: 992,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true
    }
},

{
    breakpoint: 768,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1
    }
}
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                    ]
});
 $('.portfolio_slick_detail').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    autoplay: false,
    autoplaySpeed: 5000,
});

 $('.portfolio_slick').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  responsive: [{
    breakpoint: 992,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true
    }
},

{
    breakpoint: 768,
    settings: {
        arrows: false,
        dots: true,
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1
    }
}
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                    ]

                });








