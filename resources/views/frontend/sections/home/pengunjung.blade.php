<!-- start section -->
<section class="bg-extra-medium-slate-blue cover-background background-position-center-top pb-0 mb-0">
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 row-cols-sm-2 position-relative z-index-2 justify-content-center counter-style-02">
            <!-- start counter item -->
            <div class="col text-center sm-mb-30px">
                <h2 class="vertical-counter d-inline-flex alt-font text-white fw-800 mb-0 ls-minus-4px md-ls-minus-2px" data-to="{{ $activeVisitors }}"></h2>
                <span class="d-block lh-24">Pengunjung Aktif</span>
            </div>
            <!-- end counter item -->
            <!-- start counter item -->
            <div class="col text-center sm-mb-30px">
                <h2 class="vertical-counter d-inline-flex alt-font text-white fw-800 mb-0 ls-minus-4px md-ls-minus-2px" data-to="{{ $todayVisitors }}"></h2>
                <span class="d-block lh-24">Pengunjung Hari Ini</span>
            </div>
            <!-- end counter item -->

            <!-- start counter item -->
            <div class="col text-center">
                <h2 class="vertical-counter d-inline-flex alt-font text-white fw-800 mb-0 ls-minus-4px md-ls-minus-2px" data-to="{{ $totalVisitors }}"></h2>
                <span class="d-block lh-24">Pengunjung Total</span>
            </div>
            <!-- end counter item -->
        </div>
    </div>
</section>
@push('js')
    <script>
        function formatNumber(num) {
            return num.toLocaleString('id-ID');
        }

        window.addEventListener('load', function() {
            const counters = document.querySelectorAll('.vertical-counter');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-to'));

                // tunggu animasi selesai (biasanya ±2 detik, sesuaikan)
                setTimeout(() => {
                    counter.textContent = formatNumber(target);
                }, 2000);
            });
        });
    </script>
@endpush
<!-- end section -->
