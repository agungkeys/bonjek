@extends('layouts.app')

@section('title', 'Tentang Ruang Kita | Ruang Kebaikan')
@section('meta_keywords', 'tentang kami, tentang ruang kita, tentang ruang kebaikan')
@section('meta_description', 'Tentang Ruang Kita, Wadah Pengembangan Potensi
Yang Bertujuan Untuk Memperkuat Peran Anak Muda')

@section('content')
<!-- Begin page content -->
<div class="screen-wrap">
  <section class="padding-around" style="position: sticky; top: 0px; z-index: 5; background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px);">
  	<div class="row mw-mobile">
  		<div class="col-1 text-center" style="padding: 5px 5px 0 0;">
  			<a href="javascript:history.go(-1)" class="btn-header">
  				<i class="fa fa-arrow-left"></i>
  			</a>
  		</div>
  		<div class="col text-center">
  			<h5 class="title-header"> Tentang Ruang Kita </h5>
  		</div>
      <div class="col-1"></div>
  	</div>
  </section>
  <main class="flex-shrink-0">

    <!-- page content start -->
    <div class="container mw-mobile mt-2 text-center">
        <!-- <h5 class="text-dark mb-0">Tentang</h5> -->
        <!-- <h1 class="display-4 mb-0">Ruang Kita</h1> -->
        <div class="container py-2">
            <img src="{{asset('assets/images/ruangkitalogo.svg')}}" style="width: 6em;">
        </div>
        <h6 class="text-secondary">Ruang Kita - Ruang Kebaikan</h6>
        <p class="text-dark">Wadah Pengembangan Potensi <br>Yang Bertujuan Untuk Memperkuat Peran Anak Muda <span class="text-danger">❤</span></p>

    </div>
    <div class="container-fluid mt-4 pt-1 bg-dark text-white">
        <!-- <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col align-self-center">
                        <div class="text-center py-4">
                            <h4><span class="countertext">25</span>+</h4>
                            <p class="text-secondary small">Pages</p>
                        </div>
                    </div>
                    <div class="col align-self-center">
                        <div class="text-center py-4">
                            <h4><span class="countertext">14</span>+</h4>
                            <p class="text-secondary small">Styles</p>
                        </div>
                    </div>
                    <div class="col align-self-center">
                        <div class="text-center py-4">
                            <h4><span class="countertext">2</span></h4>
                            <p class="text-secondary small">Dark<sup>L</sup>+RTL</p>
                        </div>
                    </div>
                    <div class="col align-self-center">
                        <div class="text-center py-4">
                            <h4><span class="countertext">2</span></h4>
                            <p class="text-secondary small">Menus</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="container mw-mobile mt-4">
        <h4>Visi Ruang Kita</h4>
        <p class="text-secondary mt-3">Menjadi wadah pengembangan potensi untuk mewujudkan pendidikan bermakna,  masyarakat sosial, sadar lingkungan, berbudaya dan kreatif.</p>
    </div>
    <div class="container mw-mobile mt-4">
        <h4>Misi Ruang Kita</h4>
        <p class="text-secondary mt-3">Melakukan serangkaian kegiatan pendidikan / edukasi,  pengembangan jiwa sosial, sadar lingkungan, membudaya dan kreatif guna mendukung dan mewujudkan masyarakat yang berkarakter dengan kolaborasi memunculkan suasana yang positif menyenangkan dan bermakna.</p>
    </div>
    <!-- <div class="container mw-mobile mt-4 bg-white">
          <div class="row">
              <div class="container py-4">
                  <div class="row">
                      <div class="col-6 col-md-6 mb-4">
                          <div class="row">
                              <div class="col">
                                  <h6>User Experience</h6>
                                  <p class="text-secondary small">User Experience is key priority for us and we always think about domains as well as users from those business domain.</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-md-6 mb-4">
                          <div class="row">
                              <div class="col">
                                  <h6>Unlimited Styles</h6>
                                  <p class="text-secondary small">We have predefined 16+ styles and create very own new style by changing and recompiling provided varibles file in SCSS.</p>
                              </div>
                          </div>
                      </div>
                  </div>
                   <div class="row">
                      <div class="col-6 col-md-6 mb-4">
                          <div class="row">
                              <div class="col">
                                  <h6>Loving Framework</h6>
                                  <p class="text-secondary small">We and many of us love bootstrap framework so we have build Oneuiux with Bootstrap 4 version.</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-md-6 mb-4">
                          <div class="row">
                              <div class="col">
                                  <h6>Many Icons</h6>
                                  <p class="text-secondary small">There are many posibility to use icons with any fonts icons. Here we have used ionic icons</p>
                              </div>
                          </div>
                      </div>
                  </div>
                   <div class="row">
                      <div class="col-6 col-md-6 ">
                          <div class="row">
                              <div class="col">
                                  <h6>Clean Code</h6>
                                  <p class="text-secondary small">We have practiced with clean code no more commented areas and only required comments. Also validated with W3C validator.</p>
                              </div>
                          </div>
                      </div>
                      <div class="col-6 col-md-6 ">
                          <div class="row">
                              <div class="col">
                                  <h6>Documentation</h6>
                                  <p class="text-secondary small">We have added documentation to undertand basic folder structure and steps to change styles with code snippets.</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="container mw-mobile my-4">
          <h4> Attach with Emotions</h4>
          <h6>Express your brand with OneUIUX</h6>
          <p class="text-secondary mt-3">Our OneUIUX HTML template is creatively hand crafter with consideration of human behaviour with consistancy and color contrast. We have created full website demo with multiple each domain/business demo unlike anyother template in market.</p>
      </div> -->
  </main>
</div>
@endsection
