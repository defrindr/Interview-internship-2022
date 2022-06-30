<?php
require_once 'api/menu.php';
$result = $menus = [];
$tahun = 0;
if (isset($_GET['tahun'])) {
  $tahun = $_GET['tahun'];
}
if ($tahun != 0) {
  if ($tahun == '2021') {
    require_once 'api/tahun_2021.php';
    require_once 'Pivot.php';
    $pivot = new Pivot();
    $result = $pivot->getData($data, $menu);
  }
  if ($tahun == '2022') {
    require_once 'api/tahun_2022.php';
  }
}

// format data as money format
function asMoney($value)
{
  return 'Rp ' . number_format($value, 2, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Laporan penjualan tahunan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
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
            <table class="table table-hover">
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
                <?php if (isset($result)) : ?>
                  <?php foreach ($result as $category => $menu) : ?>
                    <tr class="bg-primary text-white">
                      <th scope="row" colspan="14"><?= strtoupper($category) ?></th>
                    </tr>
                    <?php foreach ($menu as $value) : ?>
                      <tr>
                        <td><?= $value['menu'] ?></td>
                        <?php foreach ($value['month'] as $per_month) : ?>
                          <td><?= $per_month == 0 ? '' : asMoney($per_month) ?></td>
                        <?php endforeach; ?>
                        <td><?= asMoney(array_sum($value['month'])) ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>