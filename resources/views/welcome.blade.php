@extends('layouts.app')
@section('content')
     <!-- FEATURE -->
     <section id="home" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-3 col-md-6 col-sm-12">
                         <div class="home-info">
                              <h3>professional landing page</h3>
                              <h1>We help you manage your website successfully!</h1>

                         </div>
                    </div>

               </div>
          </div>
     </section>
     <!-- FEATURE -->
     <section id="feature" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h1>What you get</h1>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <ul class="nav nav-tabs" role="tablist">
                              <li class="active"><a href="#tab01" aria-controls="tab01" role="tab" data-toggle="tab">Responsive</a></li>

                              <li><a href="#tab02" aria-controls="tab02" role="tab" data-toggle="tab">Mobile</a></li>

                              <li><a href="#tab03" aria-controls="tab03" role="tab" data-toggle="tab">Support</a></li>
                         </ul>

                         <div class="tab-content">
                              <div class="tab-pane active" id="tab01" role="tabpanel">
                                   <div class="tab-pane-item">
                                        <h2>Minimal Design</h2>
                                        <p>Nam feugiat a ante sollicitudin luctus. Quisque eget placerat massa. Ut quis ligula ornare, pellentesque velit eget, vestibulum est. Donec pretium tristique elit eget sodales. Pellentesque posuere.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>Easy to use</h2>
                                        <p>Aliquam massa massa, consectetur non mattis fringilla, sodales ac turpis. Morbi ac felis sagittis, faucibus mauris vitae, placerat mauris.</p>
                                   </div>
                              </div>


                              <div class="tab-pane" id="tab02" role="tabpanel">
                                   <div class="tab-pane-item">
                                        <h2>Compatible Browsers</h2>
                                        <p>Nam maximus elit a metus luctus, a faucibus magna mattis. Ut malesuada viverra iaculis. Nunc euismod sit amet neque a tincidunt.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>User Friendly</h2>
                                        <p>Maecenas maximus velit lorem, quis pharetra turpis fringilla id. Vestibulum tempor facilisis efficitur. Sed nec nisi sit amet nibh pellentesque elementum.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>HTML5 & CSS3</h2>
                                        <p>In viverra ipsum ornare sapien rhoncus ullamcorper. Vivamus vitae risus ac mi vehicula sagittis. Nulla dictum magna sit amet pharetra aliquam.</p>
                                   </div>
                              </div>

                              <div class="tab-pane" id="tab03" role="tabpanel">
                                   <div class="tab-pane-item">
                                        <h2>Quick Support</h2>
                                        <p>Mauris rutrum est at fringilla pulvinar. Nam ligula urna, lobortis non scelerisque vel, molestie eu massa. Nullam mattis elit at tortor accumsan.</p>
                                   </div>
                                   <div class="tab-pane-item">
                                        <h2>Managed Stuffs</h2>
                                        <p>Quisque ullamcorper sem quis sapien cursus efficitur. Sed id sodales ipsum. Morbi eleifend tempus erat sit amet vehicula. Nulla at posuere tellus, non mattis erat. Nulla id massa gravida.</p>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                         <div class="feature-image">
                              <img src="images/feature-mockup.png" class="img-responsive" alt="Thin Laptop">
                         </div>
                    </div>

               </div>
          </div>
     </section>
     <!-- ABOUT -->
     <section id="about" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                    <div class="col-md-offset-3 col-md-6 col-sm-12">
                         <div class="section-title">
                              <h1>Professional Team for you</h1>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb">
                              <img src="images/team-image1.jpg" class="img-responsive" alt="Andrew Orange">
                              <div class="team-info team-thumb-up">
                                   <h2>Andrew Orange</h2>
                                   <small>Art Director</small>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb">
                              <div class="team-info team-thumb-down">
                                   <h2>Catherine Soft</h2>
                                   <small>Senior Manager</small>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</p>
                              </div>
                              <img src="images/team-image2.jpg" class="img-responsive" alt="Catherine Soft">
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                         <div class="team-thumb">
                              <img src="images/team-image3.jpg" class="img-responsive" alt="Jack Wilson">
                              <div class="team-info team-thumb-up">
                                   <h2>Jack Wilson</h2>
                                   <small>CEO / Founder</small>
                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</p>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>
     <!-- TESTIMONIAL -->
     <section id="testimonial" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                    <div class="col-md-6 col-sm-12">
                         <div class="testimonial-image"></div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                         <div class="testimonial-info">
                              <div class="section-title">
                                   <h1>What People Say</h1>
                              </div>
                              <div class="owl-carousel owl-theme">
                                   <div class="item">
                                        <h3>Vestibulum tempor facilisis efficitur. Sed nec nisi sit amet nibh pellentesque elementum. In viverra ipsum ornare sapien rhoncus ullamcorper.</h3>
                                        <div class="testimonial-item">
                                             <img src="images/tst-image1.jpg" class="img-responsive" alt="Michael">
                                             <h4>Michael</h4>
                                        </div>
                                   </div>
                                   <div class="item">
                                        <h3>Donec pretium tristique elit eget sodales. Pellentesque posuere, nunc id interdum venenatis, leo odio cursus sapien, ac malesuada nisl libero eget urna.</h3>
                                        <div class="testimonial-item">
                                             <img src="images/tst-image2.jpg" class="img-responsive" alt="Sofia">
                                             <h4>Sofia</h4>
                                        </div>
                                   </div>
                                   <div class="item">
                                        <h3>Lorem ipsum dolor sit amet, consectetur adipisicing eiusmod tempor incididunt ut labore et dolore magna.</h3>
                                        <div class="testimonial-item">
                                             <img src="images/tst-image3.jpg" class="img-responsive" alt="Monica">
                                             <h4>Monica</h4>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>
     <!-- PRICING -->
     <section id="pricing" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h1>Choose any plan</h1>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h2>Student</h2>
                             </div>
                             <div class="pricing-info">
                                   <p>20 Responsive Designs</p>
                                   <p>10 Dashboards</p>
                                   <p>1 TB Storage</p>
                                   <p>6 TB Bandwidth</p>
                                   <p>24-hour Support</p>
                             </div>
                             <div class="pricing-bottom">
                                   <span class="pricing-dollar">$200/mo</span>
                                   <a href="{{ route('VerPreregistro') }}" class="section-btn pricing-btn">Preregistro</a>
                             </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h2>Business</h2>
                             </div>
                             <div class="pricing-info">
                                   <p>50 Responsive Designs</p>
                                   <p>30 Dashboards</p>
                                   <p>2 TB Storage</p>
                                   <p>12 TB Bandwidth</p>
                                   <p>15-minute Support</p>
                             </div>
                             <div class="pricing-bottom">
                                   <span class="pricing-dollar">$350/mo</span>
                                   <a href="{{ route('VerPreregistro') }}" class="section-btn pricing-btn">Preregistro</a>
                             </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="pricing-thumb">
                             <div class="pricing-title">
                                  <h2>Professional</h2>
                             </div>
                             <div class="pricing-info">
                                   <p>100 Responsive Designs</p>
                                   <p>60 Dashboards</p>
                                   <p>5 TB Storage</p>
                                   <p>25 TB Bandwidth</p>
                                   <p>1-minute Support</p>
                             </div>
                             <div class="pricing-bottom">
                                   <span class="pricing-dollar">$550/mo</span>
                                   <a href="{{ route('VerPreregistro') }}" class="section-btn pricing-btn">Preregistro</a>
                             </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <section id="contact" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h1>Contactanos</h1>
                              </div>
                              <div class="p-2 col-md-4 col-sm-4">
                                <i class="fab fa-facebook">
                                </i><h4>Comunidad Digital</h4>
                              </div>
                              <div class="p-2 col-md-4 col-sm-4">
                                <i class="fas fa-phone"></i>
                                <h4>5589143200</h4>
                              </div>
                              <div class="p-2 col-md-4 col-sm-4">
                                <i class="fab fa-twitter"></i>
                                  <h4>@Comunidad_Digital_Oficial</h4>
                              </div>
                              <div class="p-2 col-md-4 col-sm-4">

                              </div>
                              <div class="p-2 col-md-4 col-sm-4">
                                <i class="fas fa-envelope"></i>
                                <h4>atencioncliente@comunidad.com </h4>
                              </div>
                              <div class="p-2 col-md-4 col-sm-4">

                              </div>
                         </form>
                    </div>

               </div>
          </div>
     </section>

     <!-- FOOTER -->
     <footer id="footer" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="copyright-text col-md-12 col-sm-12">
                         <div class="col-md-6 col-sm-6">
                              <p>Copyright &copy; 2021 Comunidad</p>
                         </div>

                         <div class="col-md-6 col-sm-6">
                              <ul class="social-icon">
                                   <li><a href="#" class="fab fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fab fa-twitter"></a></li>
                                   <li><a href="#" class="fab fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

               </div>
          </div>
     </footer>

@endsection
