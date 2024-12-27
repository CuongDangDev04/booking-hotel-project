       @extends('user.user')
       @section('content')
       <!-- Page Header Start -->
       <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
           <div class="container-fluid page-header-inner py-5">
               <div class="container text-center pb-5">
                   <h1 class="display-3 text-white mb-3 animated slideInDown">Rooms</h1>
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb justify-content-center text-uppercase">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item"><a href="#">Pages</a></li>
                           <li class="breadcrumb-item text-white active" aria-current="page">Rooms</li>
                       </ol>
                   </nav>
               </div>
           </div>
       </div>
       <!-- Page Header End -->


       <!-- Booking Start -->
       <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
           <div class="container">
               <div class="bg-white shadow" style="padding: 35px;">
                   <form class="row g-2" action="{{ route('find.rooms') }}" method="GET">
                       <div class="col-md-10">

                           <div class="row g-2">
                               <div class="col-md-3">
                                   <div class="date" id="date1" data-target-input="nearest">
                                       <input type="date" name="checkin" class="form-control datetimepicker-input"
                                           placeholder="Check in" data-target="#date1" data-toggle="datetimepicker" min={{$today}} />
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="date" id="date2" data-target-input="nearest">
                                       <input type="date" name="checkout" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date2" data-toggle="datetimepicker" min={{$today}} />
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <select class="form-select" name="adults">
                                       <option selected value="0">Adult</option>
                                       <option value="1">Adult 1</option>
                                       <option value="2">Adult 2</option>
                                       <option value="3">Adult 3</option>
                                   </select>
                               </div>
                               <div class="col-md-3">
                                   <select class="form-select" name="children">
                                       <option selected value="0">Child</option>
                                       <option value="1">Child 1</option>
                                       <option value="2">Child 2</option>
                                       <option value="3">Child 3</option>
                                   </select>
                               </div>
                           </div>
                       </div>
                       <div class="col-md-2">
                           <button type="submit" class="btn btn-primary w-100">Submit</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
       <!-- Booking End -->


       <!-- Room Start -->
       <div class="container-xxl py-5">
           <div class="container">
               <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                   <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                   <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
               </div>

               <div class="row g-4">
                   @foreach ($rooms as $room)
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
                                   <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                                   @foreach ($room->services as $service)
                                   @if (strpos(strtolower($service->name), 'wi-fi') !== false)
                                   <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                   @endif
                                   @endforeach
                               </div>
                               <p class="text-body mb-3 room-description">{{$room->description}}</p>
                               <div class="d-flex justify-content-between">
                                   <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('room.show', ['room' => $room->roomType_id]) }}">View Detail</a>
                                   <a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
                               </div>
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
               <div class="d-flex justify-content-center mt-4">
                   <ul class="pagination">
                       {{-- Nút Previous --}}
                       @if ($currentPage > 1)
                       <li class="page-item">
                           <a class="page-link prev-btn" href="?page={{ $currentPage - 1 }}">Previous</a>
                       </li>
                       @else
                       <li class="page-item disabled">
                           <span class="page-link prev-btn">Previous</span>
                       </li>
                       @endif

                       {{-- Số trang --}}
                       @for ($i = 1; $i <= $pages; $i++)
                           <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                           <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                           </li>
                           @endfor

                           {{-- Nút Next --}}
                           @if ($currentPage < $pages)
                               <li class="page-item">
                               <a class="page-link next-btn" href="?page={{ $currentPage + 1 }}">Next</a>
                               </li>
                               @else
                               <li class="page-item disabled">
                                   <span class="page-link next-btn">Next</span>
                               </li>
                               @endif
                   </ul>
               </div>
           </div>

       </div>
       <!-- Room End -->


       <!-- Testimonial Start -->
       <div class="container-xxl testimonial mt-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s" style="margin-bottom: 90px;">
           <div class="container">
               <div class="owl-carousel testimonial-carousel py-5">
                   <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                       <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd et erat magna eos</p>
                       <div class="d-flex align-items-center">
                           <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 45px; height: 45px;">
                           <div class="ps-3">
                               <h6 class="fw-bold mb-1">Client Name</h6>
                               <small>Profession</small>
                           </div>
                       </div>
                       <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                   </div>
                   <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                       <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd et erat magna eos</p>
                       <div class="d-flex align-items-center">
                           <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg" style="width: 45px; height: 45px;">
                           <div class="ps-3">
                               <h6 class="fw-bold mb-1">Client Name</h6>
                               <small>Profession</small>
                           </div>
                       </div>
                       <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                   </div>
                   <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                       <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd et erat magna eos</p>
                       <div class="d-flex align-items-center">
                           <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg" style="width: 45px; height: 45px;">
                           <div class="ps-3">
                               <h6 class="fw-bold mb-1">Client Name</h6>
                               <small>Profession</small>
                           </div>
                       </div>
                       <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                   </div>
               </div>
           </div>
       </div>
       <!-- Testimonial End -->


       <!-- Newsletter Start -->
       <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
           <div class="row justify-content-center">
               <div class="col-lg-10 border rounded p-1">
                   <div class="border rounded text-center p-1">
                       <div class="bg-white rounded text-center p-5">
                           <h4 class="mb-4">Subscribe Our <span class="text-primary text-uppercase">Newsletter</span></h4>
                           <div class="position-relative mx-auto" style="max-width: 400px;">
                               <input class="form-control w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                               <button type="button" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Submit</button>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- Newsletter Start -->
       @endsection