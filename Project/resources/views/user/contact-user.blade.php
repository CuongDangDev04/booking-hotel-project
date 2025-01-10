       @extends('user.user')
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
                   <h1 class="display-3 text-white mb-3 animated slideInDown">Liên Hệ</h1>
                   <nav aria-label="breadcrumb">
                       <ol class="breadcrumb justify-content-center text-uppercase">
                           <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                           <li class="breadcrumb-item"><a href="#">Trang</a></li>
                           <li class="breadcrumb-item text-white active" aria-current="page">Liên hệ</li>
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
                           <button type="submit" class="btn btn-primary w-100">Tìm Phòng</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
       <!-- Booking End -->


       <!-- Contact Start -->
       <div class="container-xxl py-5">
           <div class="container">
               <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                   <h6 class="section-title text-center text-primary text-uppercase">Liên Hệ Chúng Tôi</h6>
                   <h1 class="mb-5"><span class="text-primary text-uppercase">Liên Hệ</span> Nếu Có Bất Kỳ Câu Hỏi Nào</h1>
               </div>
               <div class="row g-4">
                   <div class="col-12">
                       <div class="row gy-4">
                           <div class="col-md-4">
                               <h6 class="section-title text-start text-primary text-uppercase">Đặt Phòng</h6>
                               <p><i class="fa fa-envelope-open text-primary me-2"></i>cuongdang.270920@gmail.com</p>
                           </div>
                           <div class="col-md-4">
                               <h6 class="section-title text-start text-primary text-uppercase">Chung</h6>
                               <p><i class="fa fa-envelope-open text-primary me-2"></i>fit@ntt.edu.vn</p>
                           </div>
                           <div class="col-md-4">
                               <h6 class="section-title text-start text-primary text-uppercase">Kỹ Thuật</h6>
                               <p><i class="fa fa-envelope-open text-primary me-2"></i>dainam15986@gmail.com</p>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                       <iframe class="position-relative rounded w-100 h-100"
                           src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7836.730403219857!2d106.6870623767935!3d10.859802994138716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529c17978287d%3A0xec48f5a17b7d5741!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBOZ3V54buFbiBU4bqldCBUaMOgbmggLSBDxqEgc-G7nyBxdeG6rW4gMTI!5e0!3m2!1svi!2s!4v1736522230788!5m2!1svi!2s"
                           frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                           tabindex="0"></iframe>
                   </div>
                   <div class="col-md-6">
                       <div class="wow fadeInUp" data-wow-delay="0.2s">
                           <form action="{{ route('contact.store') }}" method="POST">
                               @csrf
                               <div class="row g-3">
                                   <div class="col-md-6">
                                       <div class="form-floating">
                                           <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                           <label for="name">Tên</label>
                                       </div>
                                   </div>
                                   <div class="col-md-6">
                                       <div class="form-floating">
                                           <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                                           <label for="email">Email</label>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-floating">
                                           <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                           <label for="subject">Tiêu Đề</label>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <div class="form-floating">
                                           <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 150px" required></textarea>
                                           <label for="message">Vấn đề</label>
                                       </div>
                                   </div>
                                   <div class="col-12">
                                       <button class="btn btn-primary w-100 py-3" type="submit">Gửi</button>
                                   </div>
                               </div>
                           </form>

                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- Contact End -->



       @endsection