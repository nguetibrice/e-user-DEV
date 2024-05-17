@extends('layouts.site')

@section('main_content')
  <div class="wrapper">
    <div class="section section-hero section-shaped pt-0">
      <div class="page-header mt-n5">
        <div class="page-header-image" style="background-image: url({{ asset("images/presentation_bg.png") }});">
        </div>
        <div class="container-fluid shape-container d-flex align-items-center py-lg">
          <div class="col px-0">
            <div class="row">
              <div class="col-lg-4 ml-5">
                <img src="{{asset('images/logo.png')}}" style="width: 200px;" class="img-fluid">
                <span class="badge badge-danger">BETA</span>
                <p class="lead">Communiquer pour agir. <br> <b>La meilleure application d'apprentissage de langues maternelles.</b></p>
                <div class="btn-wrapper mt-5">
                  <a href="https://play.google.com/store/apps/details?id=com.afrinnov.djed" target="_blank"
                    class="btn btn-outline-dark btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="fa-brands fa-google-play"></i></span>
                    <span class="btn-inner--text">PlayStore</span>
                  </a>
                  <a href="#"
                    class="btn btn-outline-primary btn-icon mb-3 mb-sm-0" target="_blank">
                    <span class="btn-inner--icon"><i class="fa-brands fa-app-store"></i></span>
                    <span class="btn-inner--text">App Store</span>
                  </a>
                </div>
                <div class="mt-5">
                  <small class="font-weight-bold mb-0 mr-2">*powered by JARD</small>
                  {{-- <img src="{{asset('images/frontend/creativetim-black-slim.png')}}" style="height: 28px;"> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="section-info" id="about">
      <div class="container">
        <h1 class="display-3 text-center">Le DJED, une experience d'apprentissage innovante</h1>
        <div class="row">
            <div class="col-6 mx-auto">
                <img class="d-flex justify-content-end align-items-center w-100" src="{{ asset('images/frontend/Untitled_design-removebg-preview (2).png') }}" alt="">
            </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-4 col-md-6">
            <div class="info text-left">
              <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <h6 class="info-title text-uppercase text-primary pl-0">Plus de {{ sizeof($languages) }} langues disponibles</h6>
              <p class="description opacity-8">L’application est constituée de {{ sizeof($languages) }} langues maternelles de par le Cameroun tous minutieusement travaillées pour favoriser notre apprentissage.</p>
              <a href="#" class=" btn btn-primary">Savoir Plus
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="info text-left">
              <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle">
                <i class="fa-solid fa-chalkboard-user"></i>
              </div>
              <h6 class="info-title text-uppercase text-success pl-0">Accessible partout dans le monde </h6>
              <p class="description opacity-8">L’application est disponible dans tous les pays au confort d’un clic sur tous les plateformes de téléchargement pour application mobile.</p>
              <a href="#" class="btn btn-success">Savoir Plus
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="info text-left">
              <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle">
                <i class="fa-solid fa-earth-africa"></i>
              </div>
              <h6 class="info-title text-uppercase text-warning pl-0">Un service de Qualité à votre disponibilité</h6>
              <p class="description opacity-8">Un service client compétent est à votre disposition pour répondre à vos questions 5 jours sur 7 peut importe où vous vous trouvez..</p>
              <a href="#"
                class="btn btn-danger">Savoir Plus
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section-basic-components">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-10 mb-md-5">
            <h1 class="display-3">C’est quoi le Djed ? </h1>
            <p class="lead">
                Le Djed est une application d’apprentissage des langues nationales et internationales développée par les Jeunes Amis de la Recherche et du Développement (JARD) qui a pour but de promouvoir nos cultures africaines au travers des nouveaux moyens technologiques.
                Elle a été conçue avec le consommateur en tête car beaucoup de personnes veulent apprendre des langues locales mais faute de moyens pédagogique adaptés n’y parviennent pas.
            </p>
            <a class="btn btn-primary mt-3" href="#" onclick="pageFocus('contact')">Savoir Plus</a>
          </div>
          <div class="col-lg-5 col-md-12">
            <div class="image-container">
              {{-- <img class="table-img" src="{{asset('images/frontend/table.png')}}" alt="">
              <img class="coloured-card-btn-img" src="{{asset('images/frontend/card-btn.png')}}" alt="">
              <img class="coloured-card-img" src="{{asset('images/frontend/card-orange.png')}}" alt="">
              <img class="linkedin-btn-img" src="{{asset('images/frontend/slack-btn.png')}}" alt=""> --}}
              <img class="" src="{{asset('images/african-family-animate.svg')}}">

            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="section features-7 bg-secondary" id="languages">
        <div class="container">
          <div class="row">
            <div class="col-md-8 text-center mx-auto">
              <h3 class="display-3 ">Quelques unes de nos langues</h3>
              <p class="lead">Voici un aperçu des langues disponibles sur le DJED pour votre apprentissage.</p>
            </div>
          </div>
          <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
              <div class="row row-grid">
                @foreach ($languages as $language)
                @php
                    $color = $colors[rand(0,4)];
                    $min = 0;
                    $max = 0;
                    // foreach ($language['prices'] as $price) {
                    //     if ($loop->index == 0) {
                    //         $min =  $price["currency_options"][$price->currency]["tiers"][0]["flat_amount"] .' '.$price["currency"]
                    //     }
                    //     if ($price["currency_options"][$price->currency]["tiers"][0]->flat_amount < $min) {
                    //         $min =  $price["currency_options"][$price->currency]["tiers"][0]["flat_amount"].' '.$price["currency"]
                    //     }
                    //     if ($price["currency_options"][$price->currency]["tiers"][sizeof($price["currency_options"][$price->currency]["tiers"])]["flat_amount"] > $max) {
                    //         $max =  $price["currency_options"][$price->currency]["tiers"][sizeof($price["currency_options"][$price->currency]["tiers"])]["flat_amount"].' '.$price["currency"]
                    //     }
                    // }
                @endphp
                    <div class="col-lg-4">
                    <div class="card card-lift--hover shadow border-0">
                        <div class="card-body py-5">
                        <div class="icon icon-shape icon-shape-{{ $color }} rounded-circle mb-4">
                            <i class="fa-solid fa-language"></i>
                        </div>
                        <h6 class="text-{{ $color }} text-uppercase">{{ $language["name"] }}</h6>
                        <p class="description mt-3">{{ $language["description"] }} </p>
                        <p class="lead text-sm text-right">A Partir de XAF 1500 </p>
                        <a href="#"
                            class="btn btn-{{ $color }} mt-4">Savoir Plus <i class="fa-solid fa-chevron-right ml-2"></i></a>
                        </div>
                    </div>
                    </div>
                @endforeach

              </div>
            </div>
          </div>

        </div>
      </div>
    <section class="section-testimonials mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-10 ml-auto mr-auto text-center">
            <h2 class="display-2 mb-5">Approuvé par plus de 880 000 personnes</h2>
            <p class="lead">Quelques remarques faites par certains de nos partenaires et utilisateurs</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-8 mx-auto">
            <div id="carouselExampleIndicatoru" class="carousel slide">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicatoru" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicatoru" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicatoru" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active justify-content-center">
                  <div class="card card-testimonial card-plain">
                    <div class="card-avatar">
                      <a
                        href="#">
                        <img class="img img-raised rounded" src="{{asset('images/frontend/thumb.JPG')}}">
                      </a>
                    </div>
                    <div class="card-body text-center">
                      <p class="card-description">"Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci quas, sed reprehenderit aperiam error illum. Maiores dolor repellat in nostrum, cum sequi sint hic doloribus sed sunt facere quam non cumque tenetur soluta, dolores repellendus!!"
                      </p>
                      <h4 class="card-title">Hakim</h4>
                      <h6 class="category text-muted">Enseignant</h6>
                      <div class="card-footer">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item justify-content-center">
                  <div class="card card-testimonial card-plain">
                    <div class="card-avatar">
                      <a
                        href="#">
                        <img class="img img-raised rounded" src="{{asset('images/frontend/128.jpg')}}">
                      </a>
                    </div>
                    <div class="card-body text-center">
                      <p class="card-description">"Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis placeat facere itaque illum, fuga reprehenderit, minus ipsa earum ipsam aspernatur commodi minima dolorum modi. Fugiat, repellat culpa! Ducimus nesciunt incidunt minus veritatis nemo consequatur debitis? Soluta et incidunt id officia?."
                      </p>
                      <h4 class="card-title">Mr. Esso</h4>
                      <h6 class="category text-muted">Parent</h6>
                      <div class="card-footer">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star tsext-secondary"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item justify-content-center">
                  <div class="card card-testimonial card-plain">
                    <div class="card-avatar">
                      <a
                        href="#">
                        <img class="img img-raised rounded" src="{{asset('images/frontend/thumb_')}}">
                      </a>
                    </div>
                    <div class="card-body text-center">
                      <p class="card-description">" Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis doloremque autem itaque est dolorem. Cumque dolores asperiores perferendis consequatur consectetur soluta iste maxime pariatur! Ab vel, dolorum aliquam nobis, consequuntur mollitia excepturi sapiente nemo numquam, distinctio fugit! "<br><br>
                      </p>
                      <h4 class="card-title">Mohammadou</h4>
                      <h6 class="category text-muted">Etudiant</h6>
                      <div class="card-footer">
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                        <i class="fa fa-star text-warning"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev"
            href="#carouselExampleIndicatoru"
            role="button" data-slide="prev">
            <i class="fa-solid fa-chevron-left"></i>
          </a>
          <a class="carousel-control-next"
            href="#carouselExampleIndicatoru"
            role="button" data-slide="next">
            <i class="fa-solid fa-chevron-right"></i>
          </a>
        </div>
      </div>
    </section>
    <div class="section section-pricing" id="sectionBuy">
      <div class="container-fluid">
        <div class="row our-clients">
          <div class="col-lg-2 col-md-3 col-6">
            <img class="w-50" src="{{asset('images/frontend/harvard.jpg')}}" alt="">
          </div>
          <div class="col-lg-2 col-md-3 col-6">
            <img class="w-50" src="{{asset('images/frontend/microsoft.jpg')}}" alt="">
          </div>
          <div class="col-lg-2 col-md-3 col-6">
            <img class="w-50" src="{{asset('images/frontend/vodafone.jpg')}}" alt="">
          </div>
          <div class="col-lg-2 col-md-3 col-6">
            <img class="w-50" src="{{asset('images/frontend/stanford.jpg')}}" alt="">
          </div>
          <div class="col-lg-2 col-md-3 col-6">
            <img class="w-50" src="{{asset('images/frontend/microsoft.jpg')}}" alt="">
          </div>
          <div class="col-lg-2 col-md-3 col-6">
            <img class="w-50" src="{{asset('images/frontend/stanford.jpg')}}" alt="">
          </div>

        </div>
      </div>
    </div>
    <section class="pricing-3" style="background-image: url(&#39;./assets/img/ill/1.svg&#39;)" id="pricing-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto text-center my-5">
              <h3 class="display-3">Nos Prix</h3>
              <p class="mt-4">Nous vous offrons des prix imbattables pour l'apprentissage de nos langues maternelles.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 pr-md-0">
              <div class="card card-pricing text-center bg-default">
                <div class="card-header bg-transparent">
                  <h4 class="text-uppercase ls-1 text-primary py-3 mb-0">Pack Personnel</h4>
                </div>
                <div class="card-body px-lg-6">
                  <div class="display-2 text-white">XAF 2000</div>
                  <span class=" text-muted">par langue</span>
                  <ul class="list-unstyled my-4">
                    <li>
                      <div class="d-flex align-items-center">
                        <div>
                          <div class="icon icon-xs icon-shape icon-shape-primary shadow rounded-circle">
                            <i class="fa fa-check text-white"></i>
                          </div>
                        </div>
                        <div>
                          <span class="pl-2 text-sm">Lorem, ipsum.</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex align-items-center">
                        <div>
                          <div class="icon icon-xs icon-shape icon-shape-primary shadow rounded-circle">
                            <i class="fa fa-check text-white"></i>
                          </div>
                        </div>
                        <div>
                          <span class="pl-2 text-sm">Lorem ipsum dolor sit.</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex align-items-center">
                        <div>
                          <div class="icon icon-xs icon-shape icon-shape-primary shadow rounded-circle">
                            <i class="fa fa-check text-white"></i>
                          </div>
                        </div>
                        <div>
                          <span class="pl-2 text-sm">Lorem, ipsum dolor.</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <button type="button" class="btn btn-primary mb-3">Commander Maintenant</button>
                </div>
                <div class="card-footer bg-transparent">
                  {{-- <a href="javascript:;" class=" text-muted">Regarder une demo</a> --}}
                </div>
              </div>
            </div>
            <div class="col-md-7 pl-md-0">
              <div class="card card-pricing border-0 text-center my-5">
                <div class="card-header bg-transparent">
                  <h4 class="text-uppercase ls-1 text-primary py-3 mb-0">Pack Famille</h4>
                </div>
                <div class="card-body px-lg-6">
                  <div class="card-description">Vous pouvez aussi acheter des bouquets pour vous et votre famille!.</div>
                  <table class="table table-bordered mt-3">
                    <tbody>
                      <tr>
                        <td>Support 24/7</td>
                        <td>Jusqu'a 10 places</td>
                      </tr>
                      <tr>
                        <td>Audios Illimites</td>
                        <td>Examens</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  {{-- <a href="javascript:;" class="text-primary">Creer compte</a> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <div class="contactus-3" id="contact">
        <div class="page-header">
          <img class="bg-image" src="{{ asset('images/frontend/bg_contactus3.svg') }}" alt="">
        </div>
        <div class="container pt-5">
          <div class="row">
            <div class="col-md-12 text-center mb-5">
              <h1 class="display-1">Avez vous des questions?</h1>
              <h3 class="lead">Nous aimerions parler davantage de ce dont vous avez besoin</h3>
              <a class="btn btn-icon btn-success mt-3" type="button" href="https://wa.me/237658346552" target="_blank">
                <span class="btn-inner--icon"><i class="fab fa-whatsapp"></i></span>
                <span class="btn-inner--text">Discutez avec nous</span>
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 col-6">
                <div class="info info-hover">
                    <div class="icon icon-shape icon-shape-primary icon-lg shadow rounded-circle text-primary">
                        <i class="fa-solid fa-at"></i>
                    </div>
                    <h4 class="info-title">Email</h4>
                    <p class="description px-0">
                        <a href="mailto:info@languelite.com" target="_blank">info@languelite.com</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6">
              <div class="info info-hover">
                <div class="icon icon-shape icon-shape-primary icon-lg shadow rounded-circle text-primary">
                    <i class="fa-solid fa-square-phone"></i>
                </div>
                <h4 class="info-title">Telephone</h4>
                <p class="description px-0">
                    <a href="tel:+237658346552">
                        +(237) 658 346 552</p>
                    </a>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6">
              <div class="info info-hover">
                <div class="icon icon-shape icon-shape-primary icon-lg shadow rounded-circle text-primary">
                    <i class="fa-solid fa-user-nurse"></i>
                </div>
                <h4 class="info-title">Contact</h4>
                <p class="description px-0">DJED</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <footer class="footer mt-4">
      <div class="container">
        <div class="row row-grid align-items-center mb-5">
          <div class="col-lg-6">
            <h3 class="text-primary font-weight-light mb-2">Merci pour votre soutien!</h3>
            <h4 class="mb-0 font-weight-light">Restons en contact sur l'une de ces plateformes.</h4>
          </div>
          <div class="col-lg-6 text-lg-center btn-wrapper">
            <button onclick="pageredirect('https:\/\/linkedin.com/Djed_app')" target="_blank" href="#" rel="nofollow"
              class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip"
              data-original-title="Follow us">
              <span class="btn-inner--icon"><i class="fab fa-linkedin"></i></span>
            </button>
            <button onclick="pageredirect('https:\/\/www.facebook.com/profile.php?id=61551829540118')" target="_blank" href="https://www.facebook.com/profile.php?id=61551829540118" rel="nofollow"
              class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip" data-original-title="Like us">
              <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
            </button>
            <button onclick="pageredirect('https:\/\/www.instagram.com/djed_cm/')" target="_blank" href="https://www.instagram.com/djed_cm/" rel="nofollow"
              class="btn btn-icon-only btn-dribbble rounded-circle" data-toggle="tooltip"
              data-original-title="Follow us">
              <span class="btn-inner--icon"><i class="fab fa-instagram"></i></span>
            </button>
            <button onclick="pageredirect('https:\/\/twitter.com/Djed_app')" target="_blank" href="https://twitter.com/Djed_app" rel="nofollow"
              class="btn btn-icon-only btn-github rounded-circle" data-toggle="tooltip"
              data-original-title="Star on Github">
              <span class="btn-inner--icon"><i class="fa-brands fa-x-twitter"></i></span>
            </button>

          </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
          <div class="col-md-6">
            <div class="copyright">
              © {{ date('Y') }} <a
                href="#"
                target="_blank">DJED-JARD</a>.
            </div>
          </div>
          <div class="col-md-6">
            <ul class="nav nav-footer justify-content-end">
              <li class="nav-item">
                <a href="#"
                  class="nav-link" target="_blank">JARD</a>
              </li>
              <li class="nav-item">
                <a href="#"
                  class="nav-link" target="_blank">Apropos</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="#"
                  class="nav-link" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
@endsection

