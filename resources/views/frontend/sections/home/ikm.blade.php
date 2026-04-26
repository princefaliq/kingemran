<section class="bg-solitude-blue">
    <div class="container background-no-repeat background-position-center-bottom">
        <div class="row justify-content-center align-items-center mb-2" data-anime='{ "el": "childs", "translateX": [0, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-lg-6 col-md-6 col-sm-7 text-center text-sm-center">
                <h5 class="alt-font text-dark-gray lh-40 fw-500 ls-minus-1px mb-0 ms-10px lg-ms-0" data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 500, "staggervalue": 300, "easing": "easeOutQuad" }'>Indeks Kepuasan Masyarakat</h5>
                <p class="alt-font text-dark-gray lh-40 fw-500 ls-minus-1px mb-0 ms-10px lg-ms-0" data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 500, "staggervalue": 300, "easing": "easeOutQuad" }'>Terima kasih atas penilaian yang telah anda berikan selama tahun {{ date('Y')-1 }}, masukan anda sangat bermanfaat agar {{ config('app.name') }} terus memperbaiki dan meningkatkan kualitas pelayanan bagi masyarakat</p>
            </div>
            <div class="col-lg-6 col-sm-4 ps-40px md-ps-15px md-mt-35px text-center text-lg-center">
                <h4 class="text-dark-gray fw-700 ls-minus-3px mb-5px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "delay": 100, "staggervalue": 100, "easing": "easeOutQuad" }' id="mutu"></h4>
                <div class="review-star-icon fs-17 lh-20 d-block" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "delay": 200, "staggervalue": 100, "easing": "easeOutQuad" }' id="bintang">

                </div>
                <span class="text-dark-gray fw-500" data-anime='{ "el": "lines", "translateY": [15, 0], "opacity": [0,1], "delay": 300, "staggervalue": 100, "easing": "easeOutQuad" }' id="kinerja"></span>
            </div>
        </div>
    </div>
</section>
@push('js')
    <script>
        $(document).ready(function() {
            let bintang='';
            $.ajax({
                url: "{{ url('api/skm') }}", // Ganti dengan URL API yang sesuai
                type: 'GET', // Metode HTTP, bisa 'GET' atau 'POST'
                success: function(data) {
                    // Tampilkan data yang diterima
                    $("#mutu").text(data.response.mutu + ' (' + data.response.ikm + ')');
                    $("#kinerja").text(data.response.kinerja);
                    if (data.response.mutu === 'A')
                    {
                        bintang='<i class="fas fa-star text-dark-gray"></i><i class="fas fa-star text-dark-gray"></i><i class="fas fa-star text-dark-gray"></i><i class="fas fa-star text-dark-gray"></i>';
                    }else if (data.response.mutu === 'B')
                    {
                        bintang='<i class="fas fa-star text-dark-gray"></i><i class="fas fa-star text-dark-gray"></i><i class="fas fa-star text-dark-gray"></i><i class="far fa-star text-dark-gray"></i>';
                    }else if (data.response.mutu === 'C')
                    {
                        bintang='<i class="fas fa-star text-dark-gray"></i><i class="fas fa-star text-dark-gray"></i><i class="far fa-star text-dark-gray"></i><i class="far fa-star text-dark-gray"></i>';
                    }else if (data.response.mutu === 'D')
                    {
                        bintang='<i class="fas fa-star text-dark-gray"></i><i class="far fa-star text-dark-gray"></i><i class="far fa-star text-dark-gray"></i><i class="far fa-star text-dark-gray"></i>';
                    }
                    $("#bintang").html(bintang);
                    //console.log(data.response.mutu);
                },
                error: function(xhr, status, error) {
                    // Tampilkan pesan kesalahan
                    console.log('salah');
                }
            });

        });
    </script>
@endpush
