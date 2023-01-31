<section class="hero-banner">
    <div class="hero-slider-wrapper">

    <?php getFeaturedBanners(); ?>

    </div>
</section>

<script type="text/javascript">
    $('.hero-slider-wrapper').slick({
        slidesToShow: 1,
        dots: true,
        arrows: false,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
    });
</script>