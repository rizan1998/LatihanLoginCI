  <!-- Footer -->
  <footer class="sticky-footer bg-white">
      <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span>Copyright &copy; Your Website 2019</span>
          </div>
      </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
              </div>
          </div>
      </div>
  </div>

  <!--jquery  -->
  <script src="<?= base_url('assets/'); ?>js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
  <script src="<?php echo base_url() . 'assets/js/raphael-min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/js/morris.min.js' ?>"></script>

  <script>
      Morris.Bar({
          element: 'graph',
          data: <?php echo $data; ?>,
          xkey: 'year',
          ykeys: ['purchase', 'sale', 'profit'],
          labels: ['Purchase', 'Sale', 'Profit']
          //   Kode diatas akan menampilkan sebuah bar chart pada element graph. Dimana graph merupakan ID dari elemen HTML tempat dimana chart ingin ditampilkan.
      });
  </script>
  <script>
      //untuk menampilkan perubahan pada name upload jadi muncul
      $('.custom-file-input').on('change', function() {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass('selected').html(fileName);
      });

      $('.form-check-input').on('click', function() {
          //   ambil dulu data menggunakan var/const menuID
          //diisi dengan this atau tombol ckls yang sedang di klik
          //lalu ambil datanya yg namanya menu dan role
          const menuId = $(this).data('menu');
          const roleId = $(this).data('role');

          //lalu jalankan ajax nya supaya pada saat diklik langsung jalan prosesnya
          $.ajax({
              // yang pertama arahakan controller ke controller baru khusus untuk menjalankan ajax
              //jadi panggil php dalam html saya tidak tahu jika ini dapat berjalan pada file js
              url: "<?= base_url('admin/changeaccess') ?>",
              //lalu tipe input adalah post
              type: 'post',
              //lalu kirim data menggunakan object
              data: {
                  //menuId yg pertama adalah atribute objectnya diisi dengan menuId var/const diatas yg diambil dari check boxnya
                  menuId: menuId,
                  roleId: roleId
              },
              //maka ketika sukses jalankan fungsi dibawah
              success: function() {
                  //maka kembalikan ke halam roleaccess concat(gabungkan) dengan id semula 
                  document.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
              }

          });

      });


      $(document).ready(function() {
          // Untuk sunting
          $('#edit-data').on('show.bs.modal', function(event) {
              var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
              var modal = $(this)

              // Isi nilai pada field
              modal.find('#id').attr("value", div.data('id'));
              modal.find('#title').attr("value", div.data('title'));
              //   modal.find('#alamat').html(div.data('alamat'));

          });
      });

      $(document).ready(function() {
          $("#hapus").click(function() {
              //Say - $('p').get(0).id - this delete item id
              //modal.find('#delete_item_id').attr("value",div.data('#delete_item_id'));
              $("#delete_item_id").val($('p').get());
              $('#delete_confirmation_modal').modal('show');
          });
      });


      //   $("#is_active").is(':checked', function() {
      //               $("#is_active").attr('value', '1');
  </script>

  </body>

  </html>