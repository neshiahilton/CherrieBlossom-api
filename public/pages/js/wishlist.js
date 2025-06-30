document.addEventListener("DOMContentLoaded", function () {
    const wishlistKey = 'guest_wishlist';
    const token = localStorage.getItem('access_token'); // Token user login

    // --- HELPERS: LOCALSTORAGE MODE (Guest) ---
    function getGuestWishlistIds() {
        const stored = localStorage.getItem(wishlistKey);
        return stored ? JSON.parse(stored) : [];
    }

    function saveGuestWishlistIds(ids) {
        localStorage.setItem(wishlistKey, JSON.stringify(ids));
    }

    function toggleGuestWishlist(productId) {
        const ids = getGuestWishlistIds();
        const index = ids.indexOf(productId);
        if (index === -1) {
            ids.push(productId);
        } else {
            ids.splice(index, 1);
        }
        saveGuestWishlistIds(ids);
    }

    // --- ACTION: Tambah/Hapus Wishlist (Handler) ---
    function addToWishlist(productId) {
        if (!token) {
            toggleGuestWishlist(productId);
            alert('Ditambahkan ke wishlist (tanpa login)');
            return;
        }

        axios.post('/api/wishlist', {
            bouquet_id: productId
        }, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(res => {
            alert('Ditambahkan ke wishlist kamu!');
        }).catch(err => {
            alert('Gagal menambahkan ke wishlist.');
        });
    }

    function removeFromWishlist(productId) {
        if (!token) {
            const ids = getGuestWishlistIds().filter(id => id !== productId);
            saveGuestWishlistIds(ids);
            loadWishlist();
            return;
        }

        axios.delete(`/api/wishlist/${productId}`, {
            headers: {
                Authorization: `Bearer ${token}`
            }
        }).then(() => {
            loadWishlist();
        }).catch(() => {
            alert('Gagal menghapus dari wishlist');
        });
    }

    // --- LOAD DATA WISHLIST UTAMA ---
    function loadWishlist() {
        const container = document.getElementById('wishlist-container');

        if (!container) return;

        if (!token) {
            const ids = getGuestWishlistIds();

            if (ids.length === 0) {
                container.innerHTML = '<p class="text-muted">Wishlist kamu masih kosong.</p>';
                return;
            }

            axios.get(`/api/wishlist?ids=${ids.join(',')}`)
                .then(response => {
                    renderWishlistItems(response.data.data);
                });

        } else {
            axios.get('/api/wishlist/user', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(response => {
                renderWishlistItems(response.data.data);
            });
        }
    }

    // --- RENDER UI ---
    function renderWishlistItems(products) {
        const container = document.getElementById('wishlist-container');
        if (!products || products.length === 0) {
            container.innerHTML = '<p class="text-muted">Wishlist kamu masih kosong.</p>';
            return;
        }

        let html = '';
        products.forEach(product => {
            let img = product.image;
            if (img && !img.startsWith('/')) img = '/' + img;

            html += `
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="${img}" class="card-img-top" alt="${product.name}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text text-muted">Rp${parseFloat(product.price).toLocaleString()}</p>
                        <div class="mt-auto d-flex justify-content-between gap-2">
                            <button class="btn btn-outline-danger btn-sm remove-from-wishlist" data-id="${product.id}">Hapus</button>
                            <a href="/bouquet/${product.id}" class="btn btn-outline-primary btn-sm">Lihat</a>
                            <button class="btn btn-outline-success btn-sm add-to-cart" data-id="${product.id}">+ Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>`;
        });
        container.innerHTML = `<div class="row">${html}</div>`;
    }

        // --- EVENT LISTENERS ---
        document.addEventListener('click', function (e) {
            const target = e.target.closest('.add-to-wishlist');
            if (target) {
                const productId = parseInt(target.dataset.id);
                console.log('[Wishlist Button Clicked] ID:', productId); // ✅ Tambahkan log ini
                addToWishlist(productId);
            }
        });


        // Remove from wishlist
        if (e.target.classList.contains('remove-from-wishlist')) {
            const productId = parseInt(e.target.dataset.id);
            removeFromWishlist(productId);
        }

        // Tambah ke keranjang (opsional)
        if (e.target.classList.contains('add-to-cart')) {
            const productId = parseInt(e.target.dataset.id);
            alert('Produk ID ' + productId + ' ditambahkan ke keranjang!');
        }


    // --- Load saat masuk halaman wishlist
    if (document.getElementById('wishlist-container')) {
        loadWishlist();
    }
});
