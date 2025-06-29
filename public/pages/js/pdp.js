function getDataByWindowUrlKey() {
    let windowUrl = $(location).attr("href");
    let windowUrlKey = windowUrl.replace(/\/\s*$/, "").split("/").pop();
    let url = baseUrl + "/api/bouquet/" + windowUrlKey;

    axios
        .get(url, {}, apiHeaders)
        .then(function (response) {
            let product = response.data.data;
            console.log('[DATA] response..', product);
            let template = '';

            // Handle cover image
            let coverPath = product.image;
            if (coverPath && !coverPath.startsWith('/')) {
                coverPath = '/' + coverPath;
            }

            $('.product-img-main-href').attr('href', coverPath);
            $('.product-img-main-src').attr('src', coverPath);

            
            // Set product info
            $('#product-name').html(product.name ?? '-');
            $('#product-price').html("IDR " + parseFloat(product.price ?? 0).toLocaleString());
            $('#product-description').html(product.description ?? '-');
            $('#product-category').html(product.category ?? '-');
            $('#product-flower-type').html(product.type ?? '-');

            // Review stars (simulasi)
            let stars = randomIntFromInterval(3, 5);
            template = '';
            for (let i = 0; i < 5; i++) {
                template += `<i class="${i < stars ? 'yellow' : ''} icon_star"></i>`;
            }
            $('#product-review-stars').html(template);
            $('#product-review-body-count').html(randomIntFromInterval(5, 200) + ' customer reviews');

            // Stock status (simulasi)
            let statusStock = randomIntFromInterval(0, 1);
            $('#product-status-stock').removeClass('in-stock out-of-stock');
            $('#product-status-stock').addClass(statusStock ? 'in-stock' : 'out-of-stock');
            $('#product-status-stock').html(
                statusStock
                    ? '<p>Available: <span>In stock</span></p>'
                    : '<p>Available: <span>Out of stock</span></p>'
            );

            if (!statusStock) {
                $('.product-add-to-cart').hide();
                $('.product-add-to-cart-is-disabled').show();
            } else {
                $('.product-add-to-cart').show();
                $('.product-add-to-cart-is-disabled').hide();
            }

            // Tags (random)
            let collectionOfTag = [
                'Fresh Flowers', 'Anniversary', 'Graduation',
                'Romantic', 'Birthday', 'Elegant', 'Pastel Theme',
                'Valentine', 'Sympathy', 'Wedding'
            ];
            let selectedTags = collectionOfTag.sort(() => 0.5 - Math.random()).slice(0, 4);
            template = '';
            for (let i = 0; i < selectedTags.length; i++) {
                template += `<a href="#">${selectedTags[i]}</a>${i !== selectedTags.length - 1 ? ', ' : ''}`;
            }
            $('#product-tags').html(template);

            // Thumbnails
            if (product.thumbnails) {
                try {
                    let thumbs = JSON.parse(product.thumbnails); // format array JSON
                    let thumbTemplate = '';

                    thumbs.forEach(path => {
                        if (path && !path.startsWith('/')) {
                            path = '/' + path;
                        }

                        thumbTemplate += `
                            <div class="sm-image">
                                <img src="${path}" alt="product image thumb">
                            </div>`;
                    });

                    $('.slider-thumbs-2').html(thumbTemplate);
                } catch (e) {
                    console.warn('Gagal parsing thumbnails:', e);
                }
            }

            // Convert thumbnails ke array dulu
            let thumbs = [];

            try {
                thumbs = JSON.parse(product.thumbnails || '[]');
            } catch (e) {
                console.error("Failed to parse thumbnails JSON:", e);
            }

            // Generate thumbnail list
            let thumbTemplate = '';
            thumbs.forEach(path => {
                if (path && !path.startsWith('/')) {
                    path = '/' + path;
                }

                thumbTemplate += `
                    <div class="sm-image">
                        <img src="${path}" 
                            alt="product image thumb" 
                            class="thumbnail-clickable" 
                            data-full="${path}">
                    </div>`;
            });

            // Masukkan ke container thumbnails
            $('.product-details-thumbs-2').html(thumbTemplate);

        })
        .catch(function (error) {
            console.log('[ERROR] response..', error);
            if (error.code === "ERR_BAD_REQUEST") {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Yaah...",
                    html: "Bouquet yang Anda cari tidak ditemukan",
                    showConfirmButton: false,
                    timer: 5000,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    width: 600,
                    title: "Error",
                    html: error.message,
                    confirmButtonText: 'Ya',
                });
            }
        });
}

function randomIntFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}

// Event listener ganti gambar utama saat thumbnail diklik
$(document).on('click', '.thumbnail-clickable', function () {
    let newSrc = $(this).data('full');
    $('.product-img-main-src').attr('src', newSrc);
    $('.product-img-main-href').attr('href', newSrc);
});

$(function () {
    getDataByWindowUrlKey();
});

