      @extends('user.user')
      @section('title', 'Trang chủ')
      @section('content')
      <style>
          .footer {
              margin-top: 100px;
              padding-top: 0;
          }
      </style>
      <!-- Carousel Start -->
      <div class="container-fluid p-0 mb-5">
          <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                      <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                          <div class="p-3" style="max-width: 700px;">
                              <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Phong Cách Thượng Lưu</h6>
                              <h1 class="display-3 text-white mb-4 animated slideInDown">Đặt phòng nhanh, tận hưởng sang trọng!</h1>
                              <a href="/room" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Xem Phòng</a>
                              <a href="/room" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Đặt Phòng</a>
                          </div>
                      </div>
                  </div>
                  <div class="carousel-item">
                      <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                      <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                          <div class="p-3" style="max-width: 700px;">
                              <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Phong Cách Thượng Lưu</h6>
                              <h1 class="display-3 text-white mb-4 animated slideInDown">Nơi hành trình của bạn bắt đầu với sự thoải mái</h1>
                              <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our Rooms</a>
                              <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Room</a>
                          </div>
                      </div>
                  </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
          </div>
      </div>
      <!-- Carousel End -->


      <!-- Booking Start -->
      <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
          <div class="container">
              <div class="bg-white shadow" style="padding: 35px;">
                  <form class="row g-2" action="{{ route('find.rooms') }}" method="GET">
                      <div class="col-md-10">

                          <div class="row g-2">
                              <div class="col-md-3">
                                  <div class="date" id="" data-target-input="nearest">
                                      <input type="date" name="checkin" class="form-control datetimepicker-input"
                                          placeholder="Check in" data-target="#" data-toggle="datetimepicker" min={{$today}} />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="date" id="date2" data-target-input="nearest">
                                      <input type="date" name="checkout" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker" min={{$today}} />
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <select class="form-select" name="adults">
                                      <option selected value="0">Người lớn</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                  </select>
                              </div>
                              <div class="col-md-3">
                                  <select class="form-select" name="children">
                                      <option selected value="0">Trẻ em</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-2">
                          <button type="submit" class="btn btn-primary w-100">Tìm phòng</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      <!-- Booking End -->


      <!-- About Start -->
      <div class="container-xxl py-5">
          <div class="container">
              <div class="row g-5 align-items-center">
                  <div class="col-lg-6">
                      <h6 class="section-title text-start text-primary text-uppercase">Giới Thiệu</h6>
                      <h1 class="mb-4">Chào mừng đến với <span class="text-primary text-uppercase">Hotelier</span></h1>
                      <p class="mb-4">Nơi mang đến cho bạn trải nghiệm nghỉ dưỡng đẳng cấp, dịch vụ chuyên nghiệp và không gian tuyệt vời nhất.</p>
                      <div class="row g-3 pb-4">
                          <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                              <div class="border rounded p-1">
                                  <div class="border rounded text-center p-4">
                                      <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                      <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                      <p class="mb-0">Rooms</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                              <div class="border rounded p-1">
                                  <div class="border rounded text-center p-4">
                                      <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                      <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                      <p class="mb-0">Staffs</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                              <div class="border rounded p-1">
                                  <div class="border rounded text-center p-4">
                                      <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                      <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                      <p class="mb-0">Clients</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <a class="btn btn-primary py-3 px-5 mt-2" href="">Khám Phá</a>
                  </div>
                  <div class="col-lg-6">
                      <div class="row g-3">
                          <div class="col-6 text-end">
                              <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg" style="margin-top: 25%;">
                          </div>
                          <div class="col-6 text-start">
                              <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg">
                          </div>
                          <div class="col-6 text-end">
                              <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                          </div>
                          <div class="col-6 text-start">
                              <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- About End -->


      <!-- Room Start -->
      <style>
          .text-description {
              white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
          }
      </style>
      <div class="container-xxl py-5">
          <div class="container">
              <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                  <h6 class="section-title text-center text-primary text-uppercase">Phòng Thịnh Hành</h6>
              </div>
              <div class="row g-4">
                  @foreach($roomShow as $room)
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                      <div class="room-item shadow rounded overflow-hidden">
                          <div class="position-relative">
                              <img class="img-fluid" src="img/room-1.jpg" alt="">
                              <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{$room->price}}/Day</small>
                          </div>
                          <div class="p-4 mt-2">
                              <div class="d-flex justify-content-between mb-3">
                                  <h5 class="mb-0">{{$room->name}}</h5>
                                  <div class="ps-2">
                                      <small class="fa fa-star text-primary"></small>
                                      <small class="fa fa-star text-primary"></small>
                                      <small class="fa fa-star text-primary"></small>
                                      <small class="fa fa-star text-primary"></small>
                                      <small class="fa fa-star text-primary"></small>
                                  </div>
                              </div>
                              <div class="d-flex mb-3">
                                  <small class="border-end me-3 pe-3"><i class="fa fa-user text-primary me-2"></i>{{$room->occupancy}}</small>
                                  @foreach ($room->services as $service)
                                  @if (strpos(strtolower($service->name), 'wi-fi') !== false)
                                  <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                  @endif
                                  @endforeach
                              </div>
                              <p class="text-body mb-3 text-description">{{$room->description}}</p>
                              <div class="d-flex justify-content-between">
                                  <a class="btn btn-sm btn-primary rounded py-2 px-4" href="">Xem chi tiết</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
              </div>
          </div>
      </div>
      <!-- Room End -->




      <!-- Service Start -->
      <div class="container-xxl py-5">
          <div class="container">
              <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                  <h6 class="section-title text-center text-primary text-uppercase">Dịch Vụ Của Chúng Tôi</h6>
              </div>
              <div class="row g-4">
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                      <a class="service-item rounded" href="">
                          <div class="service-icon bg-transparent border rounded p-1">
                              <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                  <i class="fa fa-hotel fa-2x text-primary"></i>
                              </div>
                          </div>
                          <h5 class="mb-3">Phòng Và Căn Hộ</h5>
                          <p class="text-body mb-0">Cung cấp các phòng nghỉ hiện đại và căn hộ tiện nghi, phù hợp cho mọi nhu cầu lưu trú của bạn.</p>
                      </a>
                  </div>
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                      <a class="service-item rounded" href="">
                          <div class="service-icon bg-transparent border rounded p-1">
                              <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                  <i class="fa fa-utensils fa-2x text-primary"></i>
                              </div>
                          </div>
                          <h5 class="mb-3">Ẩm Thực & Nhà Hàng Cao Cấp</h5>
                          <p class="text-body mb-0">Thưởng thức ẩm thực đa dạng với các món ăn đặc sắc từ khắp nơi trên thế giới.</p>
                      </a>
                  </div>
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                      <a class="service-item rounded" href="">
                          <div class="service-icon bg-transparent border rounded p-1">
                              <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                  <i class="fa fa-spa fa-2x text-primary"></i>
                              </div>
                          </div>
                          <h5 class="mb-3">Thư Giãn & Sức Khỏe Toàn Diện</h5>
                          <p class="text-body mb-0">Thư giãn và phục hồi năng lượng với dịch vụ spa cao cấp và phòng tập hiện đại.</p>
                      </a>
                  </div>
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                      <a class="service-item rounded" href="">
                          <div class="service-icon bg-transparent border rounded p-1">
                              <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                  <i class="fa fa-swimmer fa-2x text-primary"></i>
                              </div>
                          </div>
                          <h5 class="mb-3">Thể Thao & Giải Trí Sôi Động</h5>
                          <p class="text-body mb-0">Trải nghiệm thể thao và giải trí thú vị với các tiện ích chuyên nghiệp.</p>
                      </a>
                  </div>
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                      <a class="service-item rounded" href="">
                          <div class="service-icon bg-transparent border rounded p-1">
                              <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                  <i class="fa fa-glass-cheers fa-2x text-primary"></i>
                              </div>
                          </div>
                          <h5 class="mb-3">Sự Kiện & Tiệc Tùng Hoàn Hảo</h5>
                          <p class="text-body mb-0">Địa điểm hoàn hảo để tổ chức sự kiện và các bữa tiệc đáng nhớ.</p>
                      </a>
                  </div>
                  <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                      <a class="service-item rounded" href="">
                          <div class="service-icon bg-transparent border rounded p-1">
                              <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                  <i class="fa fa-dumbbell fa-2x text-primary"></i>
                              </div>
                          </div>
                          <h5 class="mb-3">Tập Luyện & Thư Giãn Đỉnh Cao"</h5>
                          <p class="text-body mb-0">Rèn luyện sức khỏe và thư giãn tinh thần với các lớp yoga và phòng tập gym tiên tiến.</p>
                      </a>
                  </div>
              </div>
          </div>
      </div>
      <!-- Service End -->



      <!-- Team Start -->

      <!-- Team End -->



      @endsection