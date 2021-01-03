// CAROUSEL
$(function() {
    $('.carousel-item').eq(0).addClass('active');
    var total = $('.carousel-item').length;
    var current = 0;
    $('#moveRight').on('click', function(){
      var next=current;
      current= current+1;
      setSlide(next, current);
    });
    $('#moveLeft').on('click', function(){
      var prev=current;
      current = current- 1;
      setSlide(prev, current);
    });
    function setSlide(prev, next){
      var slide= current;
      if(next>total-1){
       slide=0;
        current=0;
      }
      if(next<0){
        slide=total - 1;
        current=total - 1;
      }
             $('.carousel-item').eq(prev).removeClass('active');
             $('.carousel-item').eq(slide).addClass('active');
        setTimeout(function(){
  
        },800);
      console.log('current '+current);
      console.log('prev '+prev);
    }
  });
//   TABS
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
      $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
      var x = $(event.target).text();         // active tab
      var y = $(event.relatedTarget).text();  // previous tab
      $(".act span").text(x);
      $(".prev span").text(y);
    });
  });

  // SLIDER CAROUSEL 
  $('.detail-product-carousel').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.detail-nav',
    responsive: [
      {
          breakpoint: 1400,
          setting: {
              arrows: true
          }

      },
      {
          breakpoint: 800,
          setting: {
            arrows: true
          }

      }
  ]
  });
  $('.detail-nav').slick({
    asNavFor: '.detail-product-carousel',
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 9999,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
          arrows: true,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
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

  $(".pagination .page-item a").each(function() {
    var $this = $(this);       
    var _href = $this.attr("href"); 
    $this.attr("href", _href + '#list-product');
 });