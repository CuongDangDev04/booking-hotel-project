       @extends('user.user')
       @section('title', 'Phòng')
       @section('content')
       <style>
           .footer {
               margin-top: 100px;
               padding-top: 0;
           }
       </style>
       <!-- Page Header Start -->
       <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
           <div class="container-fluid page-header-inner py-5">
               <div class="container text-center pb-5">
                   <h1 class="display-3 text-white mb-3 animated slideInDown">Phòng</h1>
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb justify-content-center text-uppercase">
                           <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                           <li class="breadcrumb-item"><a href="#">Trang</a></li>
                           <li class="breadcrumb-item text-white active" aria-current="page">Phòng</li>
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


       <!-- Room Start -->
       <div class="container-xxl py-5">
           <div class="container">
               <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                   <h6 class="section-title text-center text-primary text-uppercase">Phòng</h6>
               </div>

               <div class="row g-4">
                   @foreach ($rooms as $room)
                   <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                       <div class="room-item shadow rounded overflow-hidden">
                           <div class="position-relative">
                               <img class="img-fluid" src="img/room-1.jpg" alt="">
                               <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">{{$room->price}}/Ngày</small>
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
                               <p class="text-body mb-3 room-description">{{$room->description}}</p>
                               <div class="d-flex justify-content-between">
                                   <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ route('room.show', ['room' => $room->roomType_id]) }}">Xem chi tiết</a>
                               </div>
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
               <style>
                   .prev-btn,
                   .next-btn {
                       min-width: 50px;
                   }
               </style>
               <div class="d-flex justify-content-center mt-4">
                   <ul class="pagination">
                       {{-- Nút Previous --}}
                       @if ($currentPage > 1)
                       <li class="page-item">
                           <a class="page-link prev-btn" href="?page=1"><i class="fas fa-backward"></i></a>
                       </li>
                       <li class="page-item">
                           <a class="page-link prev-btn" href="?page={{ $currentPage - 1 }}"><i class="fas fa-chevron-left"></i></a>
                       </li>
                       @else
                       <li class="page-item disabled">
                           <span class="page-link prev-btn"><i class="fas fa-backward"></i></span>
                       </li>
                       <li class="page-item disabled">
                           <span class="page-link prev-btn"><i class="fas fa-chevron-left"></i></span>
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
                               <a class="page-link next-btn" href="?page={{ $currentPage + 1 }}"><i class="fas fa-chevron-right"></i></a>
                               </li>
                               <li class="page-item">
                                   <a class="page-link next-btn" href="?page={{ $pages }}"><i class="fas fa-forward"></i></a>
                               </li>
                               @else
                               <li class="page-item disabled">
                                   <span class="page-link next-btn"><i class="fas fa-chevron-right"></i></span>
                               </li>
                               <li class="page-item disabled">
                                   <span class="page-link next-btn"><i class="fas fa-forward"></i></span>
                               </li>
                               @endif
                   </ul>
               </div>
           </div>

       </div>
       <!-- Room End -->



       @endsection