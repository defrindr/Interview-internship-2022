<?php
require_once 'api/menu.php';
$result = $menus = [];
$tahun = 0;
if(isset($_GET['tahun'])) {
  $tahun = $_GET['tahun'];
}
if ($tahun != 0) {
  if ($tahun == '2021') {
    require_once 'api/tahun_2021.php';
    require_once 'Pivot.php';
    $pivot = new Pivot();
    $result = $pivot->getData($data);
    print_r($result);

  }
  if ($tahun == '2022') {
    require_once 'api/tahun_2022.php';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan penjualan tahunan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row mt-4">
        <div class="col">
          <div class="card">
            <div class="card-header">Laporan penjualan tahunan per menu</div>
            <form action="" action="POST" class="col-4 d-flex p-3">
              <select class="form-select" name="tahun" aria-label="Default select example">
                <option value="0" selected disabled>- Pilih tahun -</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
              </select>
              <button type="submit" class="ms-2 btn btn-primary">
                Tampilkan
              </button>
            </form>

            <div class="p-3">
              <table class="table">
                <thead class="table-dark">
                  <tr>
                    <th scope="col">Menu</th>
                    <th scope="col">Jan</th>
                    <th scope="col">Feb</th>
                    <th scope="col">Mar</th>
                    <th scope="col">Apr</th>
                    <th scope="col">Mei</th>
                    <th scope="col">Jun</th>
                    <th scope="col">Jul</th>
                    <th scope="col">Aug</th>
                    <th scope="col">Sep</th>
                    <th scope="col">Oct</th>
                    <th scope="col">Nov</th>
                    <th scope="col">Dec</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="14">Makanan</td>
                  </tr>
                  <?php if(isset($data)) : ?>
                  <?php for($s=0; $s < count($menu); $s++) : ?>
                  <?php for($i=0; $i < count($data); $i++) : ?>
                    
                    <?php  if ($menu[$s]['menu'] == $data[$i]['menu']) : ?>
                      <?php
                      $total = $total + $data[$i]['total'];
                      ?>
                      <tr>
                        <th><?= $menu[$s]['menu'] ?></th>
                        <th><?= $data[$i]['tanggal'] ?></th>
                        <th><?= $total ?></th>
                      </tr>
                    
                    <?php endif; ?>
                  <?php endfor; ?>
                  <?php endfor; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
