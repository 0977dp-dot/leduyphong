/**
 * Cart AJAX - Thêm sản phẩm vào giỏ hàng
 */
document.addEventListener('DOMContentLoaded', function () {

    // ── Toast container ──────────────────────────────────────────────────────
    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.style.cssText = [
            'position:fixed',
            'top:20px',
            'right:20px',
            'z-index:9999',
            'display:flex',
            'flex-direction:column',
            'gap:10px',
        ].join(';');
        document.body.appendChild(toastContainer);
    }

    function showToast(message, type = 'success') {
        const colors = {
            success: { bg: '#198754', icon: '✓' },
            error:   { bg: '#dc3545', icon: '✕' },
            info:    { bg: '#0d6efd', icon: 'ℹ' },
        };
        const { bg, icon } = colors[type] || colors.success;

        const toast = document.createElement('div');
        toast.style.cssText = [
            `background:${bg}`,
            'color:#fff',
            'padding:12px 20px',
            'border-radius:10px',
            'box-shadow:0 4px 15px rgba(0,0,0,0.2)',
            'font-size:15px',
            'display:flex',
            'align-items:center',
            'gap:10px',
            'min-width:220px',
            'max-width:340px',
            'opacity:0',
            'transform:translateX(50px)',
            'transition:all 0.35s ease',
        ].join(';');
        toast.innerHTML = `<span style="font-size:18px;font-weight:bold;">${icon}</span><span>${message}</span>`;

        toastContainer.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        });

        // Remove after 3s
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(50px)';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }

    // ── Update badge ─────────────────────────────────────────────────────────
    function updateCartBadge(count) {
        const badge = document.getElementById('cart-badge');
        if (!badge) return;
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('d-none');
        } else {
            badge.classList.add('d-none');
        }
    }

    // ── Add to cart ──────────────────────────────────────────────────────────
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-add-cart');
        if (!btn) return;

        e.preventDefault();

        const productId = btn.dataset.productId;
        const url       = btn.dataset.url;

        if (!productId || !url) return;

        // Disable button momentarily
        btn.disabled = true;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

        // Get CSRF token
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content
                  || document.querySelector('input[name="_token"]')?.value
                  || '';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: productId }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                showToast(data.message || 'Đã thêm vào giỏ hàng!', 'success');
                updateCartBadge(data.cartCount);
            } else {
                showToast(data.message || 'Có lỗi xảy ra.', 'error');
            }
        })
        .catch(() => {
            showToast('Không thể kết nối máy chủ.', 'error');
        })
        .finally(() => {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        });
    });
});