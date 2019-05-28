@extends('layouts.app')

@section('content')
  <div class="banner">
    <div class="container">
      <div class="banner__content">
        <h1>Kursus IT<br>Pemrograman Web & Digital Marketing Online</h1>
        <p>Harga berlanggan <span>HANYA 49 Ribu</span> perbulan</p>
      </div>
    </div>
  </div>
  <div class="partner-item">
    <div class="container">
      <ul class="partner__list">
        <li><img src="assets/img/illinois.png" class="img-fluid" alt="partner-logo"></li>
        <li><img src="assets/img/penn.png" class="img-fluid" alt="partner-logo"></li>
        <li><img src="assets/img/johns_hopkins.png" class="img-fluid" alt="partner-logo"></li>
        <li><img src="assets/img/michigan.png" class="img-fluid" alt="partner-logo"></li>
        <li><img src="assets/img/stanford.png" class="img-fluid" alt="partner-logo"></li>
        <li><img src="assets/img/san_diego.png" class="img-fluid" alt="partner-logo"></li>
        <li><img src="assets/img/duke.png" class="img-fluid" alt="partner-logo"></li>
      </ul>
    </div>
  </div>
  <div class="video-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="video__iframe">
            <iframe width="554" height="340" src="https://www.youtube.com/embed/8eDuupJ9Uus" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="video__description">
            <div class="video__content">
              <h2>Prestasi Alumni Babastudio</h2>
              <p>Saksikan Alumni Babastudio diwawancara Andi F. Noya mengenai pengalaman kursusnya di Babastudio.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-section">
    <div class="container">
      <div class="slider__content">
        <div class="slider__title">
          <h4>Top Courses in <strong>Development</strong></h4>
          <a href="all-course.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> See all</a>
        </div>
        <div class="slider__item">
          <div id="slider__item_list" class="slider-class">
            <div class="owl-carousel slider__low_item1 owl-theme">
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content1.jpg" alt="slider" class="img-fluid">
                    <span class="label best_seller">BEST SELLER</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content2.jpg" alt="slider" class="img-fluid">
                    <span class="label hot_news">HOT & NEWS</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content1.jpg" alt="slider" class="img-fluid">
                    <span class="label best_seller">BEST SELLER</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content4.jpg" alt="slider" class="img-fluid">
                    <span class="label new_course">NEW COURSE</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content2.jpg" alt="slider" class="img-fluid">
                    <span class="label hot_news">HOT & NEWS</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-section">
    <div class="container">
      <div class="slider__content">
        <div class="slider__title">
          <h4>Top Courses in <strong>Marketing</strong></h4>
          <a href="all-course.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> See all</a>
        </div>
        <div class="slider__item">
          <div id="slider__item_list" class="slider-class">
            <div class="owl-carousel slider__low_item2 owl-theme">
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content1.jpg" alt="slider" class="img-fluid">
                    <span class="label best_seller">BEST SELLER</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content2.jpg" alt="slider" class="img-fluid">
                    <span class="label hot_news">HOT & NEWS</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content1.jpg" alt="slider" class="img-fluid">
                    <span class="label best_seller">BEST SELLER</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content4.jpg" alt="slider" class="img-fluid">
                    <span class="label new_course">NEW COURSE</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content2.jpg" alt="slider" class="img-fluid">
                    <span class="label hot_news">HOT & NEWS</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="slider-section">
    <div class="container">
      <div class="slider__content">
        <div class="slider__title">
          <h4>Top Courses in <strong>Business</strong></h4>
          <a href="all-course.html"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> See all</a>
        </div>
        <div class="slider__item">
          <div id="slider__item_list" class="slider-class">
            <div class="owl-carousel slider__low_item3 owl-theme">
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content1.jpg" alt="slider" class="img-fluid">
                    <span class="label best_seller">BEST SELLER</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content2.jpg" alt="slider" class="img-fluid">
                    <span class="label hot_news">HOT & NEWS</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content1.jpg" alt="slider" class="img-fluid">
                    <span class="label best_seller">BEST SELLER</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content4.jpg" alt="slider" class="img-fluid">
                    <span class="label new_course">NEW COURSE</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
              <div class="item">
                <a href="detail-kursus.html">
                  <div class="slider__image">
                    <img src="assets/img/slide_content2.jpg" alt="slider" class="img-fluid">
                    <span class="label hot_news">HOT & NEWS</span>
                  </div>
                  <div class="slider__description">
                    <p class="time"><span class="glyphicon glyphicon-time"></span>  72 minute</p>
                    <p class="title">Advanced CSS and Sass:Flexbox, Grid, Animation...</p>
                    <p class="text">Jonas Schemedtmann</p>
                    <div class="rating">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    </div>
                    <span class="small-rating">4.8(4,491)</span>
                    <div class="slider__submit">
                      <h5 class="price">Rp. 45rb</h5>
                      <a href="detail-kursus.html" class="button btn">GET COURSE</a>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="button__link">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a href="all-course.html">SEE ALL COURSES</a>
        </div>
      </div>
    </div>
  </div>
@endsection
