let id_el_list = "#product-preview";

function getData() {
    let url = baseUrl + "/api/bouquet";
    let payload = {
        _limit: 3,
        _page: 1,
        _sort_by: "latest_publication",
    };

    axios
        .get(url, { params: payload }, apiHeaders)
        .then(function (response) {
            console.log("[DATA] Bouquets:", response.data);
            let template = "";

            (response.data.products || []).forEach((item) => {
                template += `
                    <div class="single-hero-slider-7" style="background-color: #fef4f5;" onclick="location.href='${baseUrl}/bouquet/${
                    item.id
                }'">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="hero-content-wrap">
                                        <div class="hero-text-7 mt-lg-5">
                                            <h6 class="mb-20">Made to bloom your moments</h6>
                                            <h1 style="font-family: 'Playfair Display', serif; font-size: 80px; font-weight: 600; color: #333;">
                                                ${breakWord(item.name)}
                                            </h1>
                                            <div class="button-box section-space--mt_60">
                                                <a href="#" class="text-btn-normal font-weight--reguler font-lg-p">See the collection</a>
                                            </div>
                                        </div>
                                        <div class="inner-images">
                                            <div class="image-one">
                                                <img src="${
                                                    item.image
                                                }" width="500" class="img-fluid" alt="Cover Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });

            if ($(id_el_list).length > 0) {
                $(id_el_list).html(template);
                $(id_el_list).slick({
                    dots: false,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    prevArrow:
                        '<span class="arrow-prv"><i class="icon-chevron-left"></i></span>',
                    nextArrow:
                        '<span class="arrow-next"><i class="icon-chevron-right"></i></span>',
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 1,
                            },
                        },
                    ],
                });
            }
        })
        .catch(function (error) {
            console.log("[ERROR] Bouquet API:", error);
            Swal.fire({
                icon: "error",
                width: 600,
                title: "Error",
                html: error.message,
                confirmButtonText: "Ya",
            });
        });
}

$(function () {
    // Inject Google Font (Playfair Display) to head if not already present
    if (!$("link[href*='fonts.googleapis.com/css2?family=Playfair+Display']").length) {
        $('head').append('<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">');
    }

    getData();
});
