
<?php $ceklevel = $this->session->userdata('level'); ?>
<!-- .page-title-bar -->
  <header class="page-title-bar">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=base_url()?>"><span class="fa fa-home"></span></a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?=base_url()?>">Penerbitan</a>
        </li>
                <li class="breadcrumb-item">
          <a href="<?=base_url('book')?>">Book</a>
        </li>
        <li class="breadcrumb-item">
          <a class="text-muted"><?= $input->book_title ?></a>
        </li>
      </ol>
    </nav> 
  </header>
  <!-- /.page-title-bar -->
<!-- .page-section -->
<div class="page-section">
  <div class="d-xl-none">
    <button class="btn btn-danger btn-floated" type="button" data-toggle="sidebar">
      <i class="fa fa-th-list"></i>
    </button>
  </div>
  <!-- .card -->
  <section id="data-draft" class="card">
    <!-- .card-header -->
    <header class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active show" data-toggle="tab" href="#data-drafts">Data Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#data-penulis">Data Penulis</a>
        </li>
      </ul>
    </header>
    <!-- /.card-header -->
    <!-- .card-body -->
    <div class="card-body">
    <?= isset($input->draft_id) ? form_hidden('draft_id', $input->draft_id) : '' ?>
    <!-- .tab-content -->
      <div id="myTabCard" class="tab-content">
        <div class="tab-pane fade active show" id="data-drafts">
          <!-- .table-responsive -->
        <div class="table-responsive">
          <!-- .table -->
          <table class="table table-striped table-bordered mb-0">
            <!-- tbody -->
            <tbody>
              <!-- tr -->
              <tr>
                <td width="200px"> Judul Buku </td>
                <td>: <strong><?= $input->book_title ?></strong> </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Kode Buku </td>
                <td>: <?= $input->book_code ?> </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Edisi Buku </td>
                <td>: <?= $input->book_edition ?> </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Kategori </td>
                <td>: <?=isset($input->category_id)? konversiID('category','category_id', $input->category_id)->category_name : ''?> </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Tema </td>
                <td>: <?=isset($input->theme_id)? konversiID('theme','theme_id', $input->theme_id)->theme_name : ''?> </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> File Buku </td>
                <td>: <?=(!empty($input->book_file))? '<a href="'.base_url('draftfile/'.$input->book_file).'">'.$input->book_file.'</a>' : '' ?>
                   </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> File Cover </td>
                <td>: <?=(!empty($input->cover_file))? '<a href="'.base_url('draftfile/'.$input->cover_file).'">'.$input->cover_file.'</a>' : '' ?>
                   </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Catatan Buku </td>
                <td>: <?= $input->book_notes ?></td>
              </tr>
              <!-- /tr -->
            </tbody>
            <!-- /tbody -->
          </table>
          <!-- /.table -->
        </div>
        <!-- /.table-responsive -->
        <hr class="my-4">
        <!-- .table-responsive -->
        <div class="table-responsive">
          <!-- .table -->
          <table class="table table-striped table-bordered mb-0">
            <!-- tbody -->
            <tbody>
              <!-- tr -->
              <tr>
                <td width="200px"> Tipe printing</td>
                <td>: <?= ($input->printing_type == 'o')? 'Offset' : '' ?> <?= ($input->printing_type == 'p')? 'Print On Demand' : '' ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Serial Number</td>
                <td>: <?= $input->serial_num ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Serial Number per tahun </td>
                <td>: <?= $input->serial_num_per_year ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Jumlah copy </td>
                <td>: <?= $input->copies_num ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Cetak Ulang </td>
                <td>: <?= ($input->is_reprint == 'y')? 'Cetak Ulang' : '' ?> <?= ($input->is_reprint == 'n')? 'Naskah baru' : '' ?>  </td>
              </tr>
              <!-- /tr -->
            </tbody>
            <!-- /tbody -->
          </table>
          <!-- /.table -->
        </div>
        <!-- /.table-responsive -->
        <hr class="my-4">
        <!-- .table-responsive -->
        <div class="table-responsive">
          <!-- .table -->
          <table class="table table-striped table-bordered mb-0">
            <!-- tbody -->
            <tbody>
              <!-- tr -->
              <tr>
                <td width="200px"> Tanggal Masuk Draft</td>
                <td>: <?= konversiTanggal($input->entry_date) ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Tanggal Selesai Draft</td>
                <td>: <?= konversiTanggal($input->finish_date) ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Tanggal Cetak </td>
                <td>: <?= konversiTanggal($input->print_date) ?>  </td>
              </tr>
              <!-- /tr -->
              <!-- tr -->
              <tr>
                <td width="200px"> Tanggal Terbit </td>
                <td>: <?= konversiTanggal($input->published_date) ?>  </td>
              </tr>
              <!-- /tr -->
            </tbody>
            <!-- /tbody -->
          </table>
          <!-- /.table -->
        </div>
        <!-- /.table-responsive -->
        </div>
        <div class="tab-pane fade" id="data-penulis">
          <div id="reload-author">
          <?php if ($authors):?>
          <?php $i=1; ?>
          <!-- .table-responsive -->
            <div class="table-responsive" >
              <!-- .table -->
              <table class="table table-striped table-bordered mb-0">
                <!-- thead -->
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">NIP</th>
                      <th scope="col">Unit Kerja</th>
                      <th scope="col">Institusi</th>
                    </tr>
                  </thead>
                  <!-- /thead -->
                <!-- tbody -->
                <tbody>
                  <?php foreach($authors as $author): ?>
                  <!-- tr -->
                  <tr>
                    <td class="align-middle"><?= $i++ ?></td>
                    <!-- jika admin maka ada linknya ke profil -->
                    <td class="align-middle"><a href="<?= base_url('author/profil/'.$author->author_id) ?>"><?= $author->author_name ?></a></td>
                    <td class="align-middle"><?= $author->author_nip ?></td>
                    <td class="align-middle"><?= $author->work_unit_name ?></td>
                    <td class="align-middle"><?= $author->institute_name ?></td>
                  </tr>
                  <!-- /tr -->
                  <?php endforeach ?>
                </tbody>
                <!-- /tbody -->
              </table>
              <!-- /.table -->
            </div>
            <!-- /.table-responsive -->
          <?php else: ?>
              <p>Author data were not available</p>
          <?php endif ?>
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.card-body -->
  </section>
  <!-- /.card -->
</div>
<!-- /.page-section -->




