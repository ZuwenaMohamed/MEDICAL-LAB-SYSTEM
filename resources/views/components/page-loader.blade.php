<div id="page-loader" class="page-loader">
    <div class="page-loader-spinner"></div>
</div>

<style>
    .page-loader {
        position: fixed;
        inset: 0;
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
    }

    .page-loader-spinner {
        width: 50px;
        height: 50px;
        border: 5px solid #dbeafe;
        border-top-color: #1d4ed8;
        border-radius: 50%;
        animation: page-loader-spin 0.8s linear infinite;
    }

    @keyframes page-loader-spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    window.addEventListener('load', function () {
        const loader = document.getElementById('page-loader');

        if (loader) {
            loader.style.display = 'none';
        }
    });
</script>