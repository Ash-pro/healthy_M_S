@include('website.layout.header')
<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12w mt-5" style="text-align: center">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">Thank you for using our site</h1>

                        <h4>
                            The exhibition team will contact you as soon as possible and inform you of all the details
                        </h4>
                        <br><br><br><br>

                        <form action="" method="GET">
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <a class="btn btn-success btn-lg" href="{{route('about')}}">Back to The Home Page</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->

@include('website.layout.footer')
