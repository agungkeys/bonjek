<!-- jQuery -->
<script src="{{asset('assets/js/jquery-3.5.0.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/js/bootstrap.bundle.js')}}" type="text/javascript"></script>

 <!-- jquery Mask -->
<script src="{{asset('assets/js/jquery.mask.min.js')}}" type="text/javascript"></script>

<!-- custom javascript -->
<script src="{{asset('assets/js/script.js')}}" type="text/javascript"></script>

@include('sweetalert::alert')

<!-- Swiper slider  js-->
<script src="{{asset('assets/vendor/swiper/js/swiper.min.js')}}"></script>

<script src="{{asset('assets/plugins/fancybox/fancybox.min.js')}}" type="text/javascript"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<script src="https://unpkg.com/esri-leaflet@3.0.2/dist/esri-leaflet.js" integrity="sha512-myckXhaJsP7Q7MZva03Tfme/MSF5a6HC2xryjAM4FxPLHGqlh5VALCbywHnzs2uPoF/4G/QVXyYDDSkp5nPfig==" crossorigin=""></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MYF9SBKS0T"></script>
<!-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) -->

 <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MYF9SBKS0T');
</script>
<!-- page level custom script -->
@yield('content_js')
<script>
    "use strict"
    $(window).on('load', function() {
        var swiper = new Swiper('.swiper-slide-landing', {
          loop: true,
          effect: 'coverflow',
          spaceBetween: 10,
          autoplay: {
            delay: 3500,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          }
        });

        $('input[name="categoryLanding"]').on('click', function() {
           window.location = $(this).val();
        });

        $("#triggerpreviewimage").on("click", function() {
          $('#previewimage').attr('src', $('#triggerpreviewimage').attr('data-image')); // here asign the image to the modal when the user click the enlarge link
          $('#modalpreviewimage').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
        });

        var timeTelemed = new Date();
        var hoursTelemed = timeTelemed.getHours();
        setTimeout(function(){
          if(hoursTelemed >= 8 && hoursTelemed < 17) {
            $("#opentelemed").show();
            $("#labeltelemed").show();
            $("#closetelemed").hide();
          }else{
            $("#opentelemed").hide();
            $("#labeltelemed").hide();
            $("#closetelemed").show();
          }
        }, 500)

        // $('#triggerpreviewimage').on('hidden.bs.modal', function() {
        //     $('#modalpreviewimage').modal('hide');
        //     // $('body').removeClass('modal-open');
        //     setTimeout(function(){
        //         $('.modal-backdrop').hide();
        //         alert('run')
        //     },500);
        // });

        $('.money').mask('000.000.000', {reverse: true});
        $('.percent').mask('##0,00%', {reverse: true, max: 100});

        $('[data-toggle="popover"]').popover({
          trigger: 'focus'
        });

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    });
</script>
