<?php include './adminpanel/superadmin/config.php'   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dare to Design</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/emuinventlogo.jpg" rel="icon" type="image/jpg">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- <link href="assets/lib/animate/animate.min.css" rel="stylesheet"> -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css?v=2" rel="stylesheet">
    <style>
        .event-carousel .owl-item{
            margin-top: 40px;
            margin-bottom: 40px;
           /* margin: 0 10px ; */
           /* margin-right: 0; */
            

        }
        .event-carousel .owl-item .icon-img{
            max-width: 100%!important;
            width: auto!important;
        }
        .event-carousel .owl-dots {
    text-align: center; /* Center the dots horizontally */
     /* Adjust the margin to control the space between items and dots */
  }
  
  /* Style the individual dot */
  .event-carousel .owl-dot {
    display: inline-block;
    margin: 0 5px; /* Adjust the margin between dots */
  }
  
  /* Style the active dot */
  .event-carousel .owl-dot {
    border:1px solid green; /* Change the active dot's background color */
    border-radius: 50%; /* Make the dots circular */
    width: 10px; /* Adjust the width and height of the dots */
    height: 10px;
  }
    </style>
   
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <?php include  'header.php'; ?>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="img/slide4.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <h1 class="display-1 text-white mb-md-5 animated slideInDown">Invent, Explore, Excel</h1>
                                <!-- <a href="" class="btn btn-primary py-sm-3 px-sm-4">More</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Carousel End -->


    <!-- Top Feature Start -->
    <div class="container-fluid top-feature py-md-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 260px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fas fa-flask text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Unleash Innovation!</h4>
                                <span>Innovative program for students in grades 3-12. EMUiNVENT leads to Invention Convention Michigan.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 260px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fas fa-paint-brush text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Ignite Creativity</h4>
                                <span>EMUiNVENT fuels creative thinking across diverse disciplines, inspiring inventive solutions to real-world challenges.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 260px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fas fa-star text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Path to Excellence</h4>
                                <span>EMUiNVENT propels students towards Invention Convention Michigan, where exceptional inventors showcase their ideas and compete for prizes.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Feature End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end">
                <div class="col-lg-3 col-md-5  my-0 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" data-wow-delay="0.1s" src="img/about2.jpg" style="width:100%; height:100%;">
                </div>
                <div class="col-lg-6 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="display-1 text-primary mb-0">March, 2023</h1>
                    <p class="text-primary mb-4">Statewide Invention Convention competition</p>
                    <h1 class="display-5 mt-3 ">Our Success</h1>
                    <p class="mb-4  mt-3">We are delighted to share the remarkable achievements of the winners from the EMUiNVENT March 2023 competition, who had the opportunity to compete in the esteemed Statewide Invention Convention competition. We are proud to announce that our exceptional teams secured an impressive three out of nine major awards. Their outstanding performance has earned them the honor of representing the great state of Michigan at the upcoming Raytheon Technologies Invention Convention US Nationals.</p>

                </div>
                <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row g-5">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="border-start ps-4">
                                <i class="fa fa-award fa-3x text-primary mb-3"></i>
                                <h4 class="mb-3">Award Winning</h4>
                                <span>We are proud to announce that our exceptional teams secured an impressive three out of nine major awards.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="border-start ps-4">
                                <i class="fas fa-trophy fa-3x text-primary mb-3"></i>
                                <h4 class="mb-3">Achievement</h4>
                                <span>
                                    Their outstanding performance has earned them the honor of representing Michigan at the upcoming Raytheon Technologies Invention Convention US Nationals.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-fluid facts my-5 py-5" data-parallax="scroll" data-image-src="img/back.png">
        <div class="container py-5">
            <div class="row g-5">
                <?php $squery = mysqli_query($conn, "SELECT * from tbl_user where user_type='student'");
                $jquery = mysqli_query($conn, "SELECT * from tbl_user where user_type='Judge'");
                $mquery = mysqli_query($conn, "SELECT * from tbl_user where user_type='Mentor'");
                $tquery = mysqli_query($conn, "SELECT * from tbl_team ");

                $row = mysqli_num_rows($squery); ?>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-4 text-white" data-toggle="counter-up"><?php echo $row; ?></h1>
                    <span class="fs-5 fw-semi-bold text-light">Our Students</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-4 text-white" data-toggle="counter-up"><?php echo mysqli_num_rows($mquery); ?></h1>
                    <span class="fs-5 fw-semi-bold text-light">Our Mentors</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-4 text-white" data-toggle="counter-up"><?php echo mysqli_num_rows($jquery) ?></h1>
                    <span class="fs-5 fw-semi-bold text-light">Our Judges</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <h1 class="display-4 text-white" data-toggle="counter-up"><?php echo mysqli_num_rows($tquery)  ?></h1>
                    <span class="fs-5 fw-semi-bold text-light">Our Team Projects</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->





    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Our Event</p>
                <h1 class="display-5 mb-5">Event We Have Done</h1>
                <h1 class="display-5 mb-5">Past Events</h1>
            </div>
            <div class="owl-carousel event-carousel row g-4 mb-5  "  >
                <div class=" event-item wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/service-1.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-3.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Landscaping</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" event-item wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/service-2.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-6.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pruning plants</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" event-item wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/service-3.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-5.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Irrigation & Drainage</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" event-item wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/service-2.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-6.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pruning plants</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" event-item wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/service-3.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-5.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Irrigation & Drainage</h4>
                            <p class="mb-4">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
                            <a class="btn btn-sm" href=""><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
               
                <h1 class="display-5 mb-5">Current Events</h1>
            </div>
            <div class="owl-carousel event-carousel row g-4 mb-5  "  >
                <div class=" event-item wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/event2.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-4">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-3.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Learn Inventor Habits</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia nostrum quidem assumenda neque libero error, aliquam blanditiis eius pariatur sit rerum consequuntur perspiciatis, voluptate ab dolorum doloribus qui minus enim!</p>
                            <a class="btn btn-sm" href="img/event2.jpg" target="blank"><i class="fa fa-plus text-primary me-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
                <div class=" event-item wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/event2.png" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-6.png" alt="Icon">
                            </div>
                            <h4 class="mb-3">Sustainable Product Design</h4>
                            <p class="mb-4">A course designed for high school students and freshman. Learn about latest concepts in Business and Engineering.</p>
                            <a class="btn btn-sm" href="img/event2.png" target="blank"><i class="fa fa-plus text-primary me-2"></i>Read More</a>   </div>
                    </div>
                </div>
                <div class=" event-item wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="img/event3.jpg" alt="">
                        </div>
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid icon-img" src="img/icon/icon-5.png" alt="Icon">
                            </div>
                          <h4 class="mb-3">Summer Internship Opportunity</h4>
                            <p class="mb-4">Do you dabble with traditional crafts or newer technologies(AI,Coding,Robotics or IoT)?</p>
                              <a class="btn btn-sm" href="img/event3.jpg" target="blank"><i class="fa fa-plus text-primary me-2"></i>Read More</a>    </div>
                    </div>
                </div>
               
                

            </div>
        </div>
    </div>
    <!-- Service End -->





    <!-- Projects Start -->
    <!-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Our Projects</p>
                <h1 class="display-5 mb-5">Some Of Our Wonderful Projects</h1>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12 text-center">
                    <ul class="list-inline rounded mb-5" id="portfolio-flters">
                        <li class="mx-2 active" data-filter="*">All</li>
                        <li class="mx-2" data-filter=".first">Complete Projects</li>
                        <li class="mx-2" data-filter=".second">Ongoing Projects</li>
                    </ul>
                </div>
            </div>
            <div class="row g-4 portfolio-container">
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner rounded">
                        <img class="img-fluid" src="img/service-1.jpg" alt="">
                        <div class="portfolio-text">
                            <h4 class="text-white mb-4">Landscaping</h4>
                            <div class="d-flex">
                                <a class="btn btn-lg-square rounded-circle mx-2" href="img/service-1.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square rounded-circle mx-2" href=""><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.3s">
                    <div class="portfolio-inner rounded">
                        <img class="img-fluid" src="img/service-2.jpg" alt="">
                        <div class="portfolio-text">
                            <h4 class="text-white mb-4">Pruning plants</h4>
                            <div class="d-flex">
                                <a class="btn btn-lg-square rounded-circle mx-2" href="img/service-2.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square rounded-circle mx-2" href=""><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.5s">
                    <div class="portfolio-inner rounded">
                        <img class="img-fluid" src="img/service-3.jpg" alt="">
                        <div class="portfolio-text">
                            <h4 class="text-white mb-4">Irrigation & Drainage</h4>
                            <div class="d-flex">
                                <a class="btn btn-lg-square rounded-circle mx-2" href="img/service-3.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square rounded-circle mx-2" href=""><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner rounded">
                        <img class="img-fluid" src="img/service-4.jpg" alt="">
                        <div class="portfolio-text">
                            <h4 class="text-white mb-4">Garden Maintenance</h4>
                            <div class="d-flex">
                                <a class="btn btn-lg-square rounded-circle mx-2" href="img/service-4.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square rounded-circle mx-2" href=""><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.3s">
                    <div class="portfolio-inner rounded">
                        <img class="img-fluid" src="img/service-5.jpg" alt="">
                        <div class="portfolio-text">
                            <h4 class="text-white mb-4">Green Technology</h4>
                            <div class="d-flex">
                                <a class="btn btn-lg-square rounded-circle mx-2" href="img/service-5.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square rounded-circle mx-2" href=""><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
                    <div class="portfolio-inner rounded">
                        <img class="img-fluid" src="img/service-6.jpg" alt="">
                        <div class="portfolio-text">
                            <h4 class="text-white mb-4">Urban Gardening</h4>
                            <div class="d-flex">
                                <a class="btn btn-lg-square rounded-circle mx-2" href="img/service-6.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-lg-square rounded-circle mx-2" href=""><i class="fa fa-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Projects End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Our Team</p>
                <h1 class="display-5 mb-5">Dedicated & Experienced Team Members</h1>
            </div>
            
            <div class="owl-carousel mentor-carousel row g-4">
                
                
                <div class="owl-item  wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="img/mentor1.jpg" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Colleen Strover</h4>
                            <p class="text-primary">Student BS(Product Design Engineering)</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item  wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="img/mentor2.jpg" alt="">
                        <div class="team-text">
                        <h4 class="mb-0">Rami Mustafa</h4>
                            <p class="text-primary">BS (Electrical Engineering)</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item   wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="img/Mentor4.png" alt="">
                        <div class="team-text">
                        <h4 class="mb-0">Jozilla Scott</h4>
                            <p class="text-primary">BS (Electrical Engineering)</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-item  wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="img/mentor3.jpg" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Tariq Nitham Othman </h4>
                            <p class="text-primary">BS (Electrical Engineering)</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
           
        </div>
    </div>
    <!-- Team End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Our Partners</p>
                <h1 class="display-5 mb-5">Partners That Are Sponsoring Us</h1>
            </div>
            <!-- Vendor Start -->
            <div class="container-fluid py-2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container py-2 mb-2">
                    <div class="bg-white">
                        <div class="owl-carousel vendor-carousel">
                            <img src="img/SPARK.png" alt="">
                            <img src="img/fcc.png" alt="">
                            <img src="img/EMUBF.png" alt="">
                            <img src="img/MSTEM.png" alt="">
                            <img src="img/toyota.png" alt="">
                            <img src="img/fcc.png" alt="">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vendor End -->
        </div>
    </div>

    <?php

    include 'footer.php';
    ?>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>



</body>

</html>