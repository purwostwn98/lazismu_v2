<?= $this->extend("/layout/template_front.php"); ?>
<?= $this->section("konten"); ?>
<div class="page-intro bgc-white-l3 py-2 pt-xl-4 py-xl-5 border-b-1 brc-orange-l2 overflow-hidden">

  <!-- <div id="random-shapes"></div> -->
  <!-- will contain the random circle and squares -->
  <div class="row container container-plus mx-auto mt-0 mb-2 justify-content-center">
    <div class="col-12">
      <p class="text-center">
        <img style="max-width: 50px;" src="<?= base_url(); ?>/assets/image/kembang.png" alt="">
      </p>
    </div>
  </div>
  <div class="row container container-plus mx-auto mt-2 mb-5">
    <div class="col-12  d-flex flex-column justify-content-center text-center" data-aos="fade-right" data-aos-delay="100">
      <h2 class="text-black border-b-2 brc-warning-tp2 pb-1 align-self-center text-bold">
        <strong>Si-LazisMu UMS</strong>
      </h2>

      <p class="my-3 text-dark-tp2">
        Si-Lazismu UMS merupakan sistem informasi untuk pengajuan program bantuan milik Lazismu Universitas Muhammadiyah Surakarta.
      </p>

      <!-- <h6 class="my-3 bgc-purple-tp1 text-120 text-white align-self-center p-2 radius-3px">
                  You can put a slideshow here to make it more interesting ...
                </h6> -->
      <hr>
      <div class="mt-30">
        <a href="/front/formulir_biodata" class=" pt-15 pb-2 radius-round btn btn-md btn-h-light-primary btn-primary" role="button" aria-selected="true">
          Formulir Pengajuan
        </a>
        <a href="/front/formulir_cekajuan" class=" pt-15 pb-2 radius-round btn btn-md btn-h-light-warning btn-warning" role="button" aria-selected="true">
          Cek Ajuan
        </a>
      </div>
    </div>
    <br>
  </div>
  <div class="row justify-align-center">
    <div class="col-12 align-content-center">
      <p class="text-center">Download panduan pengajuan program bantuan <a href="https://bit.ly/panduan_silazismu" target="_blank"> <strong>di sini</strong></a></p>
    </div>
  </div>

</div>


<div class="py-2 bgc-black mt-n4">
  <div class="container container-plus mt-n5">
    <div class="text-center">

      <div class="row">
        <div class="col-12 col-lg-10 col-xl-10 mx-auto">
          <!-- <div class="row my-4 align-self-center">
                      <div class="col-12">
                        <h4 class="text-uppercase text-800 border-b-2 brc-warning-tp4 text-white mt-5 mb-2 align-self-center">
                          6 Pilar Program Lazismu
                        </h4>
                      </div>
                    </div> -->
          <div class="row my-4">
            <div class="col-12 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="300">
              <div class="radius-2 brc-warning-m2 bgc-white shadow-1 py-4 px-4 h-100">
                <div class="d-inline-block text-center p-2 text-150 pos-rel">
                  <div class="brc-warning-m4 border-2 w-3 h-3 radius-round position-tl mt-2 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-2 h-2 radius-round position-tr mt-n1 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-4 h-4 radius-round position-br mb-2"></div>

                  <i class="fas fa-book-reader fa-2x text-orange pos-rel"></i>
                </div>

                <h3 class="text-secondary-d3 text-160 my-3">Pendidikan</h3>

                <p class="text-dark-m2">
                  Program peningkatan mutu SDM dengan menjalankan berbagai program di bidang pendidikan berupa pemenuhan sarana dan biaya pendidikan. <br>
                </p>
                <a href="front/program/1" class="mt-3 mt-md-4 btn btn-outline-warning btn-bold btn-bgc-orange btn-md">Lihat Program</a>
              </div>
            </div>

            <div class="col-12 col-md-4 mb-4  mb-md-0" data-aos="fade-up" data-aos-delay="450">
              <div class="radius-2 bgc-white shadow-1 py-4 px-4 h-100">
                <div class="d-inline-block text-center p-2 text-150 pos-rel">
                  <div class="brc-warning-m4 border-2 w-3 h-3 radius-round position-tl mt-2 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-2 h-2 radius-round position-tr mt-n1 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-4 h-4 radius-round position-br mb-2"></div>

                  <i class="fa fa-heart fa-2x text-orange pos-rel"></i>
                </div>

                <h3 class="text-secondary-d3 text-160 my-3">Kesehatan</h3>

                <p class="text-dark-m2">
                  Program Lazismu yang berfokus pada pemenuhan hak-hak mustahik untuk mendapatkan kehidupan yang berkualitas melalui layanan kesehatan atau prokes.
                </p>
                <a href="front/program/2" class="mt-3 mt-md-4 btn btn-outline-warning btn-bold btn-bgc-orange btn-md">Lihat Program</a>
              </div>
            </div>

            <div class="col-12 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="600">
              <div class="radius-2 bgc-white shadow-1 py-4 px-4 h-100">
                <div class="d-inline-block text-center p-2 text-150 pos-rel">
                  <div class="brc-warning-m4 border-2 w-3 h-3 radius-round position-tl mt-2 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-2 h-2 radius-round position-tr mt-n1 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-4 h-4 radius-round position-br mb-2"></div>

                  <i class="fas fa-donate fa-2x text-orange pos-rel"></i>
                </div>

                <h3 class="text-secondary-d3 text-160 my-3">Ekonomi</h3>

                <p class="text-dark-m2">
                  Program peningkatan kesejahteraan penerima manfaat dana Zakat dan donasi lainnya dengan pola pemberdayaan maupun pelatihan-pelatihan wirausaha. <br>
                </p>
                <a href="front/program/3" class="mt-3 mt-md-4 btn btn-outline-warning btn-bold btn-bgc-orange btn-md">Lihat Program</a>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-10 col-xl-10 mx-auto">
          <div class="row my-4">
            <div class="col-12 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="300">
              <div class="radius-2 brc-warning-m2 bgc-white shadow-1 py-4 px-4 h-100">
                <div class="d-inline-block text-center p-2 text-150 pos-rel">
                  <div class="brc-warning-m4 border-2 w-3 h-3 radius-round position-tl mt-2 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-2 h-2 radius-round position-tr mt-n1 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-4 h-4 radius-round position-br mb-2"></div>

                  <i class="fas fa-mosque fa-2x text-orange pos-rel"></i>
                </div>

                <h3 class="text-secondary-d3 text-160 my-3">Dakwah</h3>

                <p class="text-dark-m2">
                  Pilar yang berfungsi menguatkan sisi ruhani dan pemenuhan kebutuhan untuk kegiatan dakwah dengan tujuan kemandirian para da’i dan institusi dakwah.
                </p>
                <a href="front/program/4" class="mt-3 mt-md-4 btn btn-outline-warning btn-bold btn-bgc-orange btn-md">Lihat Program</a>
              </div>
            </div>

            <div class="col-12 col-md-4 mb-4  mb-md-0" data-aos="fade-up" data-aos-delay="450">
              <div class="radius-2 bgc-white shadow-1 py-4 px-4 h-100">
                <div class="d-inline-block text-center p-2 text-150 pos-rel">
                  <div class="brc-warning-m4 border-2 w-3 h-3 radius-round position-tl mt-2 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-2 h-2 radius-round position-tr mt-n1 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-4 h-4 radius-round position-br mb-2"></div>

                  <i class="fas fa-hands-helping fa-2x text-orange pos-rel"></i>
                </div>

                <h3 class="text-secondary-d3 text-160 my-3">Kemanusiaan</h3>

                <p class="text-dark-m2">
                  Penanganan masalah sosial yang timbul akibat ekses external terhadap kehidupan mustahik, seperti bantuan bencana, pendampingan manula dan kegiatan karikatif.
                </p>
                <a href="front/program/5" class="mt-3 mt-md-4 btn btn-outline-warning btn-bold btn-bgc-orange btn-md">Lihat Program</a>
              </div>
            </div>

            <div class="col-12 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="600">
              <div class="radius-2 bgc-white shadow-1 py-4 px-4 h-100">
                <div class="d-inline-block text-center p-2 text-150 pos-rel">
                  <div class="brc-warning-m4 border-2 w-3 h-3 radius-round position-tl mt-2 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-2 h-2 radius-round position-tr mt-n1 ml-n1"></div>
                  <div class="brc-warning-m4 border-2 w-4 h-4 radius-round position-br mb-2"></div>

                  <i class="fas fa-gift fa-2x text-orange pos-rel"></i>
                </div>

                <h3 class="text-secondary-d3 text-160 my-3">Program Rutin</h3>

                <p class="text-dark-m2">
                  Program yang dilaksanakan secara rutin setiap periode / tahun yang bermanfaat bagi umat. <br><br><br>
                </p>
                <a href="front/program/6" class="mt-3 mt-md-4 btn btn-outline-warning btn-bold btn-bgc-orange btn-md">Lihat Program</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="footer h-auto">
  <div class="footer-inner py-45">
    <div class="container container-plus" data-aos="fade">
      <div class="row container container-plus mx-auto mt-0 mb-0 justify-content-center">
        <div class="col-12">
          <p><b>Lazismu Universitas Muhammadiyah Surakarta</b><br>
            Gedung A Lt 1 (Kampus 1 UMS) Jl. A. Yani Tromol Pos1, Pabelan, Kartasura, Sukoharjo <br>email: lazismu@ums.ac.id Telp. (0271) 717417 ext. 2282, Hp/Wa: 085363766667</p>
        </div>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>