@include('website.layout.header')

<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-12 text-white" style="text-align: center">
                <h1 style="font-size: 70px" >Who US</h1>
                <p style="font-size: 18px!important;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur delectus dolore excepturi expedita nisi quia voluptate? Enim error, officia! Aliquid aperiam eum excepturi inventore nemo quo rem sit tempora tenetur?
                </p>

            </div>
{{--            <div class="col-md-4">--}}
{{--                <img src="{{asset('assets')}}/assets/img/about-hero.svg" alt="About Hero">--}}
{{--            </div>--}}
        </div>
    </div>
</section>
<!-- Close Banner -->

<!-- Start Section -->
<section class="container py-5">
    <div class="row text-center pt-5 pb-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Our services</h1>
            <p>
                We provide you with many special services, including:
            </p>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fa fa-user fa-lg"></i></div>
                <h2 class="h5 mt-4 text-center">Consulting</h2>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fas fa-book-medical"></i></div>
                <h2 class="h5 mt-4 text-center">Medical Services</h2>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                <h2 class="h5 mt-4 text-center">Promotion</h2>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                <h2 class="h5 mt-4 text-center">24 Hours Service</h2>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->
<form action="" method="GET">
    <input type="hidden" name="product-title" value="Activewear">
    <div class="row pb-3">
        <div class="col d-grid">
            <a class="btn btn-success btn-lg" href="{{route('contact')}}">Email us</a>
        </div>
    </div>
</form>


@include('website.layout.footer')
