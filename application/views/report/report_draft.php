<!-- .page-title-bar -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <header class="page-title-bar">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?=base_url()?>"><span class="fa fa-home"></span> Admin Panel</a>
        </li>
        <li class="breadcrumb-item active">
          <a class="text-muted">Laporan Draft</a>
        </li>
      </ol>
    </nav>
    <h1 class="page-title"> Laporan </h1>
  </header>
  <!-- Reporting buku -->
  <ul nav class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index') ?>">Summary</a></li>
    <li class="nav-item"><a class="nav-link active" href="<?= base_url('reporting/index_draft') ?>">Laporan Draft</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_books') ?>">Laporan Buku</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/index_author') ?>">Laporan Author</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/performa_editor') ?>">Performa Editor</a></li>
    <li class="nav-item"><a class="nav-link" href="<?= base_url('reporting/performa_layouter') ?>">Performa Layouter</a></li>
  </ul>
  <!-- Reporting buku -->
  <!-- /.page-title-bar -->
  <br />
  <h5>Laporan Draft</h5>
  <br />

    <!-- graph for draft -->

    <canvas id="myChart" width="500" height="100"></canvas>
    <script>

    $.post("<?php echo base_url();?>Reporting/getDraft",
        function(data){
          var obj = JSON.parse(data);
          console.log(obj);
          var tampil = [];
          for(var i=1;i<=12;i++){
            obj.count[i];
            tampil.push(obj.count[i]);
          };

          var ctx = $("#myChart");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                          "Agustus", "September", "Oktober", "November", "Desember"],
                  datasets: [{
                      label: 'Laporan Draft',
                      data: tampil,
                      backgroundColor: [
                          'rgba(54, 162, 235, 1)',
                          'rgba(198, 198, 198, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)',
                          'rgba(208, 222, 98, 1)',
                          'rgba(98, 222, 206, 1)',
                          'rgba(171, 98, 222, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)'
                      ],
                      borderColor: [
                          'rgba(54, 162, 235, 1)',
                          'rgba(198, 198, 198, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)',
                          'rgba(208, 222, 98, 1)',
                          'rgba(98, 222, 206, 1)',
                          'rgba(171, 98, 222, 1)'
                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                        gridLines :{
                          display : true
                        },
                        ticks: {
                          fontFamily :"'Helvetica'",
                          fontSize : 13,
                          beginAtZero:true
                        }
                    }],
                      xAxes : [{
                        gridLines : {
                          display : false
                        },
                        ticks: {
                          fontFamily :"'Helvetica'",
                          fontSize : 13,
                          beginAtZero:true
                        }
                      }],

                  }
              }
          });
      });
    </script>

    <!-- table for draft -->

    <br />
    <h5>Tabel Draft</h5>
    <br />
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th>Draft ID</th>
            <th>Draft Title</th>
            <th>Entry Date</th>
            <!-- <th>Month</th> -->
          </tr>
        <?php
        if($drafts)
        {
          foreach ($drafts as $row)
          {
        ?>
          <tr>
            <td><?php echo $row->draft_id; ?></td>
            <td><?php echo $row->draft_title; ?></td>
            <td><?php echo konversiTanggal($row->entry_date); ?></td>
            <!-- <td><?php echo date("m",strtotime($row->entry_date)); ?></td> -->
          </tr>
          <?php
          }
        }
        else
        {
          ?>
          <tr>
            <td colspan="3">No data found</td>
          </tr>
        <?php
        }
        ?>
        </table>
      </div>
