<?php

include 'components/connect.php';
$database = new Database();
$conn = $database->getConnection();


session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TechFusion | Home </title>
    <link rel="shortcut icon" href="./images/logo.ico" />

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/customer.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <style>


.about {
  position: relative;
  background: white;
  padding: 100px;
}
.about h2 {
  font-size: 5em;
  color: #FF6B6B;
  text-shadow: 2px 2px 2px black;
  text-transform: uppercase;
  margin-bottom: 10px;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.about span {
  color: black;
}
.about p {
  font-size: 1em;
  font-weight: 300;
  margin-bottom: 10px;
}
.steps{
  display: flex;
  flex-wrap: wrap;
  gap:1.5rem;
  padding:1rem;
}

.steps .box{
  flex:1 1 25rem;
  padding:1rem;
  text-align: center;
}

.steps .box img{
  border-radius: 50%;
  border:1rem solid #fff;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.1);
}

.steps .box h3{
  font-size: 3rem;
  color:#000;
  padding:1rem;
}
.review .box-container{
  display: flex;
  flex-wrap: wrap;
  gap:1.5rem;
}

.review .box-container .box{
  text-align: center;
  padding:2rem;
  border:1rem solid #fff;
  box-shadow: 0 .5rem 1rem rgba(0,0,0,.3);
  border-radius: .5rem;
  flex:1 1 30rem;
  background:#333;
  margin-top: 6rem;
}

.review .box-container .box img{
  height: 12rem;
  width:12rem;
  border-radius: 50%;
  border:1rem solid #fff;
  margin-top: -8rem;
  object-fit: cover;
}

.review .box-container .box h3{
  font-size: 2.5rem;
  color:#fff;
  padding:.5rem 0;
}

.review .box-container .box .stars i{
  font-size: 2rem;
  color: white;
  padding:.5rem 0;
}

.review .box-container .box p{
  font-size: 1.5rem;
  color:#eee;
  padding:1rem 0;
}
.heading{
  text-align: center;
  font-size: 3.5rem;
  padding:1rem;
  color:#000;
}

.home{
  display: flex;
  flex-wrap: wrap;
  gap:1.5rem;
  min-height: 100vh;
  align-items: center;
  background:url(../img/donnu-remove-bg-preview.png) no-repeat;
  background-size: cover;
  background-position: center;
}

.home .content{
  flex:1 1 40rem;
  padding-top: 6.5rem;
}

.home .image{
  flex:1 1 40rem;
}

.home .image img{
  width:100%;
  padding:1rem;
}



.home .content h3{
  font-size: 5rem;
  color:#000;
}

.home .content p{
  font-size: 1.7rem;
  color:#000;
  padding:1rem 0;
}

#loginow{
   margin-top: 1rem;
   display: inline-block;
   font-size: 2rem;
   padding:1rem 3rem;
   cursor: pointer;
   text-transform: capitalize;
   transition: .2s linear;
}

#i{
   color:var(--gayjuan);
}
#about{
   font-size: 3.5rem;
}
@media only screen and (max-width: 767px){
.navbar-nav {
  text-align: center;
}
.w-100 {
  height: 62%;
}


.about {
  padding: 25px;
}
.about h2 {
  font-size: 3em;
  margin-bottom: 10px;
}
.about p {
  margin-bottom: 10px;
}
@media(max-width:991px){

html{
  font-size: 55%;
}

header{
  padding:2rem;
}

section{
  padding:2rem;
}

}

@media(max-width:768px){


}

@media(max-width:450px){

html{
  font-size: 50%;
}

.order .row form .inputBox input{
  width:100%;
}

}

}

   </style>
</head>
<body >

<?php include 'components/user_header.php'; ?>

<br>

<!--HOME-->
<section class="home" id="home">

    <div class="content">
        <h3>Fuse your tech with ease, shop components at  <span id="i">TechFusion.</span></h3>
    </div>
    <div class="image">
        <img src="images/steps/pc.png" alt="">
    </div>
</section>


 <!-- About Us -->
 <div id="about" class="container-xxl py-5">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <div class="row g-3">
            <div class="col-6 text-end">
              <img src="images/PC1.png" alt="" class="img-fluid rounded w-75" style="margin-top: 17%;">
            </div>
            <div class="col-6 text-start">
              <img src="images/PC2.webp" alt="" class="img-fluid rounded w-75" style="margin-top: 17%;">
            </div>
            <div class="col-6 text-end">
              <img src="images/PC3.jpg" alt="" class="img-fluid rounded w-75">
            </div>
            <div class="col-6 text-start">
              <img src="images/PC4.jpg" alt="" class="img-fluid rounded w-75">
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <h1 class="section-title ff-secondary text-start fw-normal" id="about">About <span id="i">Us</span><br><br></h1>
          <h3 class="mb-4 text-dark">At TechFusion, we are passionate about delivering seamless technology integration 
            to our customers through our online computer component store. Established in year, our aim has always been 
            to provide computer enthusiasts and businesses with easy access to the latest and most reliable computer components.
            <br><br>
            Our extensive inventory features high-quality products from leading brands in the computer industry, including 
            processors, motherboards, memory, storage devices, power supplies, and more. Our team of experts carefully curates 
            our selection to ensure that we offer only the best products to our customers.<br><br>

            At TechFusion, we believe in providing excellent customer service and support. Our knowledgeable staff is always 
            ready to assist customers with product selection, troubleshooting, and technical support. We take pride in 
            delivering prompt and reliable shipping to ensure that our customers receive their orders on time.<br><br>

            Whether you're building a new computer or upgrading an existing system, TechFusion is your one-stop online 
            shop for all your computer component needs. We invite you to experience the convenience of shopping with us 
            and join the many satisfied customers who have made TechFusion their go-to source for computer components.</h3>

            <div class="row g-4 mb-4">
              <div class="col-sm-6">
                <div class="d-flex align-items-center border-start border-5 border-secondary px-3">
                  <h1 class="flex-shrink-0 display-5 mb-0" data-toggle="counter-up">8</h1>
                  <div class="ps-4">
                    <p class="mb-0">Years of</p>
                    <h6 class="text-uppercase mb-0">Experience</h6>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-center border-start border-5 border-secondary px-3">
                  <h1 class="flex-shrink-0 display-5 mb-0" data-toggle="counter-up">4</h1>
                  <div class="ps-4">
                    <p class="mb-0">Popular</p>
                    <h6 class="text-uppercase mb-0">PC Builder</h6>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>
  </div>

<!--REVIEW-->
<section class="review" id="review">
  <h1 class="heading">Customers <span id="i">Reviews</span> </h1>
  <div class="box-container">
      <div class="box">
          <img src="images/reviewer/Wolvic.jpg" alt="">
          <h3>Wolvic John Lim</h3>
          <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
          </div>
          <p>The team at TechFusion are extremely courteous, proficient and competent. I highly recommend them for all your computer needs.</p>
      </div>
      <div class="box">
          <img src="images/reviewer/Carlo.png" alt="">
          <h3>Carlo Velvestre</h3>
          <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
          </div>
          <p>Everyone here has been super helpful, professional, friendly and efficient! They take the time to educate you where needed with your computer and they are super proficient. They provide great service at a great price! you have to come here for your computer needs!</p>
      </div>
      <div class="box">
          <img src="images/reviewer/Mark.jpg" alt="">
          <h3>Mark Gocotano</h3>
          <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
          </div>
          <p>All staff was so kind and helpful. They diagnosed the problem and got it all fixed. Highly recommend TechFusion for repairs..</p>
      </div>
  </div>
</section>










<<!-- custom js file link  -->
<script src="js/customer.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<div class="loader">
   <img src="images/he.gif" alt="">
</div>




</body>
</html>