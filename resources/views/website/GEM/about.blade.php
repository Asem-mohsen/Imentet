@extends('layout.template.gem-template')

@section('title' , 'About GEM')

@section('content')

      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">About Our Museum</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{route('gem.home')}}">Home</a></li>
            <li>The Museum</li>
          </ul>
        </div>
      </section>

      <!-- About Our Time -->
      <section class="about-three">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">About Us</p>
            <h2 class="block-title__title">
              World's Largest <br />
              Archaeological Museum Complex <br />
              With 10,000 Artifacts
            </h2>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="about-three__content">
                <h3 class="about-three__content-title">Established in 1969</h3>
                <p class="about-three__content-text">
                  <a href="{{route('gem.about')}}" style="color: #d99578;">The Grand Egyptian Museum </a>in Giza, Egypt, is a prestigious archaeological institution.
                  It is among the world's largest museums,  
                  devoted to safeguarding<br/> and
                  exhibiting the fascinating history and culture of ancient Egypt. <br />
                  Proposed in 1992 and constructed from 2002, this state-of-the-art facility houses invaluable artifacts, 
                  including the renowned treasures of King Tutankhamun.
                </p>
                <a href="#" class="about-three__content-link">
                  <i class="egypt-icon-download"></i>
                  <span>Download Story in PDF</span>
                </a>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-three__tab">
                <ul class="list-unstyled nav nav-tabs about-three__tab-list" role="tablist">
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-1" role="tab" class="nav-link active"> 2002</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-2" role="tab" class="nav-link">2003</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-3" role="tab" class="nav-link">2011</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-4" role="tab" class="nav-link">2014</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane animated fadeInUp show active" id="year-1">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        In January of 2002, the Egyptian government announced a
                        worldwide competition for the design of a new museum
                        complex to house, display, and preserve some of the
                        world's greatest ancient treasures with which the modern
                        country of Egypt has the privilege of being entrusted.
                      </p>
                      <a href="https://grandegyptianmuseum.org/about/" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-2">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        In 2003, the winner of the architectural design
                        competition was announced at a press conference in
                        Cairo, with the Irish firm Heneghan Peng Architects
                        securing the contract to turn their ultra-modern concept
                        into the new Grand Egyptian Museum.
                      </p>
                      <a href="https://grandegyptianmuseum.org/about/" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-3">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        As the outbreak of the Arab Spring reached Egypt in
                        early 2011, work on the project ground to a halt as the
                        country experienced several years of unfortunate
                        political instability and uncertainty. <br />
                        Tourism to Egypt also dwindled during these years,
                        drying up the government's coffers and jeopardizing the
                        grand new museum's future.
                      </p>
                      <a href="https://grandegyptianmuseum.org/about/" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-4">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        But following the restabilization of the government in
                        2014 and the preservation of that stability ever since,
                        the project soon got back on track and construction
                        resumed with the help of international loans to cover
                        the financial shortfalls caused by the lingering effects
                        of the tourism downturn.
                      </p>
                      <a href="https://grandegyptianmuseum.org/about/" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Museum Departments -->
      <section class="department-one">
        <div class="department-one__top">
          <div class="container">
            <div class="block-title text-center">
              <p class="block-title__tag-line">Careers</p>
              <h2 class="block-title__title">Find Your Career</h2>
            </div>
          </div>
        </div>
        <div class="department-one__bottom">
          <div class="container">
            <div class="col-lg-4 offset-lg-4">
              <div class="department-one__carrer" style="position: relative; bottom: 40px;">
                <div class="department-one__carrer-inner">
                  <i class="egypt-icon-career"></i>
                  <h3 class="department-one__carrer-title">
                    Find Your Career
                  </h3>
                  <a href="{{route('gem.careers.index')}}" class="department-one__carrer-link"
                    >Job Oppurtunities <span>+</span></a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Video -->
      <section class="video-two mb-5">
        <div class="container">
          <div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
            <a
              href="https://www.youtube.com/watch?v=hO1tzmi1V5g"
              class="video-popup video-two__btn"
              ><i class="egypt-icon-circular"></i
            ></a>
            <h3 class="video-two__title">
              Great Art and Great Art Experiences
            </h3>
            <p class="video-two__tag-line">Since 1969</p>
          </div>
        </div>
      </section>

@endsection