<!-- Loader Overlay -->
<div id="loaderOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="flex flex-col items-center">
        <!-- Spinner -->
        <div class="w-16 h-16 border-4 border-white border-t-transparent rounded-full animate-spin"></div>
        <p class="mt-4 text-white font-semibold">Loading...</p>
    </div>
</div>
<script>
    function showLoader() {
        document.getElementById('loaderOverlay').classList.remove('hidden');
    }

    function hideLoader() {
        document.getElementById('loaderOverlay').classList.add('hidden');
    }
</script>
